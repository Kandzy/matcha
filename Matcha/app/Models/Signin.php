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

    /*
     * Public methods
     */

//    /**
//     * data from database about user
//     * @return array
//     */

//    public function getData(){
//        return $this->data;
//    }
//    /**
//     * @return user login
//     */
//    public function getUserLogin(){
//        return $this->Login;
//    }

//    public function updateUserInfo()
//    {
//        /**
//         * UPDATE DATA
//         */
//    }

    /**
     * @param $Login
     * @param $Password
     * @param $db
     * @return bool
     */
    protected function setUserOnline($Login, $Password, $db){

        $database = new DatabaseRequest($db);
        $database->UseDB("db_matcha");
        $Login = htmlspecialchars(addslashes($Login));
        $this->password = $database->findData_ASSOC('users', "Password", "Login='{$Login}'");
        if (hash("whirlpool", $Password) == $this->password[0]['Password'])
        {
            unset($this->password);
            $this->getToken($this->Login, $database);
            return $this->data; ///new
        } else {
            unset($_SESSION['User']);
            return false; ///new
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
    private function getToken($Login, $database){
        $Login = htmlspecialchars(addslashes($Login));
        $data = $database->findData_ASSOC('users', "token", "Login='{$Login}'");
        $this->data = $data[0];
    }
}