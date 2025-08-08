<?php
session_start();
include('db_connect.php');

// Check user login
if (!isset($_SESSION['email'])) {
    header('location:login.php?error=Please login first');
    exit();
}

// Get hotel name from URL
$hotel_name = isset($_GET['hotel_name']) ? urldecode($_GET['hotel_name']) : '';

// On form submission
if (isset($_POST['submit'])) {
    $email = $_SESSION['email'];
    $hotel_name = $_POST['hotel_name'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $guests = $_POST['guests'];

    // Insert into user bookings table
    $query_user = "INSERT INTO bookings (user_email, hotel_name, check_in, check_out, guests)
                   VALUES ('$email', '$hotel_name', '$check_in', '$check_out', '$guests')";

    // Insert into admin bookings table
    $query_admin = "INSERT INTO admin_bookings (user_email, hotel_name, check_in, check_out, guests)
                    VALUES ('$email', '$hotel_name', '$check_in', '$check_out', '$guests')";

    $success_user = mysqli_query($conn, $query_user);
    $success_admin = mysqli_query($conn, $query_admin);

    if ($success_user && $success_admin) {
        echo "<script>alert('Hotel booked successfully!'); window.location.href='my_bookings.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Hotel</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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
                        <a class="nav-link active" href="hotels.php">Hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="about.php">About Us</a>
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

    <div class="container mt-5">
        <h2 class="mb-4">Book Hotel</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Hotel Name</label>
                <input type="text" name="hotel_name" class="form-control"
                    value="<?php echo htmlspecialchars($hotel_name); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Check-in Date</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Check-out Date</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Guests</label>
                <input type="number" name="guests" class="form-control" min="1" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Confirm Booking</button>
            <a href="hotels.php" class="btn btn-secondary">Back to Hotels</a>
        </form>
    </div>

    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>