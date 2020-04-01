<?php

class auth{

    public static function required(){
        session_start();
        if(!isset($_SESSION["auth"])){
            header("location:".URL."/auth");
            exit();
        }
    }

    public static function prohibited(){
        session_start();
        if(isset($_SESSION["auth"])){
            header("location:".URL."/");
            exit();
        }
    }

}