<?php

namespace App\Models;

use App\Crud\Crud;

class Tag extends Crud {

    private $table = 'tags';

    public function __construct(){
        parent::__construct();
    }

    public function selectAllTag(){
        return $this->selectRecords($this->table);
    }

    public function selectTags($id){
        return $this->selectRecords($this->table, '*', 'id = ' . $id);
    }

    public function addTags(array $data){
        $exist = $this->selectRecords($this->table, '*', 'name = ?', [$data['name']]);
        if(!empty($exist)){
            return false;
        }
        return $this->insertRecord($this->table, $data);
    }

    public function updateTags(array $data, int $id){
        return $this->updateRecord($this->table, $data, $id);
    }

    public function deleteTags(int $id){
        return $this->deleteRecord($this->table, $id);
    }

    public function countTags(){
        $result = $this->selectRecords($this->table, 'COUNT(*) as total');
        return $result[0]['total'];
    }
}
