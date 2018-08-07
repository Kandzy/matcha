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

    public function setUserOnline($Login, $Password, $db){

        $database = new DatabaseRequest($db);
        $database->UseDB("db_matcha");
        $this->password = $database->findData_ASSOC('users', "Password", "Login='{$Login}'");
//        var_dump($this->password);

        if (hash("whirlpool", $Password) == $this->password[0]['Password'])
        {
            unset($this->password);
            $this->setLogin($Login);
            $this->UploadData($this->Login, $database);
        } else {
            unset($_SESSION['User']);
        }
        /**
         * HERE SHOULD BE ERROR!
         */
    }

    public function setUserLogout($request, $response){
//        unset($this->Login);
//        unset($this->data);
//        unset($this->password);
        unset($_SESSION['User']);
        return $response->withRedirect('/signin');
    }

    /*
     * Private methods
     */

    private function setLogin($Login){
        $this->Login = $Login;
    }

    private function UploadData($Login, $database){
//        $database->UseDB("db_matcha");
        $data = $database->findData_ASSOC('users', "*", "Login='{$Login}'");
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