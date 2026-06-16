<?php
session_start();
include('db_connect.php');
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['user'] = $username;
        $_SESSION['cart'] = array(); // Initialize individual cart container
        header("Location: kitchen1.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1920') no-repeat center center fixed; background-size: cover; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: rgba(255,255,255,0.95); backdrop-filter: blur(5px); padding: 30px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #333; border-bottom: 2px solid #e23744; padding-bottom: 10px; margin-top: 0; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #555; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .submit-btn { width: 100%; background-color: #e23744; color: white; border: none; padding: 14px; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>LogIn</h2>
    <?php if($error) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    <form action="login.php" method="POST">
        <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
        <button type="submit" class="submit-btn">Login</button>
        <p style="text-align:center; margin-top:15px;">New User? <a href="sign1.php" style="color:#e23744;">Register here</a></p>
    </form>
</div>
</body>
</html>