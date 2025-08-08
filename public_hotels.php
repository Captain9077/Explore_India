<?php
session_start();
include('db_connect.php');

$user_email = $_SESSION['email'] ?? 'Guest';

// Fetch hotels with their destination
$hotels_query = "SELECT hotels.*, destinations.location 
                 FROM hotels 
                 LEFT JOIN destinations ON hotels.destination_id = destinations.id";

if (isset($_GET['destination_id']) && is_numeric($_GET['destination_id'])) {
    $destination_id = (int) $_GET['destination_id'];
    $hotels_query .= " WHERE hotels.destination_id = $destination_id";
}

$result = mysqli_query($conn, $hotels_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hotels - Explore India</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Explore <img src="images/india_.png" alt="" style="height: 50px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link " href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="public_destinations.php">Destination</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="public_hotels.php">Hotel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="public_about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="public_contact.php">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <!-- Hotels List -->
    <div class="container mt-5">
        <h3 class="mb-4">Available Hotels</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $hotel_id = $row['id'];

                    // Average rating
                    $rating_sql = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews 
                               FROM reviews WHERE hotel_id = $hotel_id";
                    $rating_result = mysqli_query($conn, $rating_sql);
                    $rating_data = mysqli_fetch_assoc($rating_result);
                    $avg_rating = round($rating_data['avg_rating'], 1);
                    $total_reviews = $rating_data['total_reviews'];

                    // Recent reviews
                    $review_sql = "SELECT user_email, rating, comment, review_date 
                               FROM reviews WHERE hotel_id = $hotel_id ORDER BY review_date DESC LIMIT 3";
                    $review_result = mysqli_query($conn, $review_sql);
                    ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($row['image_url'])): ?>
                                <img src="<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="Hotel Image"
                                    style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="card-text text-muted mb-1">Location: <?= htmlspecialchars($row['location']) ?></p>
                                <p class="card-text"><strong>₹<?= number_format($row['price']) ?></strong> / night</p>

                                <!-- Average Rating -->
                                <p><strong>Rating:</strong>
                                    <?= $total_reviews > 0 ? "$avg_rating ★ ($total_reviews reviews)" : "No reviews yet"; ?>
                                </p>

                                <!-- Buttons -->
                                <div class="mb-3">
                                    <a href="book_hotel.php?hotel_name=<?= urlencode($row['name']) ?>"
                                        class="btn btn-success btn-sm">Book Now</a>
                                    <a href="submit_review.php?hotel_id=<?= $hotel_id ?>"
                                        class="btn btn-outline-warning btn-sm">Write a Review</a>
                                </div>

                                <!-- Recent Reviews -->
                                <?php if ($total_reviews > 0): ?>
                                    <h6 class="mt-3">Recent Reviews:</h6>
                                    <?php while ($rev = mysqli_fetch_assoc($review_result)) { ?>
                                        <div class="border rounded p-2 mb-2 bg-light">
                                            <strong><?= htmlspecialchars($rev['user_email']) ?></strong> rated it
                                            <strong><?= $rev['rating'] ?> ★</strong><br>
                                            <small class="text-muted"><?= $rev['review_date'] ?></small><br>
                                            <em><?= htmlspecialchars($rev['comment']) ?></em>
                                        </div>
                                    <?php } ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="col">
                    <div class="alert alert-info w-100">No hotels found for this destination.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'public_footer.php'; ?>

</body>

</html>