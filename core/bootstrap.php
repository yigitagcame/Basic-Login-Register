<?php

class Bootstrap {

    private string $controller,$action;
    private int $id;

    public function __construct(array $req){
        // Set the default controller and action, in case
        $this->controller = $req["controller"] != "" ? ucfirst(strtolower($req["controller"])).'Controller' : "HomeController";
        $this->action = $req["action"] != "" ? $req["action"] : "main";
        $this->id = (int) $req["id"];
    }

    public function registerController() {

        spl_autoload_register(function ($class_name) {
            include CDIR.'/controllers/'.$class_name.'.php';
        });

        if(!file_exists(CDIR.'/controllers/'.$this->controller.'.php')){
            exit("404");
        }

        require_once CDIR.'/controllers/'.$this->controller.'.php';

        if(!class_exists($this->controller)){
            exit("404");
        }

        if (!method_exists($this->controller,$this->action)){
            exit("404");
        }

        if(($this->action == "create" OR $this->action == "update")  AND ! $_POST){
            exit("404");
        }

        $controller =  new $this->controller();

        return $controller->{$this->action}($this->id);

    }

}