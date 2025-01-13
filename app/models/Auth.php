<?php
namespace App\Models;

use App\Crud\crud;

class Auth extends crud
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function login($email,$password)
    {
        return parent::login();
    }

    public static function isAuth()
    {
        return parent::isAuth();
    }

    public static function setMessage($message)
    {
        return parent::setMessage($message);
    }

    public static function getMessage()
    {
        return parent::getMessage();
    }

    public static function hasMessage()
    {
        return parent::hasMessage();
    }

    public static function logout()
    {
        return parent::logout();
    }

    public static function getRole()
    {
        return parent::getRole();
    }
}
?>