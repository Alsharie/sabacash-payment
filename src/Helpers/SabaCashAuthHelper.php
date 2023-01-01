<?php

namespace Alsharie\SabaCashPayment\Helpers;


class SabaCashAuthHelper
{


    private static $auth_session_name = 'SABACASH_LOGIN_ACCESS_TOKEN';

    public static function setAuthToken($token)
    {
        $_SESSION[self::$auth_session_name] = $token;
    }

    public static function getAuthToken()
    {
        if (isset($_SESSION[self::$auth_session_name]))
            return $_SESSION[self::$auth_session_name];
        return null;
    }


}