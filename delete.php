<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if (isset($_POST['sendId'])) {
    $id = $_POST['sendId'];

    $sql = "DELETE  from `users` where id=$id";

    $result = mysqli_query($con, $sql);
}
