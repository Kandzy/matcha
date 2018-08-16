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
        $data = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender, Orientation, map_height, map_width, Bio, Tags, Avatar", "1=1", DisplayUsersInformation::class);
        $i = 0;
        while ($data[$i])
        {
            $this->checkData($data[$i]);
            $i++;
        }
        return $this->view->render($response, 'users/allUsers.twig', compact('data'));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function findUserPage($request, $response, $args){
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
        $param2 = $request->getParam('find_by');
        switch ($param2) {
            case "By Login":
                $tofind = "Login";
                break;
            case "By Name":
                $tofind = "FirstName";
                break;
            case "By Tag":
                $tofind = "Tags";
                break;
            case "By Orientation":
                $tofind = "Orientation";
                break;
            default:
                $tofind = "Login";
        }
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $users = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender, Orientation, map_height, map_width, Bio, Tags, Avatar", "{$tofind} LIKE '%{$param}%'", DisplayUsersInformation::class);
        $i = 0;
        while ($users[$i]) {
            $this->checkData($users[$i]);
            $i++;
        }
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
        $data = $database->findData_CLASS("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender,Orientation, map_height, map_width, Bio, Tags, Avatar", "Login='{$Login}'", DisplayUsersInformation::class);
        $this->checkData($data[0]);
        return $this->view->render($response, 'users/userPage.twig', compact('data'));
    }

    /**
     * @param $data->obj
     * return updated object
     */
    private function checkData($data){
        if ($data->FirstName == null) {
            $data->FirstName = "No data";
        }
        if ($data->LastName == null) {
            $data->LastName = "No data";
        }
        if ($data->City == null) {
            $data->City = "No data";
        }
        if ($data->Country == null) {
            $data->Country = "No data";
        }
        if ($data->Age == null) {
            $data->Age = "No data";
        }
        if ($data->Gender == null) {
            $data->Gender = "No data";
        }
        if ($data->Orientation == null) {
            $data->Orientation = "No data";
        }
        if ($data->Bio == null) {
            $data->Bio = "No data";
        }
        if ($data->Tags == null) {
            $data->Tags = "No data";
        }
        if ($data->Avatar == null) {
            if ($data->Gender == 'Female') {
                $data->Avatar = "/standartAvatar/female.jpg";
            }
            else{
                $data->Avatar = "/standartAvatar/male.jpg";
            }
        }
    }
}

/**
 * @param $string
 * @return mixed
 */
