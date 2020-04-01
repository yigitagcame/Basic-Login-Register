<?php

class HomeController extends Controller {

    public function main(int $id){

        redirect::to("/user/profile");

    }


}