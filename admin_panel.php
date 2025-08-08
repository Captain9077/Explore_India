<?php
session_start();
include('db_connect.php');

// Check if user is logged in and is an admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Admins only!'); window.location.href='login.php';</script>";
    exit();
}

// Fetch all data
$bookings = mysqli_query($conn, "SELECT * FROM bookings ORDER BY id DESC");

$payments = mysqli_query($conn, "SELECT * FROM payments ORDER BY payment_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
                        <a class="nav-link active" href="admin_panel.php">View Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_manage_hotel.php">Manage Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_manage_destination.php">Manage Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2 class="mb-4">Welcome Admin: Manage Bookings, Hotels, Destinations & Payments</h2>
        <a href="admin_add.php" class="btn btn-success mb-3">Add Hotel / Destination</a>

        <!-- Bookings -->
        <h4 class="text-primary" id="view_bookings">All Bookings</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Email</th>
                    <th>Hotel Name</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Guests</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($bookings)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['user_email']) ?></td>
                        <td><?= htmlspecialchars($row['hotel_name']) ?></td>
                        <td><?= htmlspecialchars($row['check_in']) ?></td>
                        <td><?= htmlspecialchars($row['check_out']) ?></td>
                        <td><?= htmlspecialchars($row['guests']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Payments -->
        <h4 class="text-success mt-5">All Payments</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User Email</th>
                    <th>Booking Type</th>
                    <th>Reference ID</th>
                    <th>Amount (₹)</th>
                    <th>Status</th>
                    <th>Mode</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($payment = mysqli_fetch_assoc($payments)): ?>
                    <tr>
                        <td><?= htmlspecialchars($payment['user_email']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($payment['booking_type'])) ?></td>
                        <td><?= htmlspecialchars($payment['reference_id']) ?></td>
                        <td><?= number_format($payment['amount'], 2) ?></td>
                        <td><span class="badge bg-<?= $payment['status'] == 'success' ? 'success' : 'danger' ?>">
                                <?= ucfirst($payment['status']) ?></span></td>
                        <td><?= htmlspecialchars($payment['payment_mode']) ?></td>
                        <td><?= htmlspecialchars($payment['payment_date']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>



    </div>
</body>

</html>