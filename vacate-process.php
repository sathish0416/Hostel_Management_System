<?php
session_start(); 

if (isset($_POST['room_id'])) {
    $roomId = $_POST['room_id'];

    $connection = mysqli_connect("localhost", "root", "", "hostel");
    if (!$connection) {
        die("Could not connect: " . mysqli_connect_error());
    }

    mysqli_begin_transaction($connection);

    $updateQuery = "UPDATE rooms SET Availability = Availability + 1 WHERE Room_No = '$roomId'";
    if (mysqli_query($connection, $updateQuery)) {
        $deleteQuery = "DELETE FROM payments WHERE room_id = '$roomId'";
        if (mysqli_query($connection, $deleteQuery)) {
            mysqli_commit($connection);
            header("Location: Hostel.html"); 
            exit();
        } else {
            mysqli_rollback($connection);
            echo "Error deleting payment details: " . mysqli_error($connection);
        }
    } else {
        mysqli_rollback($connection);
        echo "Error updating capacity: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    header("Location: Hostel.html");
    exit();
}
?>