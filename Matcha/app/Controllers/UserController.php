<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 1:24 PM
 */

namespace App\Controllers;
use PDO;
use App\Models\User;
use App\Database\DatabaseRequest;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController
{
    private $Login;
    private $data;
    private $password;

    /*
     * Public methods
     */

    /**
     * data from database about user
     * @return array
     */

    public function getData(){
        return $this->data;
    }

    /**
     * @return user login
     */

    public function getUserLogin(){
        return $this->Login;
    }

    public function updateUserInfo()
    {
        /**
         * UPDATE DATA
         */
    }

    /**
     * @param $Login
     * @param $Password
     * @param $db
     */
    public function setUserOnline($Login, $Password, $db){

        $database = new DatabaseRequest($db);
        $database->UseDB("db_matcha");
        $Login = htmlspecialchars(addslashes($Login));
        $this->password = $database->findData_ASSOC('users', "Password", "Login='{$Login}'");
        if (hash("whirlpool", $Password) == $this->password[0]['Password'])
        {
            unset($this->password);
            $this->setLogin($Login);
            $this->UploadData($this->Login, $database);
            return $this->data; ///new
        } else {
            unset($_SESSION['User']);
            return false; ///new
        }
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function setUserLogout($request, $response){
        unset($_SESSION['User']);
        return $response->withRedirect('/signin');
    }

    /*
     * Private methods
     */

    /**
     * @param $Login
     */
    private function setLogin($Login){
        $this->Login = $Login;
    }

    /**
     * @param $Login
     * @param $database
     */
    private function UploadData($Login, $database){
        $Login = htmlspecialchars(addslashes($Login));
        $data = $database->findData_ASSOC('users', "token", "Login='{$Login}'");
        $this->data = $data[0];
    }









//    public function index($request, $response)
//    {
//        $users = $this->db->prepare("SELECT * FROM users");
//        $users->execute();
//        $users = $users->fetchAll(PDO::FETCH_CLASS, User::class);
//        return $this->view->render($response, 'users/user.twig', compact('users'));
//    }
//
//    public function redirect($request, $response)
//    {
//        return $response->withRedirect($this->c->router->pathFor('topics.show', ['id'=> 2]));
//    }
}