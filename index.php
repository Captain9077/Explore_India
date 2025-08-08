<?php
session_start();

include('db_connect.php');


// Handle search and region filters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$region = isset($_GET['region']) ? trim($_GET['region']) : '';

$dest_query = "SELECT * FROM destinations WHERE 1";
$params = [];

if (!empty($search)) {
  $dest_query .= " AND (name LIKE CONCAT('%', ?, '%') OR location LIKE CONCAT('%', ?, '%'))";
  $params[] = $search;
  $params[] = $search;
}
if (!empty($region)) {
  $region_map = [
    'north' => ['Delhi', 'Himachal Pradesh', 'Uttarakhand', 'Punjab', 'Jammu and Kashmir'],
    'south' => ['Kerala', 'Tamil Nadu', 'Karnataka', 'Andhra Pradesh', 'Telangana'],
    'east' => ['West Bengal', 'Odisha', 'Bihar', 'Jharkhand', 'Assam'],
    'west' => ['Rajasthan', 'Gujarat', 'Maharashtra', 'Goa'],
  ];
  $states = $region_map[$region] ?? [];
  if (!empty($states)) {
    $placeholders = implode(',', array_fill(0, count($states), '?'));
    $dest_query .= " AND location IN ($placeholders)";
    $params = array_merge($params, $states);
  }
}

