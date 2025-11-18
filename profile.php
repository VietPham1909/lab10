<?php
session_start();

// Nếu chưa đăng nhập thì chặn
if (!isset($_SESSION['username'])) {
    echo "Access denied. Please <a href='login.php'>login</a>.";
    exit();
}

// Kết nối database
$host   = "localhost";
$user   = "root";
$pwd    = "";
$sql_db = "lab10_db";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

// Lấy thông tin user hiện tại
$sql    = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row    = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
</head>
<body>

<h2>User Profile</h2>

<p><strong>Username:</strong> <?php echo $row['username']; ?></p>
<p><strong>Password:</strong> <?php echo $row['password']; ?></p>
<p><strong>Email:</strong> <?php echo $row['email']; ?></p>

<hr>

<h3>Edit Profile (Update Email)</h3>

<form method="POST" action="update_profile.php">
    <label>New Email:</label><br>
    <input type="email" name="email" required><br><br>
    <input type="submit" value="Update Email">
</form>

</body>
</html>
