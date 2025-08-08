<?php
session_start();
include('db_connect.php');

// Admin authentication
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Admins only!'); window.location.href='login.php';</script>";
    exit();
}

$message = '';

// Add Hotel
if (isset($_POST['add_hotel'])) {
    $name = $_POST['hotel_name'];
    $destination_id = $_POST['hotel_destination_id'];
    $price = $_POST['hotel_price'];
    $desc = $_POST['hotel_description'];

    $img_name = $_FILES['hotel_image']['name'];
    $tmp_name = $_FILES['hotel_image']['tmp_name'];
    $target_dir = "uploads/" . basename($img_name);

    if (!is_dir("uploads"))
        mkdir("uploads"); // Ensure uploads folder exists

    if (move_uploaded_file($tmp_name, $target_dir)) {
        $insert = "INSERT INTO hotels (name, destination_id, image_url, price, description)
                   VALUES ('$name', '$destination_id', '$target_dir', '$price', '$desc')";
        $message = mysqli_query($conn, $insert) ? "✅ Hotel added successfully!" : "❌ Error adding hotel.";
    } else {
        $message = "❌ Image upload failed.";
    }
}

// Add Destination
if (isset($_POST['add_destination'])) {
    $name = $_POST['dest_name'];
    $location = $_POST['dest_location'];
    $desc = $_POST['dest_description'];

    $img_name = $_FILES['dest_image']['name'];
    $tmp_name = $_FILES['dest_image']['tmp_name'];
    $target_dir = "uploads/" . basename($img_name);

    if (!is_dir("uploads"))
        mkdir("uploads");

    if (move_uploaded_file($tmp_name, $target_dir)) {
        $insert = "INSERT INTO destinations (name, location, image_url, description)
                   VALUES ('$name', '$location', '$target_dir', '$desc')";
        $message = mysqli_query($conn, $insert) ? "✅ Destination added successfully!" : "❌ Error adding destination.";
    } else {
        $message = "❌ Image upload failed.";
    }
}

// Fetch all destinations for the dropdown
$destinations = mysqli_query($conn, "SELECT id, name FROM destinations ORDER BY name");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Add Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: #f2f4f7;
        }

        .form-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .form-section h4 {
            color: #0d6efd;
            font-weight: bold;
        }

        .container h2 {
            font-weight: bold;
            font-size: 2rem;
        }
    </style>
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
                        <a class="nav-link " href="admin_manage_hotel.php">Manage Hotels</a>
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

    <div class="container py-5">

        <h2 class="text-center mb-4">✨ Admin Panel – Add Hotels & Destinations</h2>

        <?php if ($message): ?>
            <div class="alert alert-info text-center"><?= $message ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- Hotel Form -->
            <div class="col-md-6">
                <div class="form-section">
                    <h4 class="mb-3">🏨 Add New Hotel</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Hotel Name</label>
                            <input type="text" name="hotel_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Select Destination</label>
                            <select name="hotel_destination_id" class="form-select" required>
                                <option value="">-- Select Destination --</option>
                                <?php while ($row = mysqli_fetch_assoc($destinations)): ?>
                                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="hotel_image" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Price (INR)</label>
                            <input type="number" name="hotel_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="hotel_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="add_hotel" class="btn btn-primary w-100">Add Hotel</button>
                    </form>
                </div>
            </div>

            <!-- Destination Form -->
            <div class="col-md-6">
                <div class="form-section">
                    <h4 class="mb-3">📍 Add New Destination</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Destination Name</label>
                            <input type="text" name="dest_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Location</label>
                            <input type="text" name="dest_location" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="dest_image" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="dest_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="add_destination" class="btn btn-success w-100">Add
                            Destination</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>