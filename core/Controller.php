<?php

abstract class Controller{

    private array $response;

    protected function view(string $view, array $params = null){
        if(file_exists(CDIR.'/views/'.$view.'.php')){
            require_once CDIR.'/views/'.$view.'.php';
            unset($_SESSION["message"]);
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

    protected function addResMessage(array $message){
        $this->response["messages"][] = $message;
    }

    protected function addResRedirect(string $path){
        $this->response["redirect"] = URL."/".$path;
    }

    protected function sendResponse(){

        if(!isset($this->response["success"])){
            $this->response["success"] = 1;
        }

        if(isset($this->response["messages"])){
            if(count($this->response["messages"]) > 0){
                $this->response["success"] = 0;
            }
        }

        echo json_encode($this->response);
        exit();
    }
}