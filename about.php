<?php
session_start();
include('db_connect.php');

// Optional: Require login
if (!isset($_SESSION['email'])) {
    header('location:login.php?error=Please login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us – Explore India</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .highlight {
            color: #0d6efd;
        }

        .mission-section {
            background: #f9f9f9;
            border-left: 5px solid #0d6efd;
            padding: 1rem;
        }
    </style>
</head>

<body>
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

    <section class="py-5">
        <div class="container">
            <h1 class="mb-4 fw-bold text-center text-primary">About Explore India</h1>

            <div class="mb-5 text-center">
                <p class="lead">
                    <span class="highlight">Explore India</span> is your ultimate travel companion – helping you
                    discover the rich heritage,
                    diverse culture, and breathtaking beauty of India. From historic forts to serene beaches, we bring
                    you the best destinations
                    and travel experiences across the country.
                </p>
            </div>

            <!-- Mission & Vision -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="mission-section rounded shadow-sm">
                        <h4 class="fw-bold">Our Mission</h4>
                        <p>To make travel in India easier, inspiring, and accessible for everyone by offering
                            well-curated destinations, experiences, and stays that reflect the incredible diversity of
                            India.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mission-section rounded shadow-sm">
                        <h4 class="fw-bold">Our Vision</h4>
                        <p>To become India’s most trusted travel discovery platform, connecting travelers with authentic
                            experiences and reliable travel services.</p>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="mb-5">
                <h3 class="mb-3 text-primary">Why Choose Explore India?</h3>
                <ul class="list-group list-group-flush fs-5">
                    <li class="list-group-item">✔️ Trusted information on top destinations</li>
                    <li class="list-group-item">✔️ Handpicked hotel deals and offers</li>
                    <li class="list-group-item">✔️ Easy online booking and secure payments</li>
                    <li class="list-group-item">✔️ Real reviews from real travelers</li>
                    <li class="list-group-item">✔️ Responsive customer support</li>
                </ul>
            </div>

            <!-- Meet the Team -->
            <div class="mb-5">
                <h3 class="mb-4 text-primary">Meet Our Team</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <!-- Team Member 1 -->
                    <div class="col">
                        <div class="card h-100 text-center shadow-sm">
                            <img src="images/men.jpg" class="card-img-top" alt="Founder">
                            <div class="card-body">
                                <h5 class="card-title">Rohan Mehta</h5>
                                <p class="card-text text-muted">Founder & CEO</p>
                                <p class="card-text">A passionate traveler on a mission to showcase India’s beauty
                                    through technology.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="col">
                        <div class="card h-100 text-center shadow-sm">
                            <img src="images/women.jpg" class="card-img-top" alt="Developer">
                            <div class="card-body">
                                <h5 class="card-title">Priya Kapoor</h5>
                                <p class="card-text text-muted">Lead Developer</p>
                                <p class="card-text">Building seamless user experiences and scalable travel systems for
                                    you.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="col">
                        <div class="card h-100 text-center shadow-sm">
                            <img src="images/men-2.jpg" class="card-img-top" alt="Marketing Head">
                            <div class="card-body">
                                <h5 class="card-title">Ankit Sharma</h5>
                                <p class="card-text text-muted">Head of Marketing</p>
                                <p class="card-text">Crafting stories that inspire travel and connect people with
                                    destinations.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center bg-primary text-white p-4 rounded">
                <h4 class="mb-2">Start Your Journey with Explore India</h4>
                <p>Plan your next vacation today and uncover the real soul of India.</p>
                <a href="destinations.php" class="btn btn-light fw-bold">Browse Destinations</a>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>