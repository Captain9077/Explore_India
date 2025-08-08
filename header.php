<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Explore India – Travel Guide & Booking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons (optional but used for future) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    /* Elegant Navbar Styling */
    .navbar-custom {
      transition: all 0.3s ease-in-out;
    }

    .navbar-custom .nav-link {
      position: relative;
      color: #dddddd !important;
      font-weight: 500;
      margin: 0 0.5rem;
      transition: color 0.3s ease;
    }

    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link:focus {
      color: #ffffff !important;
    }

    .navbar-custom .nav-link::after {
      content: '';
      position: absolute;
      left: 50%;
      bottom: 4px;
      width: 0%;
      height: 2px;
      background-color: #ffc107;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .navbar-custom .nav-link:hover::after {
      width: 60%;
    }

    .navbar-custom .nav-link.active {
      color: #ffc107 !important;
      font-weight: 600;
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.4rem;
    }
  </style>
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
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="destinations.php">Destination</a>
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
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page content -->
  <div class="container mt-4">