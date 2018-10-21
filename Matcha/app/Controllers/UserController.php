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
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends User
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function generate(Request $request, Response $response, $args)
    {
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($this->userGenerator($request->getParams())));
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