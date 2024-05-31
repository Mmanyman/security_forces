<?php
$conn = new mysqli("localhost", "root", "", "SecurityForces");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guardID = $_POST['Person_ID'];

    $query = "SELECT * FROM guards WHERE Person_ID = '$guardID' ";
    $result = $conn->query($query);

    // Checks if the guard exists
    if ($result->num_rows > 0) {
        $guard = $result->fetch_assoc();

        // Updates the guard's details when the submit button is clicked
        if (isset($_POST['SubmitButton'])) {
            $name = $_POST["name"];
            $age = $_POST["age"];
            $sex = $_POST["sex"];
            $address = $_POST["address"];
            $contact = $_POST["contact"];
            $status = isset($_POST['status']) ? 1 : 0;

            $updateGuard = "UPDATE guards
                            SET Name='$name', Age='$age', Sex='$sex', Address='$address', Contact_Number='$contact', Active_Status='$status'
                            WHERE Person_ID='$guardID' ";
            if ($conn->query($updateGuard) === TRUE) {
                // Updates the active assignments of the guard to be inactive if the guard's active status changes from active to inactive 
                if ($guard["Active_Status"] == 1 && $status == 0) {
                    $endDate = date('Y-m-d');
                    $conn->query("UPDATE assigned SET Assign_Status = 0, End_Date = '$endDate' WHERE Person_ID = '$guardID' AND Assign_Status = 1");
                }    
                echo "<p>Updated Successfully!</p>";
            } else {
                echo "<p>Error updating record: " . $conn->error . "</p>";
            }
            header("Location: addGuard.php");
            exit();
        }
        if (isset($_POST["Cancel"])) {
            header("Location: addGuard.php");
            exit();
        }
    } else {
        echo "<p>Guard not found.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Update Guard</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="shifts.css" />
</head>
<body>
    <div>
        <h2 id="title">SECURITY ASSIGNMENT DATABASE</h2>
        <hr>
    </div>
    <!-- Menu for Database-->
    <div class="navBar">
        <a class="navigation" href="addGuard.php" id="add">Guards</a>
        <a class="navigation" href="assignment.php">Assignment</a>
        <a class="navigation" href="shifts.php">Shifts</a>
    </div>
    <!-- Form for updating guard details -->
    <h2 id="colorsTitle" text-align='center'>Update Guard Information</h2>
    <form id="addUser" action="" method="POST" autocomplete="off">
        <div class="formGroup">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($guard["Name"] ?? '') ?>">

            <label id="age-label" for="age">Age:</label>
            <input type="number" id="age" name="age" min="0" max="99" value="<?= htmlspecialchars($guard['Age'] ?? '')?>">

            <label for="sex">Sex:</label>
            <label for="male"><input type="radio" id="male" value="M" name="sex" <?= isset($guard['Sex']) && $guard['Sex'] == 'M' ? 'checked' : '' ?>> Male</label>
            <label for="female"><input type="radio" id="female" value="F" name="sex" <?= isset($guard['Sex']) && $guard['Sex'] == 'F' ? 'checked' : '' ?>> Female</label>
            <label for="unknown"><input type="radio" id="unknown" value="U" name="sex" <?= isset($guard['Sex']) && $guard['Sex'] == 'U' ? 'checked' : '' ?>> Unknown</label>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($guard['Address'] ?? '') ?>" >

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" value="<?= htmlspecialchars($guard['Contact_Number'] ?? '') ?>">

            <label>Active Status</label>
            <label for="yes"><input type="checkbox" id="yes" name="status" <?= isset($guard['Active_Status']) && $guard['Active_Status'] ? 'checked' : '' ?>> Yes</label>

            <input type="hidden" name="Person_ID" value="<?= htmlspecialchars($guard['Person_ID'] ?? '') ?>">

            <input type="submit" value="Submit" name="SubmitButton">
            <input type="submit" value="Cancel" name="Cancel">
        </div>
    </form>
</body>
</html>
