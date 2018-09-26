<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 11:43 AM
 */

namespace App\Controllers;

use App\Models\Signin;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * Class SigninController
 * @package App\Controllers
 */
class SigninController extends Signin
{
//    /**
//     * @param $request
//     * @param $response
//     * @param $args
//     * @return mixed
//     */
//    public function index($request, $response, $args)
//    {
//        return $this->view->render($response, 'signin/signin.twig');
//    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function loginUser(Request $request,Response $response, $args)
    {
        $param = $request->getParams();
        $userData = $this->setUserOnline($param['Login'], $param['Password'], $this->db);
        if ($userData)
        {
            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($userData));
        }
        return $response->withStatus(200 )
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(null));
    }
}