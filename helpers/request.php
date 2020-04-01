<?php


class request{

    public static function post(){

        if(!$_POST){
            header("location:".URL."/404.html");
            exit();
        }

    }

}