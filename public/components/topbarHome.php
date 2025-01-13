<?php 
require '../vendor/autoload.php';
use App\Crud\Crud;

if (!$auth->isAuth()) {
  $role = $auth->getRole();
  echo $role;
  switch ($role) {
    case 'admin':
        header('location: ../index.php');
        break;
    case 'author':
        header('Location: ../author.php');
        break;
    case 'user':
        header('Location: ../home.php');
        break;
    default:
        header('Location: ../login.php');
        break;
}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
  $auth->logout();
  header('Location: login.php');
  exit;
}


?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
        <img src="path_to_your_logo.png" alt="Logo" style="height: 30px;">
    </a>

    <!-- Search Bar -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Create Post Button -->
    

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">User Name</span>
                <img class="img-profile rounded-circle" src="https://via.placeholder.com/40">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a> -->
                <form action="index.php" method="POST">
                    <input type="submit" name='logout'  value="Logout">
              </form>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
