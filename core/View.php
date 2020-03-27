<?php

class View{
    public static function asset($filepath) :string {
        return URL.'/assets/'.$filepath;
    }
}