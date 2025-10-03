<?php
session_start();

$users = [
    'admin' => '12345',
    'customer' => '54321'
]; // placeholder, no DB yet

// If already logged in, redirect
if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit;
}

$error = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = ($username === 'admin') ? 'admin' : 'customer';
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="assets/login.css">
</head>
<body>

<div class="box">
    <h2>Welcome!</h2>

    <?php if ($error != ""): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button class="login_button" type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
