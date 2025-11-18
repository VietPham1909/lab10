<?php
session_start();

// Chỉ cho update nếu đã đăng nhập
if (!isset($_SESSION['username'])) {
    echo "Access denied.";
    exit();
}

$host   = "localhost";
$user   = "root";
$pwd    = "";
$sql_db = "lab10_db";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username   = $_SESSION['username'];
$new_email  = $_POST['email'];

// Câu lệnh UPDATE
$sql = "UPDATE user SET email='$new_email' WHERE username='$username'";

if (mysqli_query($conn, $sql)) {
    // Update thành công -> quay lại profile
    header("Location: profile.php");
    exit();
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
?>
