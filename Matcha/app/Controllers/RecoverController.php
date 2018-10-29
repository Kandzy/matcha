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
        $to_find = htmlspecialchars(addslashes($request->getParam('find')));
        if (($res['userExist'] = $this->isUserExist($to_find)))
        {
            $res['mailSend'] = $this->sendRecMail($to_find);
        }
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($res));
    }
}