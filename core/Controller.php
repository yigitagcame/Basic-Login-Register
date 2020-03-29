<?php

abstract class Controller{

    protected function view(string $view, array $params = null){
        if(file_exists(CDIR.'/views/'.$view.'.php')){
            require_once CDIR.'/views/'.$view.'.php';
            return;
        }else{
            abort::it();
        }
    }

    protected function model(string $model){

        $model = ucfirst(strtolower($model));

        if(!file_exists(CDIR.'/models/'.$model.'.php')){
            abort::it();
        }

        require_once CDIR.'/models/'.$model.'.php';

        if(!class_exists($model)){
            abort::it();
        }


        return new $model;

    }
}