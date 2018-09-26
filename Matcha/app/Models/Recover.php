<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 9/20/18
 * Time: 8:10 PM
 */

namespace App\Models;


use App\Controllers\Controller;
use App\Database\DatabaseRequest;

/**
 * Class Recover
 * @package App\Models
 */
class Recover extends Controller
{
    /**
     * @param $token
     * @return mixed
     */
    protected final function getUser($token){
        $database = new DatabaseRequest($this->db);
        $user = $database->findData_ASSOC("users", "Email, Login", "token={$token}");
        return $user[0];
    }

    /**
     * @param $to_find
     * @param $user_data
     * @return bool
     */
    protected final function isUserExist($to_find, $user_data){
        if($to_find == $user_data['Login'] || $to_find == $user_data['Email'])
        {
            return (true);
        }
        return (false);
    }

    /**
     * @param $email
     * @return bool
     */
    protected final function sendRecMail($email){
        return (true);
    }
}