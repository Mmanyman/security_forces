<?php
$conn = new mysqli("localhost", "root", "", "SecurityForces");

// Adds all the possible timeslots to the database
if ($conn->query("SELECT * FROM Timeslots")->num_rows == 0) {
    $conn->query("INSERT INTO `Timeslots`(`Time`) VALUES ('09:00-17:00')");
    $conn->query("INSERT INTO `Timeslots`(`Time`) VALUES ('14:00-22:00')");
    $conn->query("INSERT INTO `Timeslots`(`Time`) VALUES ('22:00-06:00')");
    $conn->query("INSERT INTO `Timeslots`(`Time`) VALUES ('06:00-14:00')");
    $conn->query("INSERT INTO `Timeslots`(`Time`) VALUES ('21:00-05:00')");
}

// Adds all the possible areas to the database
if ($conn->query("SELECT * FROM Areas")->num_rows == 0) {
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Box 1')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Box 2')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('New Admin')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Old Admin')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('CUB')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('CAS')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('SOTECH')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('CFOS')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('CM')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Wet and Dry Labs')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Hatchery')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Dorm Area')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Staff House')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('HSU')");
    $conn->query("INSERT INTO `Areas`(`Area_Name`) VALUES ('Executive House')");
}

// Adds the all possible shifts to the database
if ($conn->query("SELECT * FROM Shifts")->num_rows == 0) {
    // Gets the timeslot IDs
    $time1_id = $conn->query("SELECT Timeslot_ID FROM Timeslots WHERE Time='09:00-17:00'")->fetch_assoc()["Timeslot_ID"];
    $time2_id = $conn->query("SELECT Timeslot_ID FROM Timeslots WHERE Time='14:00-22:00'")->fetch_assoc()["Timeslot_ID"];
    $time3_id = $conn->query("SELECT Timeslot_ID FROM Timeslots WHERE Time='22:00-06:00'")->fetch_assoc()["Timeslot_ID"];
    $time4_id = $conn->query("SELECT Timeslot_ID FROM Timeslots WHERE Time='06:00-14:00'")->fetch_assoc()["Timeslot_ID"];
    $time5_id = $conn->query("SELECT Timeslot_ID FROM Timeslots WHERE Time='21:00-05:00'")->fetch_assoc()["Timeslot_ID"];

    // Gets the area IDs
    $area01_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Box 1'")->fetch_assoc()["Area_ID"];
    $area02_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Box 2'")->fetch_assoc()["Area_ID"];
    $area03_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='New Admin'")->fetch_assoc()["Area_ID"];
    $area04_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Old Admin'")->fetch_assoc()["Area_ID"];
    $area05_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='CUB'")->fetch_assoc()["Area_ID"];
    $area06_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='CAS'")->fetch_assoc()["Area_ID"];
    $area07_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='SOTECH'")->fetch_assoc()["Area_ID"];
    $area08_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='CFOS'")->fetch_assoc()["Area_ID"];
    $area09_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='CM'")->fetch_assoc()["Area_ID"];
    $area10_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Wet and Dry Labs'")->fetch_assoc()["Area_ID"];
    $area11_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Hatchery'")->fetch_assoc()["Area_ID"];
    $area12_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Dorm Area'")->fetch_assoc()["Area_ID"];
    $area13_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Staff House'")->fetch_assoc()["Area_ID"];
    $area14_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='HSU'")->fetch_assoc()["Area_ID"];
    $area15_id = $conn->query("SELECT Area_ID FROM Areas WHERE Area_Name='Executive House'")->fetch_assoc()["Area_ID"];

    // Box 1 01
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area01_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area01_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area01_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area01_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area01_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area01_id', 'Weekend')");

    // Box 2 02
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area02_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area02_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area02_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area02_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area02_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area02_id', 'Weekend')");

    // New Admin 03
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area03_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area03_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area03_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area03_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area03_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area03_id', 'Weekend')");

    // Old Admin 04
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time1_id', '$area04_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time1_id', '$area04_id', 'Weekend')");

    // CUB 05
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area05_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area05_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area05_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area05_id', 'Weekend')");

    // CAS 06
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area06_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area06_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area06_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area06_id', 'Weekend')");

    // SOTECH 07
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area07_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area07_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area07_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area07_id', 'Weekend')");

    // CFOS 08
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area08_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area08_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area08_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area08_id', 'Weekend')");

    // CM 09
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area09_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area09_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area09_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area09_id', 'Weekend')");

    // Wet and Dry Labs 10
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area10_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area10_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area10_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area10_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area10_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area10_id', 'Weekend')");

    // Hatchery 11
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area11_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area11_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area11_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area11_id', 'Weekend')");

    // Dorm Area 12
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area12_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area12_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area12_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area12_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area12_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area12_id', 'Weekend')");

    // Staff House 13
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time5_id', '$area13_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time5_id', '$area13_id', 'Weekend')");

    // HSU 14
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area14_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area14_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area14_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area14_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area14_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area14_id', 'Weekend')");
    
    // Executive House 15
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area15_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time2_id', '$area15_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area15_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time3_id', '$area15_id', 'Weekend')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area15_id', 'Weekday')");
    $conn->query("INSERT INTO `Shifts`(`Timeslot_ID`, `Area_ID`, `Working_Days`) VALUES ('$time4_id', '$area15_id', 'Weekend')");
}

$conn->close();
?>