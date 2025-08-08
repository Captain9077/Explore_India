<?php
include('db_connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        // Mail Setup
        $mail = new PHPMailer(true);
        $subject = "New Registration";
        $message = "Dear $full_name,<br><br>Your account has been successfully created.<br>Email: $email<br>Password: $password<br><br>Thank you for registering!";

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'abhishekpandey6764@gmail.com'; // Your Gmail
            $mail->Password = 'cwvhmcxjdixgguyr';              // App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('abhishekpandey6764@gmail.com', 'Explore India');
            $mail->addAddress($email, $full_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);

            $mail->send();
            echo "<script>alert('Registration successful & Email sent!'); window.location.href = 'login.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Registration successful but email failed to send.'); window.location.href = 'login.php';</script>";
        }

    } else {
        echo "<script>alert('Registration failed...'); window.location.href = 'register.php';</script>";
    }
}
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
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row mt-xxl-5">
            <div class="col-md-5 m-auto mt-5">
                <center class="p-xl-5 mb-5">
                    <form action="register.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="full_name" class="form-label"><strong>Full Name</strong></label>
                            <input type="text" class="form-control" name="full_namefull_name" id="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong> Email address</strong></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><strong>Password</strong></label>
                            <input type="password" class="form-control" name="password" id="password" required>
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