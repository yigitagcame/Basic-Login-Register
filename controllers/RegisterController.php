<?php

class RegisterController extends Controller{


    public function main(){

        auth::prohibited();
        $this->view("register");

    }

    public function create(){

        request::post();


        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordR = $_POST["password_r"];

        $validation = validation::validate([
            $email => "email",
            $password => "password",
            $passwordR => "password"
        ]);

        $passCompare = validation::passCompare($password,$passwordR);


        if(count($validation) > 0 OR !$passCompare){
            exit("404");
        }

        $userModel = $this->model("User");

        $createUser = $userModel->create([
            "email" => $email,
            "password" => md5($password)
        ]);

        if($createUser){
            header("location:".URL."/auth");
        }

    }

}