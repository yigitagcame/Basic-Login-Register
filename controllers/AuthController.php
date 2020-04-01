<?php

class AuthController extends Controller {

    public function main(){

        auth::prohibited();
        return $this->view("login");

    }

    public function login(){
        request::post();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $validation = validation::validate([
            $email => "email",
            $password => "password"
        ]);

        if(count($validation) > 0){
            $this->addResMessage($validation);
            $this->sendResponse();
        }

        $userModel = $this->model("User");
        $userData =  $userModel->getByColumn([
            "email" => $_POST["email"],
            "password" => md5($_POST["password"])
        ]);

        if($userModel->isError()){
            $this->addResMessage([ERROR_UNEXPECTED]);
            $this->sendResponse();
        }

        if(!$userData){
            $this->addResMessage([ERROR_LOGIN]);
            $this->sendResponse();
        }

        session_start();
        $_SESSION["auth"] = true;
        $_SESSION["name"] = $userData["name"];
        $_SESSION["email"] = $userData["email"];

        $this->addResRedirect( "user/profile");
        $this->sendResponse();


    }

    public function logout(){

        auth::required();
        unset($_SESSION["auth"]);
        unset($_SESSION["email"]);
        session_destroy();
        redirect::to('');
        exit();

    }



}