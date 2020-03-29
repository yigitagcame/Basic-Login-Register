<?php

class Home extends Model{

    private string $table = "settings";

    public function getAll(){
        return $this->fetchAll($this->table);
    }

    public function get(int $id){
        return $this->fetchById($this->table,$id);
    }

    public function create(array $params){
        return $this->insert($this->table,$params);
    }

    public function update(array $params, int $id){
        return $this->updateById($this->table,$id,$params);
    }

    public function delete(int $id){
        return $this->removeById($this->table,$id);
    }


}