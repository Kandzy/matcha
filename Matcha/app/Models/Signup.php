<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 3:11 PM
 */

namespace App\Models;
use \App\Controllers\Controller;


/**
 * Class Signup
 * @package App\Models
 */
class Signup extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param $params
     * @param $database
     * @return int
     */
    protected function checkLogin($request , $response, $params, $database){
        $Login = htmlspecialchars(addslashes($params['Login']));
        $data = $database->findData_CLASS("users", "Login","Login='{$Login}'", Signup::class);
        if(!empty($data)) {
            return (true);
        }
        return (false);
    }

    /**
     * @param $request
     * @param $response
     * @param $params
     * @param $database
     * @return int
     */
    protected function checkEmail($request , $response, $params, $database){
        $Email = htmlspecialchars(addslashes($params['Email']));
        $data = $database->findData_CLASS("users", "Email","Email='{$Email}'", Signup::class);
        if(!empty($data)) {
            return (true);
        }
        return (false);
    }

    /**
     * @param $response
     * @param $params
     * @param $database
     * @return mixed
     */
    protected function addNewUser($response , $params, $database)
    {
        $password = hash('whirlpool',$params['Password']);
        $Login = htmlspecialchars(addslashes($params['Login']));
        $Email = htmlspecialchars(addslashes($params['Email']));
        if ($database->addTableData("users", "Login, Password, Email", "'{$Login}', '{$password}', '{$Email}'")){
            return (true);
        }
        else {
            return (false);
        }
    }

    /**
     * @param $Email
     * @return int
     */
    protected function validateEmail($Email){
        if(preg_match('#(.+?)\@([a-z0-9-_]+)\.(aero|arpa|asia|biz|cat|ua|tv|ru|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])#i', $Email)) {
            return (true);
        } else {
            return (false);
        }
    }

    /**
     * @param $Password
     * @return int
     */
    protected function validatePassword($Password){
        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$#', $Password)) {
            return (true);
        } else {
            return (false);
        }
    }
}