<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $subject, $message);

  if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Message sent successfully!'); window.location='contact.php';</script>";
  } else {
    echo "<script>alert('Something went wrong.'); window.location='contact.php';</script>";
  }
}
?>
