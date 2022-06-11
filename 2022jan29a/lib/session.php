<?php
class onsession{
    public static function init(){
        if(version_compare(phpversion(), '5.4.0', '<')){
             if(session_id() == ''){
                 session_start();
             }
        }else{
             if(session_status() == PHP_SESSION_NONE){
                 session_start();
             }
        }
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    public static function userSession(){
        if(self::get("login") == false){
           self::destroy();
           return header("location: login.php");
        }
    }

    public static function userLogin(){
        if(self::get("login") == true){
            return header("location: profile.php");
        }
    }

    public static function destroy(){
        unset($_SESSION["login"]);
        session_destroy();
        return header("location: index.php");
    }


}