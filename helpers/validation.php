<?php


class validation{

    public static function validate(array $fields){
      $_messages = [];

      foreach ($fields as $field => $type){

          switch ($type){

              case "name":

                  if(!self::name($field)){
                      $_messages[] =  [ERROR_NAME];
                  }

                  break;

              case "email":

                  if(!self::email($field)){
                      $_messages[] = [ERROR_EMAIL];
                  }

                  break;

              case "password":

                  if(!self::password($field)){
                      $_messages[] =  [ERROR_PASSWORD];
                  }

                  break;



          }
      }

      return $_messages;

    }

    public static function email(string $email){


        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }


    }


    public static function password(string $password){

        $passDigit = strlen($password);

        if ($passDigit < 6 ){
            return false;
        }else{
            return true;
        }

    }

    public static function name(string $name){

        if(!preg_match("/^[a-zA-Z ]*$/",$name) OR $name == ''){
            return false;
        }else{
            return true;
        }

    }

    public static function passCompare(string $password,string $passwordR){

        if ($password != $passwordR){
            return false;
        }else{
            return true;
        }

    }



}