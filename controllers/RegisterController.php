<?php

class RegisterController extends Controller{


    public function main(){

        auth::prohibited();
        $this->view("register");

    }

    public function create(){

        request::post();


        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $validation = validation::validate([
            $name => "name",
            $email => "email",
            $password => "password"
        ]);

        if(count($validation) > 0){
            $this->addResMessage($validation);
            $this->sendResponse();
        }

        $userModel = $this->model("User");

        $userData =  $userModel->getByColumn([
            "email" => $_POST["email"]
        ]);

        if($userModel->isError()){
            $this->addResMessage([ERROR_UNEXPECTED]);
            $this->sendResponse();
        }

        if($userData){
            $this->addResMessage([ERROR_EMAIL_DUPLICATE]);
            $this->sendResponse();
        }

        $createUser = $userModel->create([
            "name" => $name,
            "email" => $email,
            "password" => md5($password)
        ]);

        if($createUser){
            session_start();
            $_SESSION["auth"] = true;
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;

            $this->addResRedirect( "user/profile");
            $this->sendResponse();
        }

    }

}