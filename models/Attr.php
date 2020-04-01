<?php

class Attr extends Model {

    private string $table = "attrs";

    public function get(int $userId){
        return $this->fetchByColumn($this->table,["user_id" => $userId],true);
    }

    public function set(array $params){
        return $this->insert($this->table,$params);
    }

    public function confirm(array $params){
        return $this->fetchByColumn($this->table,$params);
    }

    public function update(int $id,array $params){
        return $this->updateById($this->table,$id,$params);
    }

    public function remove(int $id){
        return $this->removeById($this->table,$id);
    }



}