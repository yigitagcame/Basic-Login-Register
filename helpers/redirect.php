<?php

class redirect{

    public static function to(string $page = ''){

        header("location:".URL."/".$page);
        exit();

    }
}