<?php

class HomeController extends Controller {

    public function main(int $id){

        header("location:".URL."/user/profile");
        exit();

    }


}