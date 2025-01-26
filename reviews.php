<?php
$connection = mysqli_connect("localhost", "root", "", "hostel");
if (!$connection) {
    die("Could not connect: " . mysqli_connect_error());
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO reviews (name, rating, comment) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sis", $name, $rating, $comment);
    $stmt->execute();
    $stmt->close();

    header("Location: reviews.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <style>
        body {
            margin: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
        }
        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 8px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .nav-link:hover,
        .nav-link.active {
            background-color: #555;
        }
        .logo {
            order: 0;
        }
        .nav-links {
            display: flex;
        }
        .nav-link:not(:first-child) {
            margin-left: 10px;
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
            margin-bottom: 20px;
            color: #333;
        }
        .reviews {
            margin-top: 20px;
        }
        .review {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .rating {
            color: orange;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
        }
        .form-container input,
        .form-container textarea,
        .form-container button {
            margin-bottom: 10px;
            padding: 8px;
        }
        .form-container label {
            margin-bottom: 5px;
        }
        .form-container button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <img src="hostel_logo.jpg" class="nav-link logo" width="120px" height="50px">
    <div class="nav-links">
        <a href="Hostel.html" class="nav-link">Home</a>
        <a href="rooms.html" class="nav-link">Rooms</a>
        <a href="vacate.php" class="nav-link">Vacate</a>
        <a href="Food.html" class="nav-link">Food Menu</a>
        <a href="reviews.php" class="nav-link active">Review</a>
        <a href="logout.php" class="nav-link">Logout</a>
    </div>
</nav>
<div class="container">
    <h1>User Reviews</h1>
    <div class="reviews">
        <?php
        $sql = "SELECT * FROM reviews";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Rating:</strong> ";
                for ($i = 0; $i < $row['rating']; $i++) {
                    echo "<span class='rating'>&#9733;</span>";
                }
                echo "</p>";
                echo "<p><strong>Comment:</strong> " . $row['comment'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No reviews found.</p>";
        }
        ?>
    </div>
    <div class="form-container">
        <h2>Add a Review</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>

            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>

            <button type="submit">Submit Review</button>
        </form>
    </div>
</div>
</body>
</html>