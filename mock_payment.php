<?php
session_start();
include('db_connect.php');
if (!isset($_SESSION['email'])) {
    header('location:login.php?error=You Are not logged in');
    exit();
}

$type = $_GET['type'] ?? 'Service';
$name = $_GET['name'] ?? 'Booking';
$price = $_GET['price'] ?? '0';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $success = rand(0, 1);

    if ($success && isset($_SESSION['travel_booking'])) {
        $user_email = $_SESSION['email'] ?? 'demo@example.com';
        $booking = $_SESSION['travel_booking'];
        $created_at = date('Y-m-d H:i:s');

        // Insert into travel_bookings
        $stmt = $conn->prepare("INSERT INTO travel_bookings (user_email, trip_type, mode, from_city, to_city, departure_date, return_date, travellers, travel_class, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssss",
            $user_email,
            $booking['trip_type'],
            $booking['mode'],
            $booking['from_city'],
            $booking['to_city'],
            $booking['departure_date'],
            $booking['return_date'],
            $booking['travellers'],
            $booking['travel_class'],
            $created_at
        );
        $stmt->execute();
        $booking_id = $stmt->insert_id;

        // Insert into payments
        $price = floatval($_GET['price']);
        $mode = strtolower($booking['mode']); // flight, train, bus

        $insert_payment = "INSERT INTO payments (user_email, booking_type, reference_id, amount, status, payment_mode)
                           VALUES ('$user_email', '$mode', '$booking_id', '$price', 'success', 'MockCard')";
        mysqli_query($conn, $insert_payment);

        unset($_SESSION['travel_booking']);

        header("Location: payment_success.php?name=" . urlencode($booking['from_city'] . ' to ' . $booking['to_city']));
        exit();

    } else {
        header("Location: payment_failed.php?name=" . urlencode($name));
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mock Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f3f4f6;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .qr-img {
            width: 150px;
            height: auto;
            margin: 10px 0;
        }
    </style>
</head>

<body class="container py-5">

    <div class="card mx-auto p-4" style="max-width: 500px;">
        <h3 class="text-center mb-3">🧾 Mock Payment Gateway</h3>
        <p><strong>Type:</strong> <?= htmlspecialchars($type) ?></p>
        <p><strong>Service:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Amount:</strong> ₹<?= htmlspecialchars($price) ?></p>

        <form method="POST">
            <div class="mb-3">
                <label>Card Number</label>
                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Expiry</label>
                    <input type="text" class="form-control" placeholder="MM/YY" required>
                </div>
                <div class="col">
                    <label>CVV</label>
                    <input type="password" class="form-control" placeholder="123" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Name on Card</label>
                <input type="text" class="form-control" required>
            </div>

            <div class="mb-3 text-center">
                <p><strong>Or Pay via UPI</strong></p>
                <img src="images/qr code.png" alt="UPI QR" class="qr-img">
                <p class="text-muted">Scan QR with any UPI app</p>
            </div>

            <button type="submit" class="btn btn-primary w-100">💳 Pay Now</button>
        </form>
    </div>

</body>

</html>