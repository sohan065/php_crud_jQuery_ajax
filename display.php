<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
extract($_POST);
if (isset($_POST['sendDisplay'])) {
    $table = '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>';

    $sql = "select * from `users`";
    $result = mysqli_query($con, $sql);

    $number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $table .= '<tr>
      <th scope="row">' . $number . '</th>
      <td>' . $row['name'] . '</td>
      <td>' . $row['email'] . '</td>
      <td>
      <button class="btn btn-primary" onClick="editUser(' . $row['id'] . ')">Edit</button>
      <button class="btn btn-danger" onClick="deleteUser(' . $row['id'] . ')">Delete</button>
      
      </td>

    </tr>';
        $number++;
    }
    $table .= ' </tbody>
        </table>';

    echo $table;
} else if (isset($_POST['searchData'])) {
    $keyword = $_POST['searchData'];
    $table = '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>';

    $sql = "SELECT * FROM `users` WHERE name LIKE '%$keyword%'";
    $result = mysqli_query($con, $sql);

    $number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $table .= '<tr>
      <th scope="row">' . $number . '</th>
      <td>' . $row['name'] . '</td>
      <td>' . $row['email'] . '</td>
      <td>
      <button class="btn btn-primary" onClick="editUser(' . $row['id'] . ')">Edit</button>
      <button class="btn btn-danger" onClick="deleteUser(' . $row['id'] . ')">Delete</button>
      
      </td>

    </tr>';
        $number++;
    }
    $table .= ' </tbody>
        </table>';

    echo $table;
}
