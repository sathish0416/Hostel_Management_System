<?php
$connection = mysqli_connect("localhost", "root", "", "hostel");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(30) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL
)";

if (mysqli_query($connection, $sql)) {
    echo "Table 'users' created successfully";
} else {
    echo "Error creating table: " . mysqli_error($connection);
}

mysqli_close($connection);
?>