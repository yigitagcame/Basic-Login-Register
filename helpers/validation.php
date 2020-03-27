<?php


class validation{

    public static function validate(array $fields){
      $_messages = [];

      //var_dump($fields);

      foreach ($fields as $field => $type){

          switch ($type){
              case "email":

                  if(!$result = self::email($field)){
                      $_messages[] = [
                          "field" => $field,
                          "type" => $type
                      ];
                  }

                  break;

              case "password":

                  if(!$result = self::password($field)){
                      $_messages[] = [
                          "field" => $field,
                          "type" => $type
                      ];
                  }

                  break;

          }
      }

      return $_messages;

    }

    public static function email(string $email){


        if (!strpos($email,"@") OR !strpos($email,".")){
            return false;
        }


        $sEmail = explode("@",$email);

        if(count($sEmail) != 2){
            return false;
        }

        if ((strlen($sEmail[0]) < 1) OR !ctype_alnum($sEmail[0]) ){
            return false;
        }

        $sEmailDomain = explode(".",$sEmail[1]);

        if(count($sEmailDomain) != 2){
            return false;
        }

        if ((strlen($sEmailDomain[0]) < 3) OR !ctype_alnum($sEmailDomain[0])){
            return false;
        }

        if ((strlen($sEmailDomain[1]) < 2) OR !ctype_alnum($sEmailDomain[1])){
            return false;
        }

        return true;


    }


    public static function password(string $password){

        $passDigit = strlen($password);

        if ($passDigit < 6 ){
            return false;
        }else{
            return true;
        }

    }

    public static function passCompare(string $password,string $passwordR){

        if ($password == $passwordR){
            return true;
        }else{
            return false;
        }

    }


}