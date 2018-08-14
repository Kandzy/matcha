<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 3:11 PM
 */

namespace App\Models;


/**
 * Class Signup
 * @package App\Models
 */
class Signup
{
    /**
     * @param $Email
     * @return string
     */
    public function emailExist($Email)
    {
        return "User with email \"{$Email}\" already exist";
    }

    /**
     * @param $Login
     * @return string
     */
    public function loginExist($Login)
    {
        return "User with login \"{$Login}\" already exist";
    }

    /**
     * @return string
     */
    public function passwordDoNotMatch()
    {
        return "Password do not match, please try again!";
    }
}