<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['email'])) {
    header('location:login.php?error=You Are not logged in');
    exit();
}

$email = $_SESSION['email'];

// Cancel hotel booking
if (isset($_GET['cancel'])) {
    $booking_id = intval($_GET['cancel']);
    mysqli_query($conn, "DELETE FROM bookings WHERE id = $booking_id AND user_email = '$email'");
    echo "<script>alert('Hotel booking canceled.'); window.location='my_bookings.php';</script>";
    exit();
}

// Cancel travel booking
if (isset($_GET['cancel_travel'])) {
    $id = intval($_GET['cancel_travel']);
    mysqli_query($conn, "DELETE FROM travel_bookings WHERE id = $id AND user_email = '$email'");
    echo "<script>alert('Travel booking canceled.'); window.location='my_bookings.php';</script>";
    exit();
}

// Fetch hotel bookings
$hotel_result = mysqli_query($conn, "SELECT * FROM bookings WHERE user_email = '$email' ORDER BY created_at DESC");

// Fetch travel bookings
$travel_result = mysqli_query($conn, "SELECT * FROM travel_bookings WHERE user_email = '$email' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
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
                        <a class="nav-link" href="index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        <!-- HOTEL BOOKINGS -->
        <h3 class="mt-4">🏨 My Hotel Bookings</h3>
        <?php if (mysqli_num_rows($hotel_result) > 0): ?>
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Hotel</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Guests</th>
                        <th>Booked On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($booking = mysqli_fetch_assoc($hotel_result)) {
                        $booking_id = $booking['id'];
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['hotel_name']) ?></td>
                            <td><?= htmlspecialchars($booking['check_in']) ?></td>
                            <td><?= htmlspecialchars($booking['check_out']) ?></td>
                            <td><?= htmlspecialchars($booking['guests']) ?></td>
                            <td><?= date('d M Y', strtotime($booking['created_at'])) ?></td>
                            <td>
                                <a href="invoice.php?id=<?= $booking_id ?>" class="btn btn-primary btn-sm"
                                    target="_blank">Invoice</a>
                                <a href="?cancel=<?= $booking_id ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Cancel this booking?');">Cancel</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info mt-3">No hotel bookings found.</div>
        <?php endif; ?>


        <!-- TRAVEL BOOKINGS -->
        <h3 class="mt-5">🛫 My Travel Bookings</h3>
        <?php if (mysqli_num_rows($travel_result) > 0): ?>
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Mode</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Trip Type</th>
                        <th>Departure</th>
                        <th>Return</th>
                        <th>Travellers</th>
                        <th>Class</th>
                        <th>Booked On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($travel = mysqli_fetch_assoc($travel_result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($travel['mode']) ?></td>
                            <td><?= htmlspecialchars($travel['from_city']) ?></td>
                            <td><?= htmlspecialchars($travel['to_city']) ?></td>
                            <td><?= htmlspecialchars($travel['trip_type']) ?></td>
                            <td><?= htmlspecialchars($travel['departure_date']) ?></td>
                            <td><?= $travel['trip_type'] === 'Round Trip' ? htmlspecialchars($travel['return_date']) : '-' ?>
                            </td>
                            <td><?= htmlspecialchars($travel['travellers']) ?></td>
                            <td><?= htmlspecialchars($travel['travel_class']) ?></td>
                            <td><?= date('d M Y', strtotime($travel['created_at'])) ?></td>
                            <td>
                                <a href="travel_invoice.php?id=<?= $travel['id'] ?>" class="btn btn-primary btn-sm"
                                    target="_blank">Invoice</a>
                                <a href="?cancel_travel=<?= $travel['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Cancel this travel booking?');">Cancel</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info mt-3">No travel bookings found.</div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>