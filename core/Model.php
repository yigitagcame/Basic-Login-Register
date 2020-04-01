<?php

class Model{

    private object $pdo;
    private bool $error = false;
    private bool $errorMessage;


    public function __construct(){

        $dsn = DB_ENGINE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET.";port=".DB_PORT;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (\PDOException $e) {
            $this->error = true;
            $this->errorMessage = $e->getMessage();
        }

    }

    public function query(string $query,array $params = null,bool $all = false){

        $statementType = strtoupper(explode(" ",$query)[0]);

        if($this->error){
            return false;
        }

        $stmt = $this->pdo->prepare($query);
        $exec = $stmt->execute($params);

        if($statementType != "SELECT"){
            return $exec;
        }elseif ($all){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    protected function fetchAll(string $table){
        return $this->query("SELECT * FROM ".$table);
    }

    protected function fetchById(string $table, int $id, $all){
        return $this->query("SELECT * FROM ".$table. " WHERE id = :id LIMIT 1",[ "id" => $id]);
    }

    protected function fetchByColumn(string $table, array $params, bool $all = false){

        if(count($params) > 1){
            $setKeys = implode("= ? AND ",array_keys($params))."= ?";
        }else{
            $setKeys = array_keys($params)[0]." = ?";
        }

        if($all){
            $limit = "";
        }else{
            $limit = " LIMIT 1";
        }

        return $this->query("SELECT * FROM ".$table. " WHERE ".$setKeys." ".$limit,array_values($params),$all);
    }

    protected function insert(string $table, array $params){

        if(count($params) > 1){
            $keys = implode(",",array_keys($params));
            $values = rtrim(str_repeat(" ? ,",count($params)),",");
        }else{
            $keys = array_keys($params)[0];
            $values = "?";
        }

        return $this->query("INSERT INTO ".$table." (".$keys.") VALUES (".$values.")", array_values($params));
    }

    protected function updateById(string $table, int $id, array $params){

        if(count($params) > 1){
            $setKeys = implode("= ? , ",array_keys($params))."= ?";
        }else{
            $setKeys = array_keys($params)[0]." = ?";
        }

        return $this->query("UPDATE ".$table." SET ".$setKeys." WHERE id='".$id."'", array_values($params));
    }

    protected function removeById(string $table, int $id){

        return $this->query("DELETE FROM ".$table. " WHERE id = :id",[ "id" => $id]);
    }

    public function isError(){
        return $this->error;
    }

    public function getError(){
        return $this->errorMessage;
    }



}