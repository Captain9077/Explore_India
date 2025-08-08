<?php
session_start();
include('db_connect.php');

// Admin check
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Admins only!'); window.location.href='login.php';</script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('No destination selected.'); window.location.href='admin_panel.php';</script>";
    exit();
}

$dest_id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM destinations WHERE id = $dest_id");
$dest = mysqli_fetch_assoc($result);

// Form submit
if (isset($_POST['update_destination'])) {
    $name = $_POST['dest_name'];
    $location = $_POST['dest_location'];
    $desc = $_POST['dest_description'];

    $image_path = $dest['image_url']; // keep old image by default

    if (!empty($_FILES['dest_image']['name'])) {
        $img_name = basename($_FILES['dest_image']['name']);
        $tmp_name = $_FILES['dest_image']['tmp_name'];
        $target_path = "uploads/" . $img_name;

        if (move_uploaded_file($tmp_name, $target_path)) {
            $image_path = $target_path;
        } else {
            $error = "❌ Image upload failed!";
        }
    }

    $update = "UPDATE destinations 
               SET name='$name', location='$location', image_url='$image_path', description='$desc' 
               WHERE id=$dest_id";

    if (mysqli_query($conn, $update)) {
        header("Location: admin_panel.php?msg=Destination+updated+successfully");
        exit();
    } else {
        $error = "❌ Error updating destination.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Destination</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-5">
    <h2 class="mb-4">✏️ Edit Destination</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Destination Name</label>
            <input type="text" name="dest_name" class="form-control" value="<?= htmlspecialchars($dest['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="dest_location" class="form-control" value="<?= htmlspecialchars($dest['location']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <?php if (!empty($dest['image_url'])): ?>
                <img src="<?= $dest['image_url'] ?>" alt="Current Image" width="200" class="mb-2">
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Upload New Image (optional)</label>
            <input type="file" name="dest_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="dest_description" class="form-control" rows="4" required><?= htmlspecialchars($dest['description']) ?></textarea>
        </div>

        <button type="submit" name="update_destination" class="btn btn-success">Update Destination</button>
        <a href="admin_manage_destination.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>

</html>
