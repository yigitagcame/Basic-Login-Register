<?php


class request{

    public static function post(){

        if(!$_POST){
            abort::it();
        }

    }

}