<?php

class Validator{

    function __construct(){
        throw new Exception("Validator class can't be instantiated!");
    }

    
    public static function isValidPassword($password){
        $regex = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[\W_])[^\s]{10,}$/';
        if(preg_match($regex,$password)){
            return true;
        }
        return false;
    }

    public static function isValidEmail($email){
        $regex = '/^(?=.{1,99}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if(preg_match($regex,$email)){
            return true;
        }
        return false;
    }

    public static function isValidMoblieNo($mobile){
        $regex = '/^[0-9]{10}$/';
        if(preg_match($regex,$mobile)){
            return true;
        }
        return false;
    }

    public static function isValidUserName($username){
        $regex = '/^[a-zA-z\s]{1,60}$/';
        if(preg_match($regex,$username)){
            return true;
        }
        return false;
    }

    public static function isAllValid($username,$email,$password,$mobile){
        $is_valid_username = Validator::isValidUserName($username);
        $is_valid_email = Validator::isValidEmail($email);
        $is_valid_password = Validator::isValidPassword($password);
        $is_valid_mobile = Validator::isValidMoblieNo($mobile);
 
        if(!$is_valid_username){
         echo "username is not valid<br>";
        }
        if(!$is_valid_email){
         echo "email is not valid<br>";
        }
        if(!$is_valid_password){
         echo "password is not valid<br>";
        }
        if(!$is_valid_mobile){
         echo "mobile number is not valid<br>";
        }
 
        if($is_valid_username && $is_valid_email && $is_valid_password && $is_valid_mobile){
         return true;
        }
        return false;
    }
   
}




