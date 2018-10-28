<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 9/20/18
 * Time: 8:07 PM
 */

namespace App\Controllers;

use App\Models\Recover;
use Slim\Http\Request;
use Slim\Http\Response;

class RecoverController extends Recover
{
    public function recover(Request $request, Response $response, $args){
        $res = [
            "userExist" => false,
            "mailSend" => false,
        ];
        $token = htmlspecialchars(addslashes($request->getParam('Token')));
        $to_find = htmlspecialchars(addslashes($request->getParam('find')));
        $user_data = $this->getUser($token);
        if (($res['userExist'] = $this->isUserExist($to_find, $user_data)))
        {
            $res['mailSend'] = $this->sendRecMail($user_data['Email']);
        }
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($res));
    }
}