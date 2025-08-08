<?php
$name = $_GET['name'] ?? 'your booking';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center p-5">
    <div class="container bg-white p-4 shadow rounded">
        <h2 class="text-danger">❌ Payment Failed</h2>
        <p>Sorry, payment for <strong><?= htmlspecialchars($name) ?></strong> could not be completed.</p>
        <a href="travel_booking.php" class="btn btn-warning mt-3">Try Again</a>
    </div>
</body>
</html>
