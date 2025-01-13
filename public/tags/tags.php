<?php

require '../../vendor/autoload.php';
use App\Models\Tag;
$tag = new Tag();

$allTags = $tag->selectAllTag();

if (isset($_GET['delete'])) {
    $tagId = $_GET['delete'];
    $tag->deleteTags($tagId);
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $tagId = $_POST['id'];
    $updatedData = [
        'name' => $_POST['name']
    ];
    $tag->updateTags($updatedData, $tagId);
    header('Location: ../index.php');
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

    <title>Liste des tags</title>
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
                            <h6 class="m-0 font-weight-bold text-primary">Liste des tags</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($allTags as $tag): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($tag['id']); ?></td>
                                            <td><?php echo htmlspecialchars($tag['name']); ?></td>
                                            <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal<?php echo $tag['id']; ?>">update</button>
                                            <a href="?delete=<?php echo $tag['id']; ?>" class="btn btn-danger btn-sm">Delet</a></td>
                                        </tr>
                                        <div class="modal fade" id="updateModal<?php echo $tag['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $tag['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel<?php echo $tag['id']; ?>">Update tag</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
                                            <div class="form-group">
                                                <label for="name<?php echo $tag['id']; ?>">Nom:</label>
                                                <input type="text" class="form-control" id="name<?php echo $tag['id']; ?>" name="name" value="<?php echo htmlspecialchars($tag['name']); ?>" required>
                                            </div>
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
                  <!-- End of Main Content -->

          
                </div>
                <?php include '../components/footer.php'; ?>
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