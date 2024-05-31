<?php
$conn = new mysqli("localhost", "root", "");

// Creates the database
$create_DB = "CREATE DATABASE IF NOT EXISTS SecurityForces"; 
if ($conn->query($create_DB) === TRUE) { 
    echo ""; 
} else { 
    echo "Error creating database: " . $conn->error; 
}

$conn->close();
$conn = new mysqli("localhost", "root", "", "SecurityForces"); 


// Creates the table Guards
$create_guards = "CREATE TABLE IF NOT EXISTS `Guards` (
    `Person_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Name` varchar(40) NOT NULL,
    `Age` int(2) NOT NULL CHECK(Age between 0 and 99),
    `Sex` varchar(1) NOT NULL,
    `Address` varchar(60) NOT NULL,
    `Contact_Number` int(11) NOT NULL,
    `Active_Status` boolean NOT NULL DEFAULT true,
    PRIMARY KEY(`Person_ID`)
)";

if ($conn->query($create_guards) === TRUE) { 
    echo ""; 
} else { 
    echo "Error creating table: " . $conn->error; 
}

// Creates the table Timeslots
$create_timeslots = "CREATE TABLE IF NOT EXISTS `Timeslots` (
    `Timeslot_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Time` varchar(13) NOT NULL,
    PRIMARY KEY(`Timeslot_ID`)
)";

if ($conn->query($create_timeslots) === TRUE) { 
    echo ""; 
} else { 
    echo "Error creating table: " . $conn->error; 
}

// Creates the table Areas
$create_areas = "CREATE TABLE IF NOT EXISTS `Areas` (
    `Area_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Area_Name` varchar(30) NOT NULL,
    PRIMARY KEY(`Area_ID`)
)";

if ($conn->query($create_areas) === TRUE) { 
    echo ""; 
} else { 
    echo "Error creating table: " . $conn->error; 
}

// Creates the table Shifts
$create_shifts = "CREATE TABLE IF NOT EXISTS `Shifts` (
    `Shift_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Timeslot_ID` int(5) UNSIGNED NOT NULL,
    `Area_ID` int(5) UNSIGNED NOT NULL,
    `Working_Days` varchar(8) NOT NULL,
    PRIMARY KEY(`Shift_ID`),
    FOREIGN KEY(`Timeslot_ID`) REFERENCES Timeslots(`Timeslot_ID`),
    FOREIGN KEY(`Area_ID`) REFERENCES Areas(`Area_ID`)
)";

if ($conn->query($create_shifts) === TRUE) { 
    echo ""; 
} else { 
    echo "Error creating table: " . $conn->error; 
}

// Creates the table Assigned
$create_assigned = "CREATE TABLE IF NOT EXISTS `Assigned` (
    `Assignment_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `Person_ID` int(5) UNSIGNED NOT NULL,
    `Shift_ID` int(5) UNSIGNED NOT NULL,
    `Assignment_Date` date NOT NULL,
    `End_Date` date,
    `Assign_Status` boolean NOT NULL DEFAULT true,
    PRIMARY KEY(`Assignment_ID`),
    FOREIGN KEY(`Person_ID`) REFERENCES Guards(`Person_ID`),
    FOREIGN KEY(`Shift_ID`) REFERENCES Shifts(`Shift_ID`)
)";

if ($conn->query($create_assigned) === TRUE) { 
    echo ""; 
} else { 
    echo "Error creating table: " . $conn->error; 
}  

$conn->close()
?>