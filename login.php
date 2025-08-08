<?php
session_start();
include('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to access</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">



</head>

<style>
  body {
    position: relative;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0.9;
  }

  .container-fluid {
    box-shadow: 0px 0px 20px -10px #7e7e7e;
    border-radius: 2px;
    width: 85%;
  }
</style>

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
                        <a class="nav-link" href="register.php">Register Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  <div class="container-fluid">
    <div class="row mt-xxl-5">
      <div class="col-md-5 m-auto mt-5">
        <center class="p-xl-5 mb-5">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="email" class="form-label"><strong> Email address</strong></label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label"><strong>Password</strong></label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </center>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php


if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $run = mysqli_query($conn, $query);

  if (mysqli_num_rows($run) > 0) {
    $user = mysqli_fetch_assoc($run);

    // ✅ Save info to session
    $_SESSION['email'] = $user['email'];
    $_SESSION['full_name'] = $user['full_name']; // If you want to use it later
    $_SESSION['role'] = $user['role']; // Store user role (admin/user)

    // ✅ Redirect to dashboard or admin panel
    if ($user['role'] === 'admin') {
      echo "<script>window.location.href='admin_panel.php';</script>";
    } else {
      echo "<script>window.location.href='dashboard.php';</script>";
    }
  } else {
    echo "<script>alert('Email or password is incorrect');</script>";
  }
}
?>