<?php
$conn = mysqli_connect("localhost", "root", "", "hostel");
if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'reviews' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
