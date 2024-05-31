<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Security Assignment Database</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="shifts.css" />
</head>
<body>
    <!-- User Registration Form Section -->
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
    <div>
        <!-- Form for adding a new user -->
        <form id="addUser" action='' method="POST" autocomplete="off">
            <div class="formGroup">
                <!-- Input fields for user information -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter name" required>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="0" max="99" placeholder="Enter age"required>
                <label for="sex">Sex:</label>
                <label><input type="radio" id="male" value="M" name="sex" required>Male</label>
                <label><input type="radio" id="female" value="F" name="sex">Female</label>
                <label><input type="radio" id="unknown" value="U" name="sex">Unknown</label>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter address, put Unknown if unknown..." required>
                <label for="contact">Contact Number:</label>
                <input type="number" id="contact" name="contact" max="99999999999" placeholder="Enter contact number" required>
                <label>Active Status:</label>
                <label><input type="checkbox" id="yes" value="true" name="status" required>Yes</label>
                <input type="submit" value="Submit" name="SubmitButton">
            </div>
        </form>
        <?php
        // Adds the guards to the database when submit is clicked
        if(isset($_POST["SubmitButton"])){
            $name = $_POST["name"];
            $age = $_POST["age"];
            $sex = $_POST["sex"];
            $address = $_POST["address"];
            $contact = $_POST["contact"];
            $status = isset($_POST['status']) ? true : false;
            $conn = new mysqli("localhost", "root", "", "SecurityForces");
            $insert_guard = "INSERT INTO `Guards` (`Name`, `Age`, `Sex`, `Address`, `Contact_Number`, `Active_Status`) 
                            VALUES ('$name', '$age', '$sex', '$address', '$contact', '$status')";
            if ($conn->query($insert_guard) === TRUE) {
                echo "New Record Inserted Successfully!";
            } else {
                echo "". $conn->error;
            }
            $conn->close();
        }
        ?>
    </div>
    <!-- Display all guards with actions -->
    <div id="GuardsInfo">
        <h2 id="colorsTitle">Guards Information Table</h2>
        <?php include "guardsTable.php"; ?>
    </div>
</body>
</html>
