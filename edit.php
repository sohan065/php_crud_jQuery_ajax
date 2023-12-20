<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if (isset($_POST['sendId'])) {
    $id = $_POST['sendId'];
    $sql = "SELECT * FROM `users` WHERE id=$id";
    $result = mysqli_query($con, $sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response = $row;
    }

    echo json_encode($response);
}
