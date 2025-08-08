<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['email'])) {
    header('location:login.php?error=You Are not admin');
    exit();
}

$user_email = $_SESSION['email'];

if (!isset($_GET['hotel_id'])) {
    header("Location: hotels.php");
    exit();
}

$hotel_id = $_GET['hotel_id'];

// Get hotel name
$hotel_result = mysqli_query($conn, "SELECT name FROM hotels WHERE id = $hotel_id");
$hotel = mysqli_fetch_assoc($hotel_result);

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $insert = "INSERT INTO reviews (user_email, hotel_id, rating, comment)
               VALUES ('$user_email', '$hotel_id', '$rating', '$comment')";

    if (mysqli_query($conn, $insert)) {
        $success = "Review submitted successfully!";
    } else {
        $error = "Failed to submit review. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Submit Review - Explore India</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="main.js"></script>
</head>

<body>

    <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Explore <img src="images/india_.png" alt=""
                    style="height: 50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="destinations.php">Destination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hotels.php">Hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_bookings.php">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Section -->
    <div class="container mt-5">
        <h3>Review for <?php echo $hotel['name']; ?></h3>

        <?php if (isset($success)) { ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Rating (1 to 5)</label>
                <select class="form-select" name="rating" required>
                    <option value="">-- Select Rating --</option>
                    <option value="1">1 ★</option>
                    <option value="2">2 ★★</option>
                    <option value="3">3 ★★★</option>
                    <option value="4">4 ★★★★</option>
                    <option value="5">5 ★★★★★</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Comment</label>
                <textarea class="form-control" name="comment" rows="4" required
                    placeholder="Share your experience..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
    <?php include 'contact.php'; ?>
    <?php include 'footer.php'; ?>

</body>

</html>