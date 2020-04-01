<?php

class UserController extends Controller{

    private object $userModel;
    private object $attrModel;
    private array $user;

    public function __construct(){

        auth::required();

        $this->userModel = $this->model("user");
        $this->attrModel = $this->model("attr");

        $this->user = $this->userModel->getByColumn(["email" => $_SESSION["email"]]);
    }

    public function main(){

        redirect::to("user/profile");

    }

    public function profile(){

        $attrs = $this->attrModel->get($this->user["id"]);

        $this->view("profile", ["attrs" => $attrs]);


    }

    public function update(){
        request::post();

        $fields = $_POST["fields"];
        $values = $_POST["values"];
        $ids = $_POST["ids"];

        if(count($fields) != count($values)){
            abort::it();
        }

        for ($i = 0; $i < count($fields); $i++){

            $attrArray = [
                "field" => $fields[$i],
                "value" => $values[$i],
                "user_id" => $this->user["id"]
            ];

            if($ids[$i] == "0"){
                $this->attrModel->set($attrArray);
            }else{
                $this->attrModel->update($ids[$i],$attrArray);
            }


        }

        $_SESSION["message"] = ATTR_UPDATED;

        redirect::to("user/profile");

    }

    public function attr(int $id){

        $userAttr = $this->attrModel->confirm(["id" => $id, "user_id" => $this->user["id"]]);

        if(count($userAttr) > 0){
            $this->attrModel->remove($id);

            echo "1"; // True for JS
            exit();

        }else{
            abort::it();
        }

    }



}
