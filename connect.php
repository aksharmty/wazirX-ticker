<?php
$connection = mysqli_connect('localhost', 'database_username', 'database_password');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'databse_name');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>
