<?php

class User extends Model {

    private string $table = "users";

    public function create(array $params){
        return $this->insert($this->table,$params);
    }

    public function getByColumn(array $params){
        return $this->fetchByColumn($this->table,$params);
    }

}