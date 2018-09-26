<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 3:11 PM
 */

namespace App\Models;
use \App\Controllers\Controller;
use App\Database\DatabaseRequest;
use Slim\Http\Request;
use Slim\Http\Response;


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
    protected final function checkLogin(Request $request ,Response $response, $params, DatabaseRequest $database){
        $Login = htmlspecialchars(addslashes($params['Login']));
        $data = $database->findData_ASSOC("users", "Login","Login='{$Login}'");
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
    protected final function checkEmail($request , $response, $params,DatabaseRequest $database){
        $Email = htmlspecialchars(addslashes($params['Email']));
        $data = $database->findData_ASSOC("users", "Email","Email='{$Email}'");
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
    protected final function addNewUser($response , $params,DatabaseRequest $database)
    {
        $password = hash('whirlpool',$params['Password']);
        $Login = htmlspecialchars(addslashes($params['Login']));
        $Email = htmlspecialchars(addslashes($params['Email']));
        $token = hash('whirlpool', "{$Login}{$password}{$Email}");
        return $database->addTableData("users", "Login, Password, Email, token", "'{$Login}', '{$password}', '{$Email}', '{$token}'");
    }

    /**
     * @param $Email
     * @return int
     */
    protected final function validateEmail($Email){
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
    protected final function validatePassword($Password){
        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$#', $Password)) {
            return (true);
        } else {
            return (false);
        }
    }
}