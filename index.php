<?php

include 'connection.php';

$sql = "select * from `users`";
$result = mysqli_query($con, $sql);

$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#userAddModel">
                    Add User
                </button>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                </ul>

                <div id="navbarSupportedContent">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" id="search" required>
                        <button type="submit" class="btn btn-outline-success" onclick="searchData()">Search</button>
                    </div>
                </div>

            </div>
        </nav>

        <h6 class="text-center mt-3">all data</h6>
        <div id="displayUsers"></div>

    </div>


    <!--user add  Modal -->
    <div class="modal fade" id="userAddModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="user_email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addUser()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!--user update  Modal -->
    <div class="modal fade" id="userUpdateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Id :</label>
                        <input type="text" class="form-control" id="id_to_update" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="update_user_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="update_user_email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateUser()">Update</button>
                </div>
            </div>
        </div>
    </div>


    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- custom js -->
    <script>
        $(document).ready(function() {
            display();
        });

        const searchData = () => {
            var keyword = $('#search').val();
            $.ajax({
                url: "display.php",
                type: 'post',
                data: {
                    searchData: keyword,
                },
                success: function(data, status) {
                    $('#displayUsers').html(data);
                }
            })

        }



        const display = () => {
            var display = true;
            $.ajax({
                url: "display.php",
                type: 'post',
                data: {
                    sendDisplay: display,

                },
                success: function(data, status) {
                    $('#displayUsers').html(data);
                }
            })
        }

        const editUser = (id) => {

            $('#userUpdateModel').modal('show');
            $.ajax({
                url: "edit.php",
                type: 'post',
                data: {
                    sendId: id,
                },
                success: function(data, status) {
                    var responseData = JSON.parse(data);
                    $('#id_to_update').val(responseData.id);
                    $('#update_user_name').val(responseData.name);
                    $('#update_user_email').val(responseData.email);

                }
            })

        }
        const deleteUser = (id) => {
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    sendId: id,
                },
                success: function(data, status) {
                    display();
                }
            })
        }

        // update user 
        function updateUser() {
            var itToUpdate = $('#id_to_update').val();
            var nameAdd = $('#update_user_name').val();
            var emailAdd = $('#update_user_email').val();

            $.ajax({
                url: "update.php",
                type: 'post',
                data: {
                    sendIdToUpdate: itToUpdate,
                    sendName: nameAdd,
                    sendEmail: emailAdd,
                },
                success: function(data, status) {
                    // Clear input values
                    $('#id_to_update').val('');
                    $('#update_user_name').val('');
                    $('#update_user_email').val('');
                    $('#userUpdateModel').modal('hide');
                    display();
                }
            })
        }
        // add user 
        function addUser() {
            var nameAdd = $('#user_name').val();
            var emailAdd = $('#user_email').val();

            $.ajax({
                url: "insert.php",
                type: 'post',
                data: {
                    sendName: nameAdd,
                    sendEmail: emailAdd,
                },
                success: function(data, status) {
                    // Clear input values
                    $('#user_name').val('');
                    $('#user_email').val('');
                    display();
                }
            })
        }
    </script>
</body>

</html>