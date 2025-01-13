<?php
require '../../vendor/autoload.php';
use App\Models\article ;

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['id'])){
    $articleId = $_POST['id'];
    $article = new article();
    $result = $article->rejectArticle($articleId);
    if ($result) {
        header('Location:../index.php');
        exit;
    } else {
        echo "Erreur lors du refus de l'article.";
    }} else {
    echo "ID";
    }
    ?>
