<?php

$con = new mysqli('localhost', 'root', 'root1234', 'crud');

if (!$con) {
    die(mysqli_error($con));
}