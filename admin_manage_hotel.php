<?php
session_start();
include('db_connect.php');

// Check if user is logged in and is an admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Admins only!'); window.location.href='login.php';</script>";
    exit();
}

// Delete Hotel
if (isset($_GET['delete_hotel'])) {
    $id = intval($_GET['delete_hotel']);
    mysqli_query($conn, "DELETE FROM hotels WHERE id = $id");
}

// Fetch all data
$hotels = mysqli_query($conn, "SELECT hotels.*, destinations.location 
                               FROM hotels 
                               LEFT JOIN destinations ON hotels.destination_id = destinations.id 
                               ORDER BY hotels.id DESC");
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
                        <a class="nav-link " href="admin_panel.php">View Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_manage_hotel.php">Manage Hotels</a>
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
        <a href="admin_add.php" class="btn btn-success mb-3">Add Hotel</a>


        <!-- Hotels -->
        <h4 class="text-primary mt-5" id="manage_hotel">Manage Hotels</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($hotel = mysqli_fetch_assoc($hotels)): ?>
                    <tr>
                        <td><?= htmlspecialchars($hotel['name']) ?></td>
                        <td><?= isset($hotel['location']) ? htmlspecialchars($hotel['location']) : 'N/A' ?></td>
                        <td>₹<?= htmlspecialchars($hotel['price']) ?></td>
                        <td>
                            <a href="admin_edit_hotel.php?id=<?= $hotel['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete_hotel=<?= $hotel['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this hotel?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>