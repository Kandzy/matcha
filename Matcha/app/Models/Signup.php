<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 3:11 PM
 */

namespace App\Models;


class Signup
{
    public function emailExist($Email)
    {
        return "User with email \"{$Email}\" already exist";
    }

    public function loginExist($Login)
    {
        return "User with login \"{$Login}\" already exist";
    }

    public function passwordDoNotMatch()
    {
        return "Password do not match, please try again!";
    }
}