<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if (
    isset($_POST['sendIdToUpdate'])
    && isset($_POST['sendName'])
    && isset($_POST['sendEmail'])

) {
    $id = $_POST['sendIdToUpdate'];
    $name = $_POST['sendName'];
    $email = $_POST['sendEmail'];
    $sql = "UPDATE `users` SET name='$name', email='$email' WHERE id=$id";
    $result = mysqli_query($con, $sql);
}
