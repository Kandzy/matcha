<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 24.10.2018
 * Time: 18:44
 */

namespace App\Controllers;


use App\Models\Likes;
use Slim\Http\Request;
use Slim\Http\Response;

class LikesController extends Likes
{
    public final function addLike(Request $request, Response $response, $argc){
        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($this->like($request->getParam('sourceToken'), $request->getParam('targetToken'))));
    }

    public final function removeLike(Request $request, Response $response, $argc){
        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($this->unlike($request->getParam('sourceToken'), $request->getParam('targetToken'))));
    }

    public final function checkLikes(Request $request, Response $response, $argc){
        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($this->reviewLikes($request->getParam('sourceToken'))));
    }

    public final function isLiked(Request $request, Response $response, $argc){
        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($this->checkIfLiked($request->getParam('sourceToken'), $request->getParam('targetToken'))));
    }
}