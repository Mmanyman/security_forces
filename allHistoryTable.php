<?php
$conn = new mysqli("localhost", "root", "", "SecurityForces");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<head>
    <link rel='stylesheet' type='text/css' href='popup.css' />
    <link rel='stylesheet' type='text/css' href='shifts.css'/>
</head>";

// Display all history assignments
echo "<h2 id='colorsTitle' align='center'>Assignment History</h2>";
echo "<table>
        <tr>
            <th>Assignment ID</th>
            <th>Guard Name</th>
            <th>Area Name</th>
            <th>Timeslot</th>
            <th>Assignment Date</th>
            <th>End Date</th>
            <th>Action</th>
        </tr>";

$sql = "SELECT a.Assignment_ID, g.Name, ar.Area_Name, t.Time, a.Assignment_Date, a.End_Date
        FROM Assigned a
        JOIN Guards g ON a.Person_ID = g.Person_ID 
        JOIN Shifts s ON a.Shift_ID = s.Shift_ID
        JOIN Areas ar ON s.Area_ID = ar.Area_ID
        JOIN Timeslots t ON s.Timeslot_ID = t.Timeslot_ID
        ORDER BY a.Assignment_ID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $aSSID = $row["Assignment_ID"];
        $endDate = $row["End_Date"] ?? "----------";
        echo "<tr>
                <td>" . $row["Assignment_ID"] . "</td>
                <td>" . $row["Name"] . "</td>
                <td>" . $row["Area_Name"] . "</td>
                <td>" . $row["Time"] . "</td>
                <td>" . $row["Assignment_Date"] . "</td>
                <td>" . $endDate . "</td>
                <td align='center'>
                    <div class='box'>
                        <button class='tableButton' onclick='showStartPopup($aSSID)'>Update Start Date</button>
                        <br>
                        <button class='tableButton' onclick='showEndPopup($aSSID)'>Update End Date</button>
                    </div>
                </td>
                </tr>";
    }
} else {
    echo "<tr><td class='center' colspan='7' align>NO ASSIGNMENT FOUND</td></tr>";
}

echo "</table>";

echo "<div class='overlay' id='startBox'>
        <div class='wrapper'>
            <h2>Update Start Date</h2>
            <a class='close' href='#' onclick='hideStartPopup()'>&times;</a>
            <div class='content'>
                <div class='container'>
                    <form action='' method='POST'>
                        <label>Start Assignment</label><br>
                        <input type='date' name='assign_date' required><br>
                        <input type='hidden' id='start_id' name='assignment_id'>
                        <button type='submit' value='Update' class='back' name='StartButton'>Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";

echo "<div class='overlay' id='endBox'>
        <div class='wrapper'>
            <h2>Update End Date</h2>
            <a class='close' href='#' onclick='hideEndPopup()'>&times;</a>
            <div class='content'>
                <div class='container'>
                    <form action='' method='POST'>
                        <label>End Assignment</label><br>
                        <input type='date' name='assign_date' required><br>
                        <input type='hidden' id='end_id' name='assignment_id'>
                        <button type='submit' value='Update' class='back' name='EndButton'>Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";



    if (isset($_POST['StartButton'])) {

        $assignDate = $_POST["assign_date"];
        $assignID = $_POST["assignment_id"];

        $updateDate = "UPDATE Assigned
                        SET Assignment_Date = '$assignDate' WHERE Assignment_ID = '$assignID'";

        if ($conn->query($updateDate) == TRUE){
            echo "<p>Updated Successfully!</p>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<p>Error updating record: " . $conn->error . "</p>";
        }
    }

    if (isset($_POST['EndButton'])) {

        $assignDate = $_POST["assign_date"];
        $assignID = $_POST["assignment_id"];

        $updateDate = "UPDATE Assigned
                        SET End_Date = '$assignDate', Assign_Status = 0 WHERE Assignment_ID = '$assignID'";

        if ($conn->query($updateDate) == TRUE){
            echo "<p>Updated Successfully!</p>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<p>Error updating record: " . $conn->error . "</p>";
        }
    }

$conn->close();
?>

<script>
function showStartPopup(assignmentId) {
    document.getElementById('startBox').style.display = 'block';
    document.getElementById('start_id').value = assignmentId;
}

function hideStartPopup() {
    document.getElementById('startBox').style.display = 'none';
}

function showEndPopup(assignmentId) {
    document.getElementById('endBox').style.display = 'block';
    document.getElementById('end_id').value = assignmentId;
}

function hideEndPopup() {
    document.getElementById('endBox').style.display = 'none';
}
</script>
