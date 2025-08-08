<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['email'])) {
    echo "Unauthorized access.";
    exit();
}

$email = $_SESSION['email'];
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM travel_bookings WHERE id = $booking_id AND user_email = '$email'";
$result = mysqli_query($conn, $query);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo "Booking not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice - Travel Booking #<?= $booking['id'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            background: #f9f9f9;
            padding: 30px;
        }

        .invoice-box {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #dc3545;
        }
    </style>
</head>

<body>

    <div class="container invoice-box">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>🧾 Travel Booking Invoice</h2>
            <a href="dashboard.php" class="btn btn-dark no-print">Back to Dashboard</a>
            <a href="my_bookings.php" class="btn btn-dark no-print">Back to My Bookings</a>
            <a href="index.php" class="btn btn-dark no-print">Logout</a>
            
        </div>

        <hr>

        <p><strong>Booking ID:</strong> <?= $booking['id'] ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking['user_email']) ?></p>
        <p><strong>Mode:</strong> <?= htmlspecialchars($booking['mode']) ?></p>
        <p><strong>Trip Type:</strong> <?= htmlspecialchars($booking['trip_type']) ?></p>
        <p><strong>From:</strong> <?= htmlspecialchars($booking['from_city']) ?></p>
        <p><strong>To:</strong> <?= htmlspecialchars($booking['to_city']) ?></p>
        <p><strong>Departure Date:</strong> <?= htmlspecialchars($booking['departure_date']) ?></p>

        <?php if ($booking['trip_type'] === 'Round Trip'): ?>
            <p><strong>Return Date:</strong> <?= htmlspecialchars($booking['return_date']) ?></p>
        <?php endif; ?>

        <p><strong>Travellers:</strong> <?= $booking['travellers'] ?></p>
        <p><strong>Class:</strong> <?= htmlspecialchars($booking['travel_class']) ?></p>
        <p><strong>Booking Date:</strong> <?= date('d M Y, h:i A', strtotime($booking['created_at'])) ?></p>

        <hr>
        <p>Thank you for choosing <strong>Explore India</strong> for your journey! 🌍</p>

        <div class="text-center no-print">
            <button onclick="window.print()" class="btn btn-primary mt-3">🖨️ Print Invoice</button>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>