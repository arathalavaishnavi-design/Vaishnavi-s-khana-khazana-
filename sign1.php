<?php
include('db_connect.php');
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Added for secure login

    // Check if user already exists
    $check = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        $message = "<div style='color:red; text-align:center;'>Username or Email already registered!</div>";
    } else {
        $sql = "INSERT INTO users (username, phone, email, address, password) VALUES ('$username', '$phone', '$email', '$address', '$password')";
        if ($conn->query($sql) === TRUE) {
            $message = "<div style='color:green; text-align:center;'>Registration Successful! <a href='login.php'>Login here</a></div>";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: url('https://images.unsplash.com/photo-1543353071-087092ec169a?w=1920') no-repeat center center fixed; background-size: cover; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 40px; }
        .form-container { background: rgba(255,255,255,0.95); backdrop-filter: blur(5px); padding: 30px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.2); width: 100%; max-width: 450px; }
        h2 { margin-top: 0; color: #333; text-align: center; border-bottom: 2px solid #e23744; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #555; }
        input, textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 16px; }
        input:focus, textarea:focus { outline: none; border-color: #e23744; box-shadow: 0 0 5px rgba(226, 55, 68, 0.2); }
        .submit-btn { width: 100%; background-color: #e23744; color: white; border: none; padding: 14px; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .submit-btn:hover { background-color: #bc2c37; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Registration</h2>
    <?php echo $message; ?>
    <form action="sign1.php" method="POST">
        <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
        <div class="form-group"><label>Phone Number</label><input type="tel" name="phone" pattern="[0-9]{10}" required></div>
        <div class="form-group"><label>Email Address</label><input type="email" name="email" required></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
        <div class="form-group"><label>Full Address</label><textarea name="address" required></textarea></div>
        <button type="submit" class="submit-btn">Submit Information</button>
        <p style="text-align:center; margin-top:15px;">Already registered? <a href="login.php" style="color:#e23744;">Login here</a></p>
    </form>
</div>
</body>
</html>