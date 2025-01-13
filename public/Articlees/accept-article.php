<?php
require '../../vendor/autoload.php';
use App\Models\article ;

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['id'])){
    $articleId = $_POST['id'];
    $article = new article();
    $result = $article->acceptArticle($articleId);
    if ($result) {
        header('Location: ../index.php');
        exit;
    } else {
        echo "une erreur de l'acceptation !";
    };
}
 else {
    echo "ID ";
}