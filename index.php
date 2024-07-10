<?php
session_start();
include "connect.php";

if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else {
    $error = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form class="login-form" action="login.php" method="POST">
    <h2>Inventory Management System</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="Enter username">
    <br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter password" autocomplete="off">
    <br><br>
    <a href="#" class="forget-password">Forget Password?</a>
    <br><br>
    <input type="submit" value="Login">
    <?php if (isset($_SESSION['error'])) {?>
        <p style="color: red;"><?php echo $_SESSION['error'];?></p>
        <?php unset($_SESSION['error']); ?>
    <?php }?>
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
</form>
   
    <script src="script.js"></script>
</body>
</html>