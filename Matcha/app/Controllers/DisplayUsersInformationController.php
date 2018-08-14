<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/7/18
 * Time: 11:43 AM
 */

namespace App\Controllers;
use \App\Database\DatabaseRequest;
use \App\Models\DisplayUsersInformation;


/**
 * Class DisplayUsersInformationController
 * @package App\Controllers
 */
class DisplayUsersInformationController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($request, $response, $args){
//        return 1;
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $data = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender, map_height, map_width, Bio, Tags", "1=1", DisplayUsersInformation::class);
        return $this->view->render($response, 'users/allUsers.twig', compact('data'));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function findUserPage($request, $response, $args)
    {
        return $this->view->render($response, 'users/findUser.twig');
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function findUser($request, $response, $args){
        $param = htmlspecialchars(addslashes($request->getParam('Login')));
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $users = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender, map_height, map_width, Bio, Tags", "Login LIKE '%{$param}%'", DisplayUsersInformation::class);
        return $this->view->render($response, 'users/findUserResult.twig', compact('users'));
//        return $response->withRedirect($this->router->pathFor('users')."/{$param}");
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function displayUserPage($request, $response, $args){
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $Login = htmlspecialchars(addslashes($args['username']));
        $data = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender, map_height, map_width, Bio, Tags", "Login='{$Login}'", DisplayUsersInformation::class);
        return $this->view->render($response, 'users/userPage.twig', compact('data'));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function finishUserRegister($request, $response, $args){
        $user = ['login' => $_SESSION['User']->getUserLogin()];
        return $this->view->render($response, 'users/finishRegister.twig', compact('user'));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function registerUserSendData($request, $response, $args){
        $params = $request->getParams();
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $FirstName = htmlspecialchars(addslashes($params['FirstName']));
        $LastName = htmlspecialchars(addslashes($params['LastName']));
        $City = htmlspecialchars(addslashes($params['City']));
        $Country = htmlspecialchars(addslashes($params['Country']));
        $Age = htmlspecialchars(addslashes($params['Age']));
        $Bio = htmlspecialchars(addslashes($params['Bio']));
        $Tags = htmlspecialchars(addslashes($params['Tags']));
        $database->updateTableData('users',"FirstName='{$FirstName}', LastName='{$LastName}', City='{$City}', Country='{$Country}', Age='{$Age}', Gender='{$params['Gender']}', Bio='{$Bio}', Tags='{$Tags}', FullRegister='1'",
            "Login='{$_SESSION['User']->getUserLogin()}'");
        return $response->withRedirect($this->router->pathFor('users'));
    }
}

/**
 * @param $string
 * @return mixed
 */
