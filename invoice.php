<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['email'])) {
    echo "Unauthorized access.";
    exit();
}

$email = $_SESSION['email'];
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch booking
$result = mysqli_query($conn, "SELECT * FROM bookings WHERE id = $booking_id AND user_email = '$email'");
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo "Booking not found.";
    exit();
}

// Calculate total price
$checkin = new DateTime($booking['check_in']);
$checkout = new DateTime($booking['check_out']);
$nights = $checkin->diff($checkout)->days;

$hotel_query = mysqli_query($conn, "SELECT price FROM hotels WHERE name = '" . mysqli_real_escape_string($conn, $booking['hotel_name']) . "'");
$hotel = mysqli_fetch_assoc($hotel_query);
$price_per_night = $hotel ? $hotel['price'] : 0;
$total_amount = $nights * $price_per_night;

// Fetch payment if exists
$payment_query = mysqli_query($conn, "SELECT * FROM payments WHERE reference_id = 'booking_$booking_id' AND user_email = '$email' LIMIT 1");
$payment = mysqli_fetch_assoc($payment_query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice - Booking #<?php echo $booking['id']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="p-5">

    <div class="container border p-4">
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
                            <a class="nav-link" href="my_bookings.php">My Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <h2 class="text-center">Hotel Booking Invoice</h2>
        <hr>
        <p><strong>Booking ID:</strong> #<?= $booking['id'] ?></p>
        <p><strong>Hotel Name:</strong> <?= htmlspecialchars($booking['hotel_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking['user_email']) ?></p>
        <p><strong>Check-In:</strong> <?= $booking['check_in'] ?></p>
        <p><strong>Check-Out:</strong> <?= $booking['check_out'] ?></p>
        <p><strong>Nights:</strong> <?= $nights ?> night(s)</p>
        <p><strong>Guests:</strong> <?= $booking['guests'] ?></p>
        <p><strong>Booking Date:</strong> <?= date('d M Y h:i A', strtotime($booking['created_at'])) ?></p>

        <hr>
        <h5>Billing</h5>
        <p><strong>Price per night:</strong> ₹<?= number_format($price_per_night) ?></p>
        <p><strong>Total Amount:</strong> ₹<?= number_format($total_amount) ?></p>

        <?php if ($payment): ?>
            <hr>
            <h5>Payment Info</h5>
            <p><strong>Transaction ID:</strong> <?= htmlspecialchars($payment['reference_id']) ?></p>
            <p><strong>Amount Paid:</strong> ₹<?= number_format($payment['amount'], 2) ?></p>
            <p><strong>Payment Mode:</strong> <?= htmlspecialchars($payment['payment_mode']) ?></p>
            <p><strong>Status:</strong> <?= ucfirst($payment['status']) ?></p>
            <p><strong>Payment Date:</strong> <?= date("d M Y, h:i A", strtotime($payment['payment_date'])) ?></p>
        <?php else: ?>
            <p class="text-danger"><strong>Note:</strong> No payment record found.</p>
        <?php endif; ?>

        <hr>
        <p>Thank you for booking with <strong>Explore India</strong> 🌏</p>

        <div class="text-center no-print">
            <button onclick="window.print()" class="btn btn-primary mt-3">🖨️ Print Invoice</button>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>