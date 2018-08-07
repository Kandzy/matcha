<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 11:43 AM
 */

namespace App\Controllers;

use PDO;
use App\Controllers\UserController;


class SigninController extends Controller
{
    public function index($request, $response, $args)
    {
        return $this->view->render($response, 'signin/signin.twig');
    }

    public function loginUser($request, $response, $args)
    {
        $param = $request->getParams();
        $_SESSION['User'] = new UserController();
        $_SESSION['User']->setUserOnline($param['Login'], $param['Password'], $this->db);
//var_dump($_SESSION['User']);
        return $response->withRedirect($this->router->pathFor('topics'));
    }
}