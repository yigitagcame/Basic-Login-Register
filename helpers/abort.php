<?php

class abort{

    public static function it(){

        header("location:".URL."/404.html");
        exit();

    }

}