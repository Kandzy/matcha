<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/16/18
 * Time: 12:21 PM
 */

namespace App\Controllers;
use App\Models\UserList;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * Class MainPageController
 * @package App\Controllers
 */
class UserListController extends UserList
{
    /**
     * @param $req
     * @param $res
     * @param $args
     * @return mixed
     */

    public function getAllUsers(Request $req,Response $res, $args){
        $data = [
            "users" =>false,
            "maxAge" => false,
            "maxPopular" => false,
            "message" =>false,
        ];
        $userToken = $req->getParam('token');
        $this->listOfUsers($data, $userToken);
        return $res->withStatus(200)->withHeader('Content-type', "application/json")
            ->write(json_encode($data));
    }

    /**
     * @param $req
     * @param $res
     * @param $args
     * @return mixed
     */
    public function getSortedUsers(Request $req, Response $res, $args){
        $sortParams = $req->getParams();
        $data = [
            "users" =>false,
            "message" =>false,
        ];
        $this->sortUsersBy($data, $sortParams);
        return $res->withStatus(200)->withHeader('Content-type', "application/json")
            ->write(json_encode($data));
    }
}