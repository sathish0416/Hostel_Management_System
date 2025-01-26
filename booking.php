<?php
session_start();

if (!isset($_POST['room_id'])) {
    header("Location: payment.php"); 
    exit();
}

$selectedRoomId = $_POST['room_id'];
$connection = mysqli_connect("localhost", "root", "", "hostel");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

$query = "SELECT * FROM rooms WHERE Room_No = '$selectedRoomId'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Room details not found.";
    exit();
}


mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
          body{
            margin:0;
            background-color: #777;
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
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            color: #000;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"] {
            width: 90%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
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
        </div>
    </nav>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <b><p>Room Details:</p></b>
        <p><b>Room Number:</b> <?php echo $row['Room_No']; ?></p>
        <p><b>Capacity:</b> <?php echo $row['Capacity']; ?></p>
        <p><b>AC/Non-AC:</b> <?php echo $row['AC_Non_AC']; ?></p>
        <p><b>Availability:</b> <?php echo $row['Availability']; ?></p>
        <p><b>Fees:</b> <?php echo $row['Fees']; ?></p>
        <hr>
        <form method="POST" action="payment.php">
            <input type="hidden" name="room_id" value="<?php echo $selectedRoomId; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address" required><br>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required><br>
            <button type="submit" name="pay" onclick="alert('Your payment is successfull')">Pay Now</button>
        </form>
    </div>
</body>
</html>
