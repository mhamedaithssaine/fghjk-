<?php
require '../vendor/autoload.php';
session_start();
use App\Models\article;


$article = new article();
$publishedArticles = $article->getPublishedArticles();
use App\Crud\Crud;
$auth = new Crud();
if (!$auth->isAuth()) {
  $role = $auth->getRole();
  echo $role;
  switch ($role) {
    case 'admin':
        header('location: index.php');
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

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
  $auth->logout();
  header('Location: login.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Home Page</title>
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #dddfe2;
            border-radius: 8px;
            background-color: #fff;
        }
        .card-header {
            padding: 15px;
            border-bottom: 1px solid #dddfe2;
            display: flex;
            align-items: center;
        }
        .card-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .card-header .author-name {
            font-weight: bold;
        }
        .card-body {
            padding: 15px;
        }
        .card-body img {
            width: 100%;
            border-radius: 8px;
        }
        .card-footer {
            padding: 10px;
            border-top: 1px solid #dddfe2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-footer .btn {
            margin: 0 5px;
        }
    </style>
</head>
<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'components/sidebarHome.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php include 'components/topbarHome.php'; ?>
            <!-- End of Topbar -->

            <!-- Articles -->
            <div class="container">
                <?php foreach ($publishedArticles as $article): ?>
                    <div class="card">
                        <div class="card-header">
                            <img src="https://via.placeholder.com/40" alt="Author Image">
                            <div>
                                <div class="author-name"><?php echo htmlspecialchars($article['author_name'] ?? 'Unknown'); ?></div>
                                <div class="timestamp"><?php echo date('M d, Y H:i', strtotime($article['created_at'] ?? '')); ?></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><?php echo htmlspecialchars(substr($article['content'] ?? '', 0, 300)); ?>...</p>
                            <img src="<?php echo htmlspecialchars($article['featured_image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($article['title'] ?? ''); ?>">
                        </div>
                        <div class="card-footer">
                            <a href="article.php?id=<?php echo $article['id'] ?? ''; ?>" class="btn btn-primary btn-sm">Lire plus</a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://yourwebsite.com/article.php?id=' . ($article['id'] ?? '')); ?>&text=<?php echo urlencode($article['title'] ?? ''); ?>" class="btn btn-info btn-sm" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://yourwebsite.com/article.php?id=' . ($article['id'] ?? '')); ?>" class="btn btn-primary btn-sm" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'components/footer.php'; ?>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
