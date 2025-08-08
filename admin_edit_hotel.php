<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Admins only!'); window.location.href='login.php';</script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('No hotel selected.'); window.location.href='admin_panel.php';</script>";
    exit();
}

$hotel_id = intval($_GET['id']);

// Fetch hotel
$query = "SELECT * FROM hotels WHERE id = $hotel_id";
$result = mysqli_query($conn, $query);
$hotel = mysqli_fetch_assoc($result);

// Fetch all destinations
$dest_query = "SELECT * FROM destinations ORDER BY location ASC";
$destinations = mysqli_query($conn, $dest_query);

if (isset($_POST['update_hotel'])) {
    $name = $_POST['hotel_name'];
    $destination_id = $_POST['destination_id'];
    $price = $_POST['hotel_price'];
    $desc = $_POST['hotel_description'];

    $image_path = $hotel['image_url']; // default to current image

    // Check if new image is uploaded
    if (!empty($_FILES['hotel_image']['name'])) {
        $img_name = basename($_FILES['hotel_image']['name']);
        $tmp_name = $_FILES['hotel_image']['tmp_name'];
        $target_path = "uploads/" . $img_name;

        if (move_uploaded_file($tmp_name, $target_path)) {
            $image_path = $target_path;
        } else {
            $error = "Image upload failed!";
        }
    }

    $update = "UPDATE hotels 
               SET name='$name', destination_id='$destination_id', image_url='$image_path', price='$price', description='$desc' 
               WHERE id=$hotel_id";

    if (mysqli_query($conn, $update)) {
        header("Location: admin_panel.php?msg=Hotel+updated+successfully");
        exit();
    } else {
        $error = "Error updating hotel.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Hotel</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2>Edit Hotel</h2>
    <?php if (isset($error))
        echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Hotel Name</label>
            <input type="text" name="hotel_name" class="form-control" value="<?= htmlspecialchars($hotel['name']) ?>"
                required>
        </div>

        <div class="mb-3">
            <label>Destination</label>
            <select name="destination_id" class="form-control" required>
                <option disabled selected>-- Select Destination --</option>
                <?php while ($dest = mysqli_fetch_assoc($destinations)): ?>
                    <option value="<?= $dest['id'] ?>" <?= $dest['id'] == $hotel['destination_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dest['location']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Image</label><br>
            <?php if (!empty($hotel['image_url'])): ?>
                <img src="<?= $hotel['image_url'] ?>" alt="Current Image" width="150" class="mb-2"><br>
            <?php endif; ?>
            <input type="file" name="hotel_image" class="form-control">
            <small class="text-muted">Leave empty to keep current image.</small>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="hotel_price" class="form-control" value="<?= $hotel['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="hotel_description" class="form-control" rows="3"
                required><?= htmlspecialchars($hotel['description']) ?></textarea>
        </div>

        <button type="submit" name="update_hotel" class="btn btn-primary">Update Hotel</button>
        <a href="admin_manage_hotel.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>

</html>