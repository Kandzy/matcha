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