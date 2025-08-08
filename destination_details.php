<?php
session_start();
include('db_connect.php');


if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid destination'); window.location.href='destinations.php';</script>";
    exit();
}

$id = (int) $_GET['id'];
$query = "SELECT * FROM destinations WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) != 1) {
    echo "<script>alert('Destination not found'); window.location.href='destinations.php';</script>";
    exit();
}

$destination = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($destination['name']); ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        .destination-image {
            max-height: 350px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
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
                        <a class="nav-link active" href="destinations.php">Destination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hotels.php">Hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
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

    <!-- Destination Details -->
    <div class="container mt-5">
        <div class="row align-items-start" data-aos="fade-up">
            <div class="col-md-5 mb-4 mb-md-0" data-aos="fade-right">
                <img src="<?php echo htmlspecialchars($destination['image_url']); ?>"
                    alt="<?php echo htmlspecialchars($destination['name']); ?>"
                    class="img-fluid destination-image w-100">
            </div>

            <div class="col-md-7" data-aos="fade-left">
                <h2><?php echo htmlspecialchars($destination['name']); ?></h2>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($destination['location']); ?></p>
                <h4>Overview</h4>
                <p><?php echo htmlspecialchars($destination['description']); ?></p>
            </div>
        </div>


        <!-- Reviews -->
        <h4 class="mt-5">Reviews</h4>
        <?php
        $review_query = "SELECT * FROM destination_reviews WHERE destination_id = $id ORDER BY review_date DESC LIMIT 5";
        $review_result = mysqli_query($conn, $review_query);

        if (mysqli_num_rows($review_result) > 0) {
            while ($review = mysqli_fetch_assoc($review_result)) {
                echo '<div class="border p-3 mb-2">';
                echo '<strong>' . htmlspecialchars($review['user_email']) . '</strong> rated ' . (int) $review['rating'] . '★<br>';
                echo '<em>' . htmlspecialchars($review['comment']) . '</em><br>';
                echo '<small>' . date('d M Y', strtotime($review['review_date'])) . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p>No reviews yet.</p>';
        }
        ?>

        <!-- Buttons -->
        <a href="submit_review.php?destination_id=<?php echo $id; ?>" class="btn btn-warning mt-3">Write a Review</a>
        <a href="hotels.php?destination_id=<?php echo $id; ?>" class="btn btn-success mt-3">Book Nearby Hotel</a>
        <a href="destinations.php" class="btn btn-secondary mt-3">Back to Destinations</a>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,  // animation duration in ms
            once: true      // animation runs only once
        });
    </script>


</body>

</html>