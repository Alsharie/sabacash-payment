<?php

namespace Alsharie\SabaCashPayment\Helpers;


use Illuminate\Support\Facades\Session;

class SabaCashAuthHelper
{


    private static $auth_session_name = 'SABACASH_LOGIN_ACCESS_TOKEN';

    public static function setAuthToken($token)
    {

        Session::put(self::$auth_session_name, $token);

        Session::save();
    }

    public static function getAuthToken()
    {

        if (Session::exists(self::$auth_session_name))
            return Session::get(self::$auth_session_name);
        return null;
    }


}