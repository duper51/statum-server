<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/8/2017
 * Time: 3:30 AM
 */

namespace Me\Services;


use Me\Exceptions\NotAuthedException;

class AuthService
{
    public static function is_authed($level = 0) {
        return true; //TODO: Make this functionality actually do some validation.
    }

    public static function authenticate($callback, $args = null, $level = 0) {
        if(static::is_authed($level)) {
            return call_user_func_array($callback, $args);
        } else {
            throw new NotAuthedException("User not authenticated.");
        }
    }
}