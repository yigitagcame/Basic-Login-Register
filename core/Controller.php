<?php

abstract class Controller{
    protected function view(string $view, array $params = null){
        if(file_exists(CDIR.'/views/'.$view.'.php')){
            require_once CDIR.'/views/'.$view.'.php';
            return;
        }else{
            exit("404");
        }
    }
}