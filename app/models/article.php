<?php
 namespace App\Models;
 use App\Crud\Crud;

class article extends crud {
  private $table = 'articles';

  public function __construct(){
      parent::__construct();
  }
  

  public function selectAllArticle(){
      return $this-> displayArticles();
  }

  public function selectArticle($id){
      return $this->selectRecords($this->table, '*', 'id = ' . $id);
  }

  public function addArticle(array $data){
      return $this->insertRecord($this->table, $data);
  }

  public function updateArticle(array $data, int $id){
      return $this->updateRecord($this->table, $data, $id);
  }

  public function deleteArticle(int $id){
      return $this->deleteRecord($this->table, $id);
  }

  public function countArticle(){
      $result = $this->selectRecords($this->table, 'COUNT(*) as total');
      return $result[0]['total'];
  }
  public static function displayArticles() {
    return parent::displayArticles();
}

public static function getTopArticles($limit = 5) {
    return parent::getTopArticles($limit);
}
 
public static function addTag($articleId, $tagId ){
  parent::addTag($articleId,$tagId);
}

public static function acceptArticle($articleId){
    return parent::acceptArticle($articleId);
}

public static function rejectArticle($articleId){
    return parent::rejectArticle($articleId);
}
public static function getPublishedArticles() {
    return parent::getPublishedArticles();
}

public static function getTags($articleId){
    return parent::getTags($articleId);
}


}