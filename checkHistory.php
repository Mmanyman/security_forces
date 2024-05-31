<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Guard History</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="shifts.css" />
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "SecurityForces");
    $Person_ID = $_POST["Person_ID"];
    ?>

    <div>
        <h2 id="title">Guard Assignment History</h2>
        <hr>
    </div>

    <!--Displays the assignment history of the chosen guard-->
    <div id="GuardsInfo">
        <h2 id="colorsTitle" text_align='center'>History</h2>
        <table>
            <tr>
                <th>Assignment ID</th>
                <th>Area Name</th>
                <th>Timeslot</th>
                <th>Working Days</th>
                <th>Assignment Date</th>
                <th>End Date</th>
                <th>Assignment Status</th>
            </tr>
            <?php
            $get_history = "SELECT * FROM Assigned WHERE Person_ID='$Person_ID'";
            $result = $conn->query($get_history);

            // Checks if there are past assignments for that guard
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Gets the needed details to be displayed
                    $Shift_ID = $row["Shift_ID"];
                    $get_details = "SELECT * FROM Shifts WHERE Shift_ID='$Shift_ID'";
                    $details = $conn->query($get_details)->fetch_assoc();
                    $area_id = $details["Area_ID"];
                    $time_id = $details["Timeslot_ID"];
                    $area = $conn->query("SELECT Area_Name FROM Areas WHERE Area_ID='$area_id'")->fetch_assoc()["Area_Name"];
                    $time = $conn->query("SELECT Time FROM Timeslots WHERE Timeslot_ID='$time_id'")->fetch_assoc()["Time"];
                    $status = $row["Assign_Status"] == 1 ? "Active" : "Inactive";
                    $startDate = $row["Assignment_Date"];
                    $endDate = $row["End_Date"] ?? "----------"; 

                    echo "<tr>
                            <td align='center'>" . $row["Assignment_ID"] . "</td>
                            <td align='center'>" . $area . "</td>
                            <td align='center'>" . $time . "</td>
                            <td align='center'>" . $details["Working_Days"] . "</td>
                            <td align='center'>" . $startDate . "</td>
                            <td align='center'>" . $endDate . "</td>
                            <td align='center'>" . $status . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' align='center'>NO AVAILABLE HISTORY</td></tr>";
            }
            echo "<div align='center'><button type'submit' onClick='history.go(-1);'>Back</button></div>";
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
