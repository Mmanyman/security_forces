<?php
$conn = new mysqli("localhost", "root", "", "SecurityForces");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["shiftID"])) {
    $shiftID = $_POST["shiftID"];
    $endDate = date('Y-m-d');

    // Update the Assigned table to set Assign_Status to 0
    $updateQuery = "UPDATE Assigned SET Assign_Status = 0, End_Date = '$endDate' WHERE Shift_ID='$shiftID'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Guard removed from shift successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

header("Location: assignment.php");
exit();

?>
