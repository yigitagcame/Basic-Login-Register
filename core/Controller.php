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

    protected function model(string $model){

        $model = ucfirst(strtolower($model));

        if(!file_exists(CDIR.'/models/'.$model.'.php')){

            exit("404");
        }

        require_once CDIR.'/models/'.$model.'.php';

        if(!class_exists($model)){
            echo $model;
            exit("404");
        }


        return new $model;

    }
}