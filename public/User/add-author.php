<?php 
require '../../vendor/autoload.php';

use App\Models\User;
 
$author = new User();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $newData = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password_hash' => $_POST['password_hash'],
        'bio' => $_POST['bio'],
        'profile_picture_url' => $_POST['profile_picture_url']
    ];
    $result = $author->addusers($newData);
    if ($result === false) {
        echo "existe ";
    } else {
        header('Location: ../index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <title>Add Author</title>
</head>
<body>

<div id="wrapper">
            <?php include '../components/sidebar.php'; ?>
             <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
            <?php include '../components/topbar.php'; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Author</h6>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea class="form-control" id="bio" name="bio" required></textarea>
            </div>
            <div class="form-group">
                <label for="profile_picture_url">Profile Picture URL:</label>
                <input type="text" class="form-control" id="profile_picture_url" name="profile_picture_url" required>
            </div>
            <div class="form-group">
                <label for="password">  Password :</label>
                <input type="password" class="form-control" id="password_hash" name="password_hash" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Add Author</button>
        </form>
    </div>
</div>
</div>
</div>
</div>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>
</body>
</html>