$stmt = mysqli_prepare($conn, $dest_query);
if (!empty($params)) {
  $types = str_repeat('s', count($params));
  mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$dest_result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Explore India</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <script src="js/main.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>
<style>
  #text_gradient {
    font-size: 50px;
    background: -webkit-linear-gradient(rgb(254, 157, 0), rgb(228, 228, 228), rgb(2, 112, 7));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  #text_grad {
    font-size: 30px;
    background: -webkit-linear-gradient(rgb(254, 157, 0), rgb(228, 228, 228), rgb(2, 112, 7));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>

<body>
  <!-- <div class="container mt-4"> -->
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
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="public_destinations.php">Destination</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="public_hotels.php">Hotel</a>
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

  <!-- Hero Section -->
  <div class="position-relative mb-1 mt-2 text-white text-center rounded-3 overflow-hidden">

    <!-- Background Image Layer with Opacity -->
    <!-- <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('images/india map.jpg');
      background-size: cover;
      background-position: center;
      opacity: 0.5;
      z-index: 1;">
    </div> -->


    <!-- Foreground Text Content -->
    <div class="position-relative z-2 py-5 px-3 text-black ">
      <h1 class="display-4 fw-bold">Explore Incredible <span id="text_gradient">India</span> </h1>
      <p class="lead fw-bold">Plan your perfect trip with us. Discover destinations, book hotels, and read reviews.</p>
      <a href="destinations.php" class="btn btn-success btn-lg mt-3">Explore Now</a>
    </div>

  </div>

  <!-- Carousel -->
  <div id="destinationCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">

      <div class="carousel-item active">
        <div class="carousel-img-container" style="height: 520px">
          <img src="images/Goa Beach.jpg" class="d-block w-100" alt="Goa" style="background-position: center">
        </div>
        <!-- <div class="carousel-caption d-none d-md-block">
          <h5 class="text-white">Goa</h5>
          <p>Relax on stunning beaches with lively nightlife.</p>
        </div> -->
      </div>

      <div class="carousel-item">
        <div class="carousel-img-container" style="height: 520px">
          <img src="images/pink city.jpg" class="d-block w-100" alt="Jaipur">
        </div>
        <!-- <div class="carousel-caption d-none d-md-block">
          <h5 class="text-white">Jaipur</h5>
          <p>Explore royal forts and palaces in the Pink City.</p>
        </div> -->
      </div>

      <div class="carousel-item">
        <div class="carousel-img-container" style="height: 520px">
          <img src="images/leh ladak-1.jpg" class="d-block w-100" alt="Leh Ladakh">
        </div>
        <!-- <div class="carousel-caption d-none d-md-block">
          <h5 class="text-white">Leh-Ladakh</h5>
          <p>Adventure in the Himalayas with scenic beauty.</p>
        </div> -->
      </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#destinationCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#destinationCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Search Form -->
  <div class="mb-4 container">
    <h2>Find Your Destination</h2>
    <form method="GET" action="dashboard.php" class="row g-3">
      <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Search for a city or place..."
          value="<?= htmlspecialchars($search) ?>">
      </div>
      <div class="col-md-4">
        <select class="form-select" name="region">
          <option value="">All Regions</option>
          <option value="north" <?= $region == 'north' ? 'selected' : '' ?>>North India</option>
          <option value="south" <?= $region == 'south' ? 'selected' : '' ?>>South India</option>
          <option value="east" <?= $region == 'east' ? 'selected' : '' ?>>East India</option>
          <option value="west" <?= $region == 'west' ? 'selected' : '' ?>>West India</option>
        </select>
      </div>
      <div class="col-md-2 d-flex">
        <button type="submit" class="btn btn-primary me-2 w-100">Search</button>
        <?php if (!empty($search) || !empty($region)): ?>
          <a href="dashboard.php" class="btn btn-outline-secondary w-100">Clear</a>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <!-- Search Results Modal -->
  <?php if (!empty($search) || !empty($region)): ?>
    <div class="modal fade show" style="display:block; background:rgba(0,0,0,0.5);">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Search Results</h5>
            <a href="dashboard.php" class="btn-close"></a>
          </div>
          <div class="modal-body">
            <div class="row row-cols-1 row-cols-md-2 g-4">
              <?php if (mysqli_num_rows($dest_result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($dest_result)): ?>
                  <div class="col">
                    <div class="card h-100">
                      <img src="<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top"
                        alt="<?= htmlspecialchars($row['name']) ?>">
                      <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                        <a href="destination_details.php?id=<?= $row['id'] ?>" class="btn btn-primary">View Details</a>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p>No destinations found.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php include 'Horizontal_Scroll_Carousel.php'; ?>


  <!-- Top Destinations -->
  <div class="container mt-3 py-5 bg-light">
    <div class="highlight-section mt-1 mb-4">
      <div class="row justify-content-center">
        <div class="col-md-6 highlight-text">
          <h3 class="mb-3" id="text_gradient">Explore India</h3>
          <p class="fs-5">"Explore India" is not just a travel guide—it's your immersive passage into the soul of
            India. From the snow-capped peaks of the Himalayas to the sun-kissed beaches of the South, from the vibrant
            festivals of the East to the royal palaces of the West, India is a land of infinite diversity. Every region
            has its own language, cuisine, art, and rhythm of life. Whether you're tracing the spiritual footsteps in
            Varanasi, losing yourself in the colors of Rajasthan, savoring street food in Mumbai, or witnessing dance
            rituals in Tamil Nadu—Explore India is your trusted companion to uncover these cultural tapestries.
            Discover hidden villages, ancient temples, majestic forts, bustling bazaars, and scenic backwaters, all
            while connecting with the warm and hospitable spirit of its people. Let each journey across India become a
            story you’ll carry for a lifetime.</p>
        </div>
        <div class="col-md-6 mt-4 mt-md-0 d-flex justify-content-center align-items-center">
          <div class="highlight-image">
            <img src="images/maha aarti.jpg" alt="Explore Indian Food">
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
      <div class="col">
        <div class="card h-100 shadow-sm d-flex flex-column">
          <span class="heart-icon"><i class="far fa-heart"></i></span>
          <img src="images/Be Bowled Over By Beauty At India’s Iconic Taj Mahal.jpeg" class="card-img-top"
            alt="Taj Mahal">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Taj Mahal - One of the Seven Wonders of the World, the Taj Mahal is a symbol of love.
            </h5>
            <div class="rating">
              <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span> 4.9 <span class="ms-1">(3,027)</span>
            </div>
            <p class="card-text from-text mt-auto">from</p>
            <p class="card-text price">₹3,027 per adult</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm d-flex flex-column">
          <span class="heart-icon"><i class="far fa-heart"></i></span>
          <img src="images/jaipur palace-1.jpg" class="card-img-top" alt="Royal Rajasthan">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Royal Rajasthan - the royal heritage, majestic forts, and colorful bazaars in the
              Pink City.</h5>
            <div class="rating">
              <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span> 5.0 <span class="ms-1">(8)</span>
            </div>
            <p class="card-text from-text mt-auto">from</p>
            <p class="card-text price">₹14,904 per adult</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm d-flex flex-column">
          <span class="heart-icon"><i class="far fa-heart"></i></span>
          <img src="images/banaras-3.jpg" class="card-img-top" alt="Varanasi Spiritual">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Varanasi Spiritual - One of the oldest cities in the world, famous for Ganga Aarti,
              temples, and spiritual experiences.</h5>
            <div class="rating">
              <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span> 4.9 <span class="ms-1">(13)</span>
            </div>
            <p class="card-text from-text mt-auto">from</p>
            <p class="card-text price">₹5,552 per adult</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card h-100 shadow-sm d-flex flex-column">
          <span class="heart-icon"><i class="far fa-heart"></i></span>
          <img src="images/Lumbini Buddhist.jpg" class="card-img-top" alt="Lumbini Buddhist Tour">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">7 Days Varanasi to Lumbini Buddhist Expedition (All Inclusive)</h5>
            <div class="rating">
              <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span> 5.0 <span class="ms-1">(11)</span>
            </div>
            <p class="card-text from-text mt-auto">from</p>
            <p class="card-text price">₹10,000 per adult</p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php include 'Popular_food.php'; ?>
  <?php include 'hotels_scroll_carousel.php'; ?>


  <!-- About Explore India Section -->
  <section class="bg-light py-5" id="about_us">
    <div class="container">
      <div class="row align-items-center g-5">

        <!-- Text Content -->
        <div class="col-lg-6">
          <h2 class="fw-bold text-primary display-6 mb-3">Discover the Magic of Explore <span id="text_gradient">
              India</span></h2>
          <p class="text-secondary fs-5 mb-4">
            <strong>Explore India</strong> is your trusted travel companion for unlocking the incredible diversity of
            India — from the snow-capped Himalayas to sun-kissed beaches, majestic forts to vibrant street markets.
            Discover experiences curated for every kind of traveler.
          </p>
          <ul class="list-unstyled text-secondary fs-5">
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Personalized travel
              recommendations</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Easy hotel bookings & package
              deals</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Verified reviews from real
              travelers</li>
            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Secure & seamless booking
              experience</li>
          </ul>
          <a href="destinations.php" class="btn btn-primary btn-lg mt-3 px-4 shadow-sm">Start Exploring</a>
        </div>

        <!-- Image or Illustration -->
        <div class="col-lg-6 text-center">
          <img src="images/logo-1.png" alt="Explore India Travel" class="img-fluid rounded-4 "
            style="max-height: 450px;">
        </div>

      </div>
    </div>
  </section>


  <!-- Recent Reviews -->
  <h2 class="mt-5 mb-3 px-5">Recent Reviews</h2>
  <div class="row row-cols-1 px-5 row-cols-md-2 g-4">
    <div class="col">
      <div class="card border-success">
        <div class="card-body">
          <h5 class="card-title">Ravi Kumar</h5>
          <p class="card-text">"Had an amazing time in Goa! The hotel was excellent and booking was seamless."</p>
          <span class="badge bg-success">★★★★★</span>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-info">
        <div class="card-body">
          <h5 class="card-title">Shivi Sharma</h5>
          <p class="card-text">"Jaipur was majestic. Loved the cultural experience and the palace stay."</p>
          <span class="badge bg-info">★★★★☆</span>
        </div>
      </div>
    </div>
  </div>

  <?php include 'public_footer.php'; ?>

  <!-- </div> -->


  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>