<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$user_email = $_SESSION['email'];
$reference_id = uniqid('PAY_');
$amount = isset($_GET['amount']) ? floatval($_GET['amount']) : 0.00;
$type = $_GET['type'] ?? 'hotel';
$mode = $_GET['mode'] ?? 'MockPay';

// Optional: Check if a similar payment already exists (avoid duplicates)
$check = mysqli_query($conn, "SELECT * FROM payments WHERE reference_id = '$reference_id'");
if (mysqli_num_rows($check) == 0) {
    // Insert payment record
    $insert = "INSERT INTO payments (user_email, booking_type, reference_id, amount, status, payment_mode)
               VALUES ('$user_email', '$type', '$reference_id', '$amount', 'success', '$mode')";
    mysqli_query($conn, $insert);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8fb;
        }

        .success-box {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .success-box h2 {
            color: #198754;
        }
    </style>
</head>

<body>
    <div class="success-box text-center">
        <h2>✅ Payment Successful</h2>
        <hr>
        <p><strong>Reference ID:</strong> <?= htmlspecialchars($reference_id) ?></p>
        <p><strong>Booking Type:</strong> <?= ucfirst(htmlspecialchars($type)) ?></p>
        <p><strong>Amount Paid:</strong> ₹<?= number_format($amount, 2) ?></p>
        <p><strong>Payment Mode:</strong> <?= htmlspecialchars($mode) ?></p>

        <div class="mt-4">
            <a href="my_bookings.php" class="btn btn-success me-2">📄 View Bookings</a>
            <a href="dashboard.php" class="btn btn-outline-primary">🏠 Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
