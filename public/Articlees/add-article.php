<?php
require '../../vendor/autoload.php';
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use App\Models\article;

$category = new Category();
$categories = $category->selectAllCategory();

$user = new User();

$authors= $user->selectAllUsers();

$tag = new Tag();
$tags= $tag->selectAllTag();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $featured_image = $_POST['featured_image'];
    $status = $_POST['status'];
    $scheduled_date = $_POST['scheduled_date'];
    $author_id = $_POST['author_id'];

    $article = new article();

    $article_Id=$article->addArticle([
        'title' => $title,
        'slug' => $slug,
        'content' => $content,
        'category_id' => $category_id,
        'featured_image' => $featured_image,
        'status' => $status,
        'scheduled_date' => $scheduled_date,
        'author_id' => $author_id
    ]);

if($article_Id && isset($_POST['tag_id'])){
    foreach($_POST['tag_id'] as $tag_id){
        $article->addTag($article_Id,$tag_id);
    }
}

    header('Location: ../index.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        


    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>Add Article</title>
</head>
<body>

<div id="wrapper">
            <?php include '../components/sidebar.php'; ?>
             <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
            <?php include '../components/topbar.php'; ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Add Article</h2>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tags :</label>
                    <div class="form-check">
                        <?php foreach ($tags as $tag): ?>
                            <div class="mb-2">
                                <input class="form-check-input" type="checkbox" 
                                    id="tag_<?php echo $tag['id']; ?>" 
                                    name="tag_id[]" 
                                    value="<?php echo $tag['id']; ?>"
                                    <?php echo (isset($_POST['tag_id']) && in_array($tag['id'], $_POST['tagid'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="tag<?php echo $tag['id']; ?>">
                                    <?php echo htmlspecialchars($tag['name']); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="featured_image">Featured Image:</label>
                    <input type="text" class="form-control" id="featured_image" name="featured_image">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="scheduled">Scheduled</option>
                    </select>
                </div>
               
                <div class="form-group">
                    <label for="author_id">Author:</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author['id'] ?>"><?= htmlspecialchars($author['username']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="scheduled_date">Scheduled Date:</label>
                    <input type="datetime-local" class="form-control" id="scheduled_date" name="scheduled_date">
                </div>
                <button type="submit" class="btn btn-primary">Add Article</button>
            </form>
        </div>
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