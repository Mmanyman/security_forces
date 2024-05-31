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
        <!-- Form for assigning guard to their shift -->
        <form id="addUser" action="assignment.php" method="POST">
            <div class="formGroup">

                <!-- Shift ID -->
                <label for="shift_id">Select Shift:</label>
                <div class="dropdown">
                <select name="shift_ID" id="shifts">
                    <option value="" selected disabled>------------------------------------------ SELECT SHIFT ------------------------------------------</option>
                    <?php

                    $conn = new mysqli("localhost", "root", "", "SecurityForces");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    // Fetch available shifts
                    $shifts = "SELECT * FROM Shifts WHERE Shift_ID NOT IN (SELECT Shift_ID FROM Assigned WHERE Assign_Status = 1)";
                    $result = $conn->query($shifts);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $shiftID = $row["Shift_ID"];
                            $areaID = $row["Area_ID"];
                            $timeID = $row["Timeslot_ID"];
                            $workday = $row["Working_Days"];

                            // Get area name
                            $findArea = "SELECT Area_Name FROM Areas WHERE Area_ID='$areaID'";
                            $areaResult = $conn->query($findArea);
                            $areaRow = $areaResult->fetch_assoc();
                            $area = $areaRow["Area_Name"];

                            // Get timeslot
                            $findTime = "SELECT Time FROM Timeslots WHERE Timeslot_ID='$timeID'";
                            $timeResult = $conn->query($findTime);
                            $timeRow = $timeResult->fetch_assoc();
                            $time = $timeRow["Time"];

                            echo '<option align="center" value="' . $shiftID . '">' . $shiftID . ': ' . $area . ' - ' . $time . ' - ' . $workday . '</option>';
                        }
                    }
                    ?>
                </select>
                </div>
                <!-- Guard ID -->
                <label for="guard_id">Select Guard:</label>
                <div class="dropdown">
                <select name="guard_ID" id="guards">
                <option value="" selected disabled>----------------------------------------- SELECT GUARD -----------------------------------------</option>
                    <?php
                    
                    // Fetch all guards
                    $guards = "SELECT Person_ID, Name FROM Guards WHERE Active_Status = 1";
                    $result = $conn->query($guards);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $guardID = $row["Person_ID"];
                            $guardName = $row["Name"];
                            echo '<option align="center" value="' . $guardID . '">' . $guardID . ': ' . $guardName . '</option>';
                        }
                    }
                    ?>
                </select>
                </div>
                <input type="submit" value="Assign" name="SubmitButton">            
            </div>
        </form>
    </div>

    <?php
    // Assigns an guard to an available shift 
    if (isset($_POST["SubmitButton"])) {
        if (array_key_exists('shift_ID', $_POST) && array_key_exists('guard_ID', $_POST)) {
            $guardID = $_POST['guard_ID'];
            $shiftID = $_POST['shift_ID'];
            $assignDate = date('Y-m-d');
            $assignStat = 1;

            $conn = new mysqli("localhost", "root", "", "SecurityForces");

            // Check if guard exists
            $checkGuard = "SELECT * FROM Guards WHERE Person_ID='$guardID'";
            $guardResult = $conn->query($checkGuard);

            if ($guardResult->num_rows == 0) {
                echo "<p>Error: Guard ID does not exist.</p>";
            } else {
                // Check if the shift is already assigned
                $checkShift = "SELECT * FROM Assigned WHERE Shift_ID='$shiftID' AND Assign_Status=1";
                $shiftResult = $conn->query($checkShift);

                if ($shiftResult->num_rows > 0) {
                    echo "<p>This shift is already occupied.</p>";
                } else {
                    $assignGuard = "INSERT INTO `Assigned` (`Person_ID`, `Shift_ID`, `Assignment_Date`, `Assign_Status`)
                                    VALUES ('$guardID', '$shiftID', '$assignDate', '$assignStat')";

                    if ($conn->query($assignGuard) === TRUE) {
                        echo "<p>Guard assigned successfully!</p>";
                    } else {
                        echo "<p>Error: " . $conn->error . "</p>";
                    }
                }
            }
            $conn->close();
        } else {
            echo "<p>Select a shift and/or a guard!</p>";
        }
    }
    ?>

    <!--Displays all the unassigned shifts-->
    <div id="GuardsInfo">
        <!-- <h2 id="colorsTitle" text-align="center">Available Shifts</h2> -->
        <table>
            <?php
            include 'activeAssignment.php';
            ?>
        </table>
            <?php
            include 'allHistoryTable.php';
            ?>
    </div>
</body>
</html>
