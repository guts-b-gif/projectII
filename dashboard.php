<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
} else {
    echo "Username: " . $_SESSION['username'];
    // Add your dashboard content here
}
?>
