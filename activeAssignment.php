<?php
$conn = new mysqli("localhost", "root", "", "SecurityForces");

// Displays all unassigned shifts
echo "<head>

    <link rel='stylesheet' type='text/css' href='shifts.css'/>

    </head>";

// Display active assignments
echo "<h2 id='colorsTitle' align='center'>Active Assignment</h2>";
echo "<tr>
            <th>Shift ID</th>
            <th>Timeslot</th>
            <th>Area Name</th>
            <th>Working Days</th>
            <th>Assigned</th>
            <th>Action</th>
        </tr>";

$shifts = "SELECT * FROM Shifts WHERE Shift_ID IN (SELECT Shift_ID FROM Assigned WHERE Assign_Status = 1)";
$result = $conn->query($shifts);

// Gets active assignments
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shiftID = $row["Shift_ID"];
        $areaID = $row["Area_ID"];
        $timeID = $row["Timeslot_ID"];

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

        // Get guard name
        $getGuard = "SELECT Guards.Name
                    FROM Guards INNER JOIN Assigned ON Guards.Person_ID = Assigned.Person_ID
                    WHERE Assigned.Shift_ID='$shiftID' AND Assigned.Assign_Status=1";
        $getGuardResult = $conn->query($getGuard);
        $guardRow = $getGuardResult->fetch_assoc();
        $guard = $guardRow["Name"];

        echo "<tr>
                <td align='center'>" . $shiftID . "</td>
                <td align='center'>" . $time . "</td>
                <td align='center'>" . $area . "</td>
                <td align='center'>" . $row["Working_Days"] . "</td>
                <td align='center'>" . $guard . "</td>
                <td align='center'>
                    <form action='removeGuard.php' method='POST'>
                        <input type='hidden' name='shiftID' value='" . $shiftID . "'>
                        <button class='tableButton' type='submit'>Remove</button>
                    </form>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td class='center' colspan='6' align='center'>NO ACTIVE ASSIGNMENTS</td></tr>";
};

$conn->close();
?>
