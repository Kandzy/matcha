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


class DisplayUsersInformationController extends Controller
{
    public function index($request, $response, $args){
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $data = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age", "1=1", DisplayUsersInformation::class);
//        print_r($data);
//        print_r($data[0]);
        return $this->view->render($response, 'users/allUsers.twig', compact('data'));
    }

    public function findUserPage($request, $response, $args)
    {
        return $this->view->render($response, 'users/findUser.twig');
    }

    public function findUser($request, $response, $args){
        $param = $request->getParam('Login');
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $users = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age", "Login LIKE '%{$param}%'", DisplayUsersInformation::class);
        return $this->view->render($response, 'users/findUserResult.twig', compact('users'));
//        return $response->withRedirect($this->router->pathFor('users')."/{$param}");
    }

    public function displayUserPage($request, $response, $args){
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $data = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age", "Login='{$args['username']}'", DisplayUsersInformation::class);
        return $this->view->render($response, 'users/userPage.twig', compact('data'));
    }
}