<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="shifts.css" />
</head>
<body>
    <!--Displays all the guards in the database along with their details-->
    <div class="guardsTable">
        <h2 style="color: black;"></h2>
        <table style="width: 100%;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        <?php
            $conn = new mysqli("localhost", "root", "", "SecurityForces");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql_guard_list = "SELECT * FROM guards";
            $list = $conn->query($sql_guard_list);

            // Checks if there are guards in the database
            if ($list->num_rows > 0) {
                while($row = $list->fetch_assoc()) {
                    $status = "Active";
                    if ($row["Active_Status"] == 0) {
                        $status = "Inactive";
                    }
                    echo "<tr>" .
                        "<td align='center'>" . $row["Person_ID"] . "</td>" .
                        "<td align='center'>" . $row["Name"] . "</td>" .
                        "<td align='center'>" . $row["Age"] . "</td>" .
                        "<td align='center'>" . $row["Sex"] . "</td>" .
                        "<td align='center'>" . $row["Address"] . "</td>" .
                        "<td align='center'>" . $row["Contact_Number"] . "</td>" .
                        "<td align='center'>" . $status . "</td>" .
                        "<td align='center'>
                            <form action='updateGuard.php' method='POST'>
                                <input type='hidden' name='Person_ID' value='" . $row["Person_ID"] . "'>
                                <button class='tableButton' type='submit'>Update</button>
                            </form>
                            <form action='checkHistory.php' method='POST'>
                                <input type='hidden' name='Person_ID' value='" . $row["Person_ID"] . "'>
                                <button class='tableButton' type='submit'>Check History</button>
                            </form>
                        </td>" .
                        "</tr>";
                }
            } else {
                echo "<tr><td class='center' colspan='8' align='center'>NO GUARDS FOUND</td></tr>";
            }

            $conn->close();
        ?>
        </table>
    </div>
</body>
</html>
