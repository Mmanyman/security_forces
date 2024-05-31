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
    <!--Displays all the shifts in the database-->
    <div class="shifts">
        <h2 id="colorsTitle">All Shifts</h2>
        <table>
            <tr>
                <th>Shift ID</th>
                <th>Timeslot</th>
                <th>Area Name</th>
                <th>Working Days</th>
                <th>Assigned</th>
                <th>Action</th>
            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "SecurityForces");
            if ($conn->query("SELECT * FROM Shifts")->num_rows > 0){
                $shifts = $conn->query("SELECT * FROM Shifts");
                while ($row = $shifts->fetch_assoc()) {
                    // Gets the necessary details that needs to be displayed
                    $shift_id = $row["Shift_ID"];
                    $area_id = $row["Area_ID"];
                    $time_id = $row["Timeslot_ID"];
                    $area = $conn->query("SELECT Area_Name FROM Areas WHERE Area_ID='$area_id'")->fetch_assoc()["Area_Name"];
                    $time = $conn->query("SELECT Time FROM Timeslots WHERE Timeslot_ID='$time_id'")->fetch_assoc()["Time"];
                    
                    // Checks if there is an assigned guard for this shift
                    $assigned = "None";
                    $check_assigned = $conn->query("SELECT Person_ID FROM Assigned WHERE Shift_ID='$shift_id' AND Assign_Status=1");
                    if ($check_assigned->num_rows > 0){
                        $person_id = $check_assigned->fetch_assoc()["Person_ID"];
                        $assigned = $conn->query("SELECT Name FROM Guards WHERE Person_ID='$person_id'")->fetch_assoc()["Name"];
                    }

                    echo "<tr>" .
                            "<td align='center'>" .$row["Shift_ID"]. "</td>" .
                            "<td align='center'>" . $time . "</td>" .
                            "<td align='center'>" . $area . "</td>" .
                            "<td align='center'>" . $row["Working_Days"] . "</td>" .
                            "<td align='center'>" . $assigned . "</td>
                            <td align='center'>
                                <form action='shiftHistory.php' method='POST'>
                                    <input type='hidden' name='Shift_ID' value='" . $row["Shift_ID"] . "'>
                                    <button class='tableButton' type='submit'>Check History</button>
                                </form>
                            </td>
                          </tr>";
                }
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
