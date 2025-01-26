<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rooms Details</title>
<style>
    body {
        margin: 0;
        background-color: #f4f4f4;
    }
    .navbar {
        background-color: #333;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }
    .nav-link {
        color: #fff;
        text-decoration: none;
        padding: 8px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .nav-link:hover {
        background-color: #555;
    }
    .logo {
        width: 120px;
        height: 50px;
    }
    .nav-links {
        display: flex;
        align-items: center;
    }
    .nav-link:not(:first-child) {
        margin-left: 10px;
    }
    .room-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        padding: 20px;
    }
    .room-box {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin: 10px;
        width: 250px;
        background-color: #fff;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .room-box:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    }
    .room-box h3 {
        margin-bottom: 10px;
        color: #333;
    }
    .room-box p {
        color: #666;
    }
    .book-btn {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .book-btn:hover {
        background-color: #45a049;
    }
    h1 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }
</style>
</head>
<body>
<nav class="navbar">
    <img src="hostel_logo.jpg" class="logo">
    <div class="nav-links">
        <a href="Hostel.html" class="nav-link">Home</a>
        <a href="room-details.php" class="nav-link">Rooms</a>
        <a href="vacate.php" class="nav-link">Vacate</a>
        <a href="Food.html" class="nav-link">Food Menu</a>
        <a href="reviews.php" class="nav-link">Review</a>
        <a href="logout.php" class="nav-link">Logout</a>
    </div>
</nav>
<h1>Rooms Details</h1>
<div class="room-container">
<?php
$connection = mysqli_connect("localhost", "root", "", "hostel");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

$query = "SELECT * FROM rooms";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='room-box'>";
        echo "<h3>Room " . $row['Room_No'] . "</h3>";
        echo "<p>Capacity: " . $row['Capacity'] . "</p>";
        echo "<p>AC/Non-AC: " . $row['AC_Non_AC'] . "</p>";
        echo "<p>Availability: " . $row['Availability'] . "</p>";
        echo "<p>Fees: " . $row['Fees'] . "</p>";
        if ($row['Availability'] > 0) {
            echo "<form method='POST' action='booking.php'>";
            echo "<input type='hidden' name='room_id' value='" . $row['Room_No'] . "'>";
            echo "<input type='submit' class='book-btn' value='Book'>";
            echo "</form>";
        } else {
            echo "<button onclick='showAlert()'>Room is Full</button>";
        }
        echo "</div>";
    }
} else {
    echo "No rooms found.";
}

mysqli_close($connection);
?>

<script>
    function showAlert() {
        alert("Room is full.");
    }
</script>

</div>
<script>
    function bookRoom(roomId) {
        // Redirect to booking page with room ID
        window.location.href = 'booking.php?room_id=' + roomId;
    }
</script>

</body>
</html>