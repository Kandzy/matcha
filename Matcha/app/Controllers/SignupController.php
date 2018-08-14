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

        if (!$this->checkLogin($request, $response, $params, $database)) {
            if(!$this->checkEmail($request, $response, $params, $database))
            {
                if (!$this->validateEmail($params['Email'])) {
                    return $this->view->render($response, 'signup/emailValidationError.twig');
                }
            }
            else {
                $data = [
                    'Login' => false,
                    'Email' => $params['Email'],
                    'class' => new Signup
                ];
                return $this->view->render($response, 'signup/UserExist.twig', compact('data'));
            }
        } else {
            $data = [
                'Login' => $params['Login'],
                'Email' => false,
                'class' => new Signup
                ];
            return $this->view->render($response, 'signup/UserExist.twig', compact('data'));
        }
        if ($params['Password'] === $params["ConfirmedPassword"]) {
            if ($this->validatePassword($params['Password'])) {
                return $this->addNewUser($response, $params, $database);
            }
            else
            {
                return $this->view->render($response, 'signup/passwordValidationError.twig');
            }
        } else {
            return $this->view->render($response, 'signup/passNotMatch.twig');
        }
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
            return 1;
        }
        return 0;
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
            return 1;
        }
        return 0;
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
        $database->addTableData("users", "Login, Password, Email", "'{$Login}', '{$password}', '{$Email}'");
        return $response->withRedirect($this->router->pathFor('signin'));
    }

    /**
     * @param $Email
     * @return int
     */
    private function validateEmail($Email){
        if(preg_match('#(.+?)\@([a-z0-9-_]+)\.(aero|arpa|asia|biz|cat|ua|tv|ru|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])#i', $Email)) {
            return (1);
        } else {
            return (0);
        }
    }

    /**
     * @param $Password
     * @return int
     */
    private function validatePassword($Password){
        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$#', $Password)) {
            return (1);
        } else {
            return (0);
        }

    }
}