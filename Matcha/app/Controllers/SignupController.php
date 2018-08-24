<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/4/18
 * Time: 12:28 PM
 */

namespace App\Controllers;
use \App\Database\DatabaseRequest;
use \App\Models\Signup;
use PDO;

/**
 * Class SignupController
 * @package App\Controllers
 */
class SignupController extends Signup
{
    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($request, $response, $args){
        return $this->view->render($response, 'signup/signup.twig');
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function registration($request, $response, $args){
        $params = $request->getParams();
        $database = new DatabaseRequest($this->db);
        $database->UseDB("db_matcha");
        $data = [
            'ValidEmail' => false,
            'ValidPassword' => false,
            'PasswordMatch' => false,
            'Email' => $params['Email'],
            'Login' => $params['Login'],
            'EmailExist' => false,
            'LoginExist' => false,
            'UserCreated' =>false,
            'request' => $params
        ];
        $data['LoginExist'] = $this->checkLogin($request, $response, $params, $database);
        $data['ValidEmail'] = $this->validateEmail($params['Email']);
        if ($data['ValidEmail'])
        {
            $data['EmailExist'] = $this->checkEmail($request, $response, $params, $database);
        }
        if ($params['Password'] == $params["ConfirmedPassword"]) {
            $data['PasswordMatch'] = true;
            $data['ValidPassword'] = $this->validatePassword($params['Password']);
            if ($data['ValidPassword']) {
                if (!$data['LoginExist'] && !$data['EmailExist'] && $data['ValidEmail']) {
                    $this->addNewUser($response, $params, $database);
                    $data['UserCreated'] = true;
                }
            }
        } else {
            $data['PasswordMatch'] = false;
        }
//        $data['UserCreated'] = "lol";
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }
}