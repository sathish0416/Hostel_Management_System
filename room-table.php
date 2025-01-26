<?php
$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

mysqli_select_db($connection, "hostel");
$query = "CREATE TABLE IF NOT EXISTS rooms (
    Room_No INT PRIMARY KEY,
    Capacity INT NOT NULL,
    AC_Non_AC VARCHAR(10),
    Availability INT,
    Fees INT
)";

if (mysqli_query($connection, $query)) {
    $insertQuery = "INSERT INTO rooms VALUES
        (1, 2, 'AC', 2, 7000),
        (2, 2, 'AC', 2, 7000),
        (3, 2, 'NONAC', 2, 5500),
        (4, 2, 'AC', 2, 5500),
        (5, 3, 'AC', 3, 6500),
        (6, 3, 'AC', 3, 6500),
        (7, 3, 'NONAC', 3, 5000),
        (8, 3, 'NONAC', 3, 5000),
        (9, 4, 'AC', 4, 6000),
        (10, 4, 'AC', 4, 6000),
        (11, 4, 'NONAC', 4, 4500),
        (12, 4, 'NONAC', 4, 4500),
        (13, 5, 'NONAC', 5, 5500),
        (14, 5, 'NONAC', 5, 4000),
        (15, 5, 'NONAC', 5, 4500),
        (16, 5, 'NONAC', 5, 4500)
    ";

    if (mysqli_query($connection, $insertQuery)) {
        echo "Values inserted into 'rooms' table successfully.";
    } else {
        echo "Error inserting values: " . mysqli_error($connection);
    }
} else {
    echo "Error creating table: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
