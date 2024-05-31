<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Shift History</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="shifts.css" />
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "SecurityForces");
    $Shift_ID = $_POST["Shift_ID"];
    ?>

    <div>
        <h2 id="title">Shift Assignment History</h2>
        <hr>
    </div>

    <!--Displays the assignment history of the chosen shift-->
    <div id="GuardsInfo">
        <h2 id="colorsTitle" text_align='center'>History</h2>
        <table>
            <tr>
                <th>Assignment ID</th>
                <th>Assigned Guard</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Assignment Status</th>
            </tr>
            <?php
            $get_history = "SELECT * FROM Assigned WHERE Shift_ID='$Shift_ID'";
            $result = $conn->query($get_history);

            // Checks if there are past assignments for that shift
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Gets the needed details to be displayed
                    $get_details = "SELECT * FROM Shifts WHERE Shift_ID='$Shift_ID'";
                    $details = $conn->query($get_details)->fetch_assoc();
                    $guardID = $row["Person_ID"]; 
                    $guard = $conn->query("SELECT Name FROM Guards WHERE Person_ID = '$guardID'")->fetch_assoc()["Name"];
                    $status = $row["Assign_Status"] == 1 ? "Active" : "Inactive";
                    $startDate = $row["Assignment_Date"];
                    $endDate = $row["End_Date"] ?? "----------"; 

                    echo "<tr>
                            <td align='center'>" . $row["Assignment_ID"] . "</td>
                            <td align='center'>" . $guard . "</td>
                            <td align='center'>" . $startDate . "</td>
                            <td align='center'>" . $endDate . "</td>
                            <td align='center'>" . $status . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td class='center' colspan='5' align='center'>NO AVAILABLE HISTORY</td></tr>";
            }
            echo "<div align='center'><button class='back' type='submit' onClick='history.go(-1);'>Back</button></div>";
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
