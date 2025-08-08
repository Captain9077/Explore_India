<?php
session_start();
include('db_connect.php');

// Optional: Require login
// if (!isset($_SESSION['email'])) {
//     header('location:login.php?error=Please login');
//     exit();
// }

// Fetch all destinations
$sql = "SELECT * FROM destinations";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Destinations - Explore India</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .text-muted {
            font-size: 0.9rem;
        }

        .card-text {
            font-size: 0.95rem;
            color: #555;
        }

        h2.section-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 40px;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.05);
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
                        <a class="nav-link " href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="public_destinations.php">Destination</a>
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

    <?php include 'carousel.php'; ?>
    <!-- Section: Destinations -->
    <div class="container my-5">
        <h2 class="section-title text-center">✨ Popular Destinations in India</h2>
        <h3>What we provide:</h3>
        <p>We will organise the whole trip for you, according to your needs, from the point you arrive in India until
            you leave. This will typically include collection and return to the airport, all accommodation, a car and
            driver for your road trips, all safaris and meals at the national parks, other sightseeing as agreed. We
            will be very clear on the itinerary what is included and what is excluded.

            We will also provide you with our contact number and email in India so if you need help or advice at anytime
            it is very quickly available. We will stay in touch with you throughout the trip to ensure there are no
            hitches.</p>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Destination Image"
                            class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <h6 class="text-muted"><?php echo htmlspecialchars($row['location']); ?></h6>
                            <p class="card-text">
                                <?php echo substr(htmlspecialchars($row['description']), 0, 100) . '...'; ?>
                            </p>
                            <a href="destination_details.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-success mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'public_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>