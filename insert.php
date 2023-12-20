<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
extract($_POST);
if (isset($_POST['sendName']) && isset($_POST['sendEmail'])) {
    $name = isset($_POST['sendName']) ? trim($_POST['sendName']) : '';
    $email = isset($_POST['sendEmail']) ? trim($_POST['sendEmail']) : '';

    $sql = "INSERT INTO `users` (name, email) VALUES ('$name', '$email')";
    $result = mysqli_query($con, $sql);
}
