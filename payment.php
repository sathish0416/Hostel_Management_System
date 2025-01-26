<?php
session_start();

if (isset($_POST['pay'])) {
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $connection = mysqli_connect("localhost", "root", "", "hostel");
    if (!$connection) {
        die("Could not connect: " . mysqli_connect_error());
    }

    $createTableQuery = "CREATE TABLE IF NOT EXISTS payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        room_id INT NOT NULL,
        name VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        address TEXT NOT NULL,
        phone VARCHAR(20) NOT NULL,
        payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($connection, $createTableQuery)) {
        $room_id = $_POST['room_id'];
        $insertQuery = "INSERT INTO payments (room_id, name, username, address, phone) VALUES ('$room_id', '$name', '$username', '$address', '$phone')";
        if (mysqli_query($connection, $insertQuery)) {
            $updateQuery = "UPDATE rooms SET Availability = Availability - 1 WHERE Room_No = '$room_id'";
            if (mysqli_query($connection, $updateQuery)) {
                echo "Payment details stored successfully. Room capacity updated.";
                header("Location: Hostel.html");
            } else {
                echo "Error updating room capacity: " . mysqli_error($connection);
            }
        } else {
            echo "Error storing payment details: " . mysqli_error($connection);
        }
    } else {
        echo "Error creating table: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    header("Location: room-details.php");
    exit();
}
?>