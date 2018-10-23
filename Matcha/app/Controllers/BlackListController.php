<?php/** * Created by PhpStorm. * User: dkliukin * Date: 10/22/18 * Time: 8:37 PM */namespace App\Controllers;use App\Models\BlackList;use Slim\Http\Request;use Slim\Http\Response;class BlackListController extends BlackList{    public final function addUser(Request $request, Response $response, $argc){        $token = $request->getParams();        return $response->withStatus(200)            ->withHeader('Content-Type', 'application/json')            ->write(json_encode($this->blockUser($token['target'], $token['source'])));    }    public final function removeUser(Request $request, Response $response, $argc){        $token = $request->getParams();        return $response->withStatus(200)            ->withHeader('Content-Type', 'application/json')            ->write(json_encode($this->unblockUser($token['target'], $token['source'])));    }    public final function reviewList(Request $request, Response $response, $argc){        return $response->withStatus(200)            ->withHeader('Content-Type', 'application/json')            ->write(json_encode($this->getBlockedUsers($request->getParams()['token'])));    }    public final function checkUser(Request $request, Response $response, $argc){        return $response->withStatus(200)            ->withHeader('Content-Type', 'application/json')            ->write(json_encode($this->checkIfBlocked($request->getParams()['token'])));    }}