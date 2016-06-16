<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-05-21
 * Time: 9:47 AM
 */
class Security
{

    function __construct()
    {
        $this->start_session();
    }

    private function start_session(){
        session_start();
    }

    public function set_session_variables($username,$role,$name,$officer_id){
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;
        $_SESSION["name"] = $name;
        $_SESSION["officer_id"] = $officer_id;
    }

    public function stop_session(){
        session_unset();
        session_destroy();
    }

    public function get_user_role(){
        return $_SESSION["role"];
    }

    public function get_user_username(){
        return $_SESSION["username"];
    }

    public function is_session(){
        if(isset($_SESSION)){
            if(isset($_SESSION["username"]) and isset($_SESSION["role"])){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}