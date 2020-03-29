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
            exit("404");
        }

        $userModel = $this->model("User");
        $userData =  $userModel->getByColumn([
            "email" => $_POST["email"],
            "password" => md5($_POST["password"])
        ]);

        if(!$userData){
            exit("404");
        }
        session_start();
        $_SESSION["auth"] = true;
        $_SESSION["email"] = $email;

        header("location:".URL);


    }

    public function logout(){

        auth::required();
        unset($_SESSION["auth"]);
        unset($_SESSION["email"]);
        session_destroy();
        header("location:".URL);
        exit();

    }



}