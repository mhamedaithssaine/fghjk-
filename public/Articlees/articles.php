<?php

require '../../vendor/autoload.php';
use App\Models\Article;
use App\Models\Category;
use App\Models\User;



$article = new Article();
$allArticles = $article->selectAllArticle();


$category = new Category();
$allCategories = $category->selectAllCategory();

$user = new User();
$allUsers = $user->selectAllusers();



if (isset($_GET['delete'])) {
    $articleId = $_GET['delete'];
    $article->deleteArticle($articleId);
    header('Location: ../index.php');
}

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update'])){
    $articleId = $_POST['id'];
    $updateData= [
        'title'=> $_POST['title'],
        'slug' => $_POST['slug'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'featured_image' => $_POST['featured_image'],
        'status' => $_POST['status'],
        'scheduled_date' => $_POST['scheduled_date'],
        'author_id' => $_POST['author_id']

    ];
    $article->updateArticle($updateData,$articleId);
    header('Location:../index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>Liste des articles</title>
</head>
<div id="wrapper">
            <?php include '../components/sidebar.php'; ?>
             <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
            <?php include '../components/topbar.php'; ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des articles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Featured Image</th>
                        <th>Status</th>
                        <th>Scheduled Date</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allArticles as $article): ?>
                        <tr>
                        <td><?php echo htmlspecialchars($article['id']); ?></td>
                                        <td><?php echo htmlspecialchars($article['title']); ?></td>
                                        <td><?php echo htmlspecialchars($article['slug']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($article['content'], 0, 50)); ?>...</td>
                                        <td><?php echo htmlspecialchars($article['category_name']); ?></td>
                                        <td><?php echo htmlspecialchars($article['featured_image']); ?></td>
                                        <td><?php echo htmlspecialchars($article['status']); ?></td>
                                        <td><?php echo htmlspecialchars($article['scheduled_date']); ?></td>
                                        <td><?php echo htmlspecialchars($article['author_name']); ?></td>
                                        <td>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal<?php echo $article['id']; ?>">Update</button>
                                <a href="?delete=<?php echo $article['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="updateModal<?php echo $article['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $article['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel<?php echo $article['id']; ?>">update article</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                            <div class="form-group">
                                                <label for="title<?php echo $article['id']; ?>">Title:</label>
                                                <input type="text" class="form-control" id="title<?php echo $article['id']; ?>" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="slug<?php echo $article['id']; ?>">Slug:</label>
                                                <input type="text" class="form-control" id="slug<?php echo $article['id']; ?>" name="slug" value="<?php echo htmlspecialchars($article['slug']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="content<?php echo $article['id']; ?>">Content:</label>
                                                <textarea class="form-control" id="content<?php echo $article['id']; ?>" name="content" rows="5" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id<?php echo $article['id']; ?>">Category:</label>
                                                <select class="form-control" id="category_id<?php echo $article['id']; ?>" name="category_id" required>
                                                                <?php foreach ($allCategories as $category): ?>
                                                                    <option value="<?php echo $category['id']; ?>" <?php if ($article['category_id'] == $category['id']) echo 'selected'; ?>>
                                                                        <?php echo htmlspecialchars($category['name']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>                                            </div>
                                            <div class="form-group">
                                                <label for="featured_image<?php echo $article['id']; ?>">Featured Image:</label>
                                                <input type="text" class="form-control" id="featured_image<?php echo $article['id']; ?>" name="featured_image" value="<?php echo htmlspecialchars($article['featured_image']); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="status<?php echo $article['id']; ?>">Status:</label>
                                                <select class="form-control" id="status<?php echo $article['id']; ?>" name="status" required>
                                                    <option value="draft" <?php if ($article['status'] === 'draft') echo 'selected'; ?>>Draft</option>
                                                    <option value="published" <?php if ($article['status'] === 'published') echo 'selected'; ?>>Published</option>
                                                    <option value="scheduled" <?php if ($article['status'] === 'scheduled') echo 'selected'; ?>>Scheduled</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="scheduled_date<?php echo $article['id']; ?>">Scheduled Date:</label>
                                                <input type="datetime-local" class="form-control" id="scheduled_date<?php echo $article['id']; ?>" name="scheduled_date" value="<?php echo htmlspecialchars($article['scheduled_date']); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="author_id<?php echo $article['id']; ?>">Author:</label>
                                                <select class="form-control" id="author_id<?php echo $article['id']; ?>" name="author_id" required>
                                                                <?php foreach ($allUsers as $user): ?>
                                                                    <option value="<?php echo $user['id']; ?>" <?php if ($article['author_id'] == $user['id']) echo 'selected'; ?>>
                                                                        <?php echo htmlspecialchars($user['username']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>                                            </div>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>                                                               
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../js/demo/datatables-demo.js"></script>
</body>
</html>