<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vacate Rooms</title>
<style>
    body {
        margin: 0;
        background-color: #f4f4f4;
        }
        .navbar{
            background-color:#333;
            display:flex;
            justify-content:space-between;
            align-items:center; 
            padding:5px;
        }
        .nav-link{
            color:#fff;
            text-decoration:none;
            padding:8px 10px;
            border-radius:5px;
            transition:background-color 0.3s ease;
        }
        .nav-link:hover{
            background-color:#555;
        }
        .nav-link.active{
            background-color:#555;
        }
        .logo{
            order:0;
        }
        .nav-link:not(:first-child){
            margin-left:10px;
        }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333;
    }
    .room-box {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }
    .room-details {
        margin-bottom: 10px;
    }
    .vacate-btn {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .vacate-btn:hover {
        background-color: #c0392b;
    }
</style>
</head>
<body>
<nav class="navbar">
        <img src="hostel_logo.jpg" class="nav-link" width="120px" height="50px" class="logo">
        <div class="nav-links">
            <a href="Hostel.html" class="nav-link">Home</a>
            <a href="room-details.php" class="nav-link">Rooms</a>
            <a href="vacate.php" class="nav-link">Vacate</a>
            <a href="Food.html" class="nav-link">Food Menu</a>
            <a href="reviews.php" class="nav-link">Review</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>
    </nav>
<div class="container">
    <h1>Vacate Rooms</h1>
    <?php
session_start(); // Start the session

$connection = mysqli_connect("localhost", "root", "", "hostel");

if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM payments WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='room-box'>";
            echo "<div class='room-details'>";
            echo "<strong>Room Number:</strong> " . $row['room_id'] . "<br>";
            echo "<strong>Name:</strong> " . $row['name'] . "<br>";
            echo "<strong>Address:</strong> " . $row['address'] . "<br>";
            echo "<strong>Phone Number:</strong> " . $row['phone'] . "<br>";
            echo "</div>";
            echo "<form method='POST' action='vacate-process.php'>";
            echo "<input type='hidden' name='room_id' value='" . $row['room_id'] . "'>";
            echo "<input type='submit' class='vacate-btn' onClick=\"alert('You have successfully vacated the room')\" value='Vacate'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No rooms booked by this user.";
    }

} else {
    echo "Please log in to view booked rooms.";
}

mysqli_close($connection);
?>
</div>
</body>
</html>