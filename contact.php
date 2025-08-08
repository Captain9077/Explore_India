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
  <title>Contact Us – Explore India</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .contact-info-icon {
      font-size: 1.2rem;
      color: #0d6efd;
      margin-right: 10px;
    }

    .card-title {
      color: #0d6efd;
    }

    .card {
      border: none;
      border-radius: 10px;
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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
                        <a class="nav-link " href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact.php">Contact Us</a>
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

  <section class="py-5 bg-light" id="contact_us">
    <div class="container">
      <h2 class="mb-5 text-center text-primary fw-bold">Get in Touch with Us</h2>

      <div class="row g-5 align-items-start">

        <!-- Contact Form -->
        <div class="col-lg-6">
          <div class="card shadow-sm p-4">
            <h5 class="card-title mb-4">Send Us a Message</h5>
            <form action="contact_submit.php" method="POST">
              <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" required>
              </div>

              <div class="mb-4">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" rows="5" class="form-control" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
          </div>
        </div>

        <!-- Contact Info & Map -->
        <div class="col-lg-6">
          <div class="bg-white rounded shadow-sm p-4 mb-4">
            <h5 class="fw-semibold mb-3">Our Office</h5>
            <p><i class="bi bi-geo-alt contact-info-icon"></i>123 Heritage Street, Delhi, India</p>
            <p><i class="bi bi-envelope contact-info-icon"></i>support@exploreindia.com</p>
            <p><i class="bi bi-telephone contact-info-icon"></i>+91 98765 43210</p>
          </div>

          <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14009.472192026596!2d77.2167218!3d28.6448005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2e2f38b632d%3A0x1fdc7e6f5b6b0fa!2sConnaught%20Place%2C%20New%20Delhi!5e0!3m2!1sen!2sin!4v1686891881316!5m2!1sen!2sin"
              width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>

      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>