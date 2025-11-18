<?php
session_start();

// Thông tin kết nối MySQL
$host   = "localhost";
$user   = "root";
$pwd    = "";
$sql_db = "lab10_db";   // tên database bạn dùng ở STEP 1

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_msg = "";

// Xử lý khi bấm nút Login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user 
            WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Đăng nhập thành công
        $_SESSION['username'] = $username;
        header("Location: profile.php");
        exit();
    } else {
        $error_msg = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="login.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<p style="color: red;">
    <?php echo $error_msg; ?>
</p>

</body>
</html>
