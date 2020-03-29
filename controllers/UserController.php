<?php

class UserController extends Controller{

    private object $userModel;
    private array $user;

    public function __construct(){

        auth::required();

        $this->userModel = $this->model("user");

        $this->user = $this->userModel->getByColumn(["email" => $_SESSION["email"]]);
    }

    public function main(){

        header("location:".URL."/user/profile");

    }

    public function profile(){

        $attrs = $this->userModel->getAttr($this->user["id"]);

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

                $this->userModel->setAttr($attrArray);
            }else{
                $this->userModel->updateAttr($ids[$i],$attrArray);
            }


        }

        header("location:".URL."/user/profile");

    }

    public function attr(int $id){

        $userAttr = $this->userModel->confirmAttr(["id" => $id, "user_id" => $this->user["id"]]);

        if(count($userAttr) > 0){
            $this->userModel->removeAttr($id);

            echo "1"; // True for JS

        }else{
            abort::it();
        }

    }



}
