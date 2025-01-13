<?php
require '../vendor/autoload.php';
session_start();

use App\Crud\Crud;

$auth = new Crud();

function redirectRole($role) {
    switch ($role) {
        case 'admin':
            header('Location: index.php');
            break;
        case 'author':
            header('Location: author.php');
            break;
        case 'user':
            header('Location: home.php');
            break;
        default:
            header('Location: login.php');
            break;
    }
    exit;
}

if ($auth->isAuth()) {
    $role = $auth->getRole();
    redirectRole($role);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo $_POST['email'];
  echo $_POST['password'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($auth->login($email, $password)) {
        $role = $auth->getRole();
        redirectRole($role);
    } else {
        $auth->setMessage('Login failed');
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<?php
  if ($auth->hasMessage()) {
    echo "<p>" . $auth->getMessage() . " </p>";
  }
  ?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome </h1>
                                    </div>
                                    <form class="user" class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                              name="email"  placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="password"  id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                    
                                        </div>
                                        <input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="Login">
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="pages/forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="pages/register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>