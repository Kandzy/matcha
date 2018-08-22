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
class SignupController extends Controller
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

    /**
     * @param $request
     * @param $response
     * @param $params
     * @param $database
     * @return int
     */
    private function checkLogin($request , $response, $params, $database){
        $Login = htmlspecialchars(addslashes($params['Login']));
        $data = $database->findData_CLASS("users", "Login","Login='{$Login}'", Signup::class);
        if(!empty($data)) {
            return (true);
        }
        return (false);
    }

    /**
     * @param $request
     * @param $response
     * @param $params
     * @param $database
     * @return int
     */
    private function checkEmail($request , $response, $params, $database){
        $Email = htmlspecialchars(addslashes($params['Email']));
        $data = $database->findData_CLASS("users", "Email","Email='{$Email}'", Signup::class);
        if(!empty($data)) {
            return (true);
        }
        return (false);
    }

    /**
     * @param $response
     * @param $params
     * @param $database
     * @return mixed
     */
    private function addNewUser($response , $params, $database)
    {
        $password = hash('whirlpool',$params['Password']);
        $Login = htmlspecialchars(addslashes($params['Login']));
        $Email = htmlspecialchars(addslashes($params['Email']));
        if ($database->addTableData("users", "Login, Password, Email", "'{$Login}', '{$password}', '{$Email}'")){
            return (true);
        }
        else {
            return (false);
        }
    }

    /**
     * @param $Email
     * @return int
     */
    private function validateEmail($Email){
        if(preg_match('#(.+?)\@([a-z0-9-_]+)\.(aero|arpa|asia|biz|cat|ua|tv|ru|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])#i', $Email)) {
            return (true);
        } else {
            return (false);
        }
    }

    /**
     * @param $Password
     * @return int
     */
    private function validatePassword($Password){
        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)
        [a-zA-Z\d]{6,}$#', $Password)) {
            return (true);
        } else {
            return (false);
        }

    }
}