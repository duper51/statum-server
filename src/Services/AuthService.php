<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/8/2017
 * Time: 3:30 AM
 */

namespace Me\Services;


use Me\Exceptions\NotAuthedException;
use Illuminate\Database\Capsule\Manager as Capsule;

class AuthService
{
    public static function is_authed($level = 0) {
        if(isset($_SESSION['login']))
            return true;

        if(isset($_COOKIE['login_token']) && isset($_COOKIE['username'])) {
            $collection = Capsule::table("loginTokens")->where("token", $_COOKIE['login_token'])
                ->where("user", $_COOKIE['username'])->get(1);
            if($collection->count() > 0) {
                setcookie("login_token", null, 0);
                setcookie("username", null, 0);
                return false;
            }
            return true;
        }
        return false;
    }

    public static function authenticate($callback, $args = null, $level = 0) {
        if(static::is_authed($level)) {
            return call_user_func_array($callback, $args);
        } else {
            throw new NotAuthedException("User not authenticated.");
        }
    }
}