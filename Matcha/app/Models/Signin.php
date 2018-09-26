<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 11:44 AM
 */

namespace App\Models;
use \App\Controllers\Controller;
use \App\Database\DatabaseRequest;


/**
 * Class Login
 * @package App\Models
 */
class Signin extends Controller
{
//    private $Login;
    private $data;
    private $password;

    /**
     * @param $Login
     * @param $Password
     * @param $db
     * @return bool
     */
    protected final function setUserOnline($Login, $Password, $db){

        $database = new DatabaseRequest($db);
        $database->UseDB("db_matcha");
        $Login = htmlspecialchars(addslashes($Login));
        $this->password = $database->findData_ASSOC('users', "Password", "Login='{$Login}'");
        if (hash("whirlpool", $Password) == $this->password[0]['Password'])
        {
            unset($this->password);
            $this->data = $this->getToken($Login, $database);
            return $this->data;
        } else {
            return false;
        }
    }

//    /**
//     * @param $request
//     * @param $response
//     * @return mixed
//     */
//    public function setUserLogout($request, $response){
//        unset($_SESSION['User']);
//        return $response->withRedirect('/signin');
//    }

    /*
     * Private methods
     */

//    /**
//     * @param $Login
//     */
//    private function setLogin($Login){
//        $this->Login = $Login;
//    }

    /**
     * @param $Login
     * @param $database
     */
    private final function getToken($Login,DatabaseRequest $database){
        $Login = htmlspecialchars(addslashes($Login));
        $data = $database->findData_ASSOC('users', "token, FullRegister", "Login='{$Login}'");
        return $data[0];
    }
}