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


/**
 * Class SigninController
 * @package App\Controllers
 */
class SigninController extends Controller
{
    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($request, $response, $args)
    {
        return $this->view->render($response, 'signin/signin.twig');
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function loginUser($request, $response, $args)
    {
        $param = $request->getParams();
        $_SESSION['User'] = new UserController();
        $_SESSION['User']->setUserOnline($param['Login'], $param['Password'], $this->db);
//var_dump($_SESSION['User']);
        return $response->withRedirect($this->router->pathFor('topics'));
    }
}