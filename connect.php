<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();

define('siteurl', 'http://localhost/IMS/');
define('LOCALHOST', 'localhost');
define('db_uname', 'root');
define('db_pass', '');
define('db_name', 'ims_db');

$conn = mysqli_connect(LOCALHOST, db_uname, db_pass, db_name);

if (!$conn) {
    die('Error: ' . mysqli_connect_error());
}
?>
