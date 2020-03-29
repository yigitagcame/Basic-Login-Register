<?php

class User extends Model {

    private string $table = "users";

    public function create(array $params){
        return $this->insert($this->table,$params);
    }

    public function getByColumn(array $params){
        return $this->fetchByColumn($this->table,$params);
    }

    public function getAttr(int $userId){
        $pivotTable = "attr";
        return $this->fetchByColumn($pivotTable,["user_id" => $userId],true);
    }

    public function setAttr(array $params){
        $pivotTable = "attr";
        return $this->insert($pivotTable,$params);
    }

    public function confirmAttr(array $params){
        $pivotTable = "attr";
        return $this->fetchByColumn($pivotTable,$params);
    }

    public function updateAttr(int $id,array $params){
        $pivotTable = "attr";
        return $this->updateById($pivotTable,$id,$params);
    }

    public function removeAttr(int $id){
        $pivotTable = "attr";
        return $this->removeById($pivotTable,$id);
    }



}