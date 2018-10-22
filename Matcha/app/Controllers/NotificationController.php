<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 10/22/18
 * Time: 7:51 PM
 */

namespace App\Controllers;


use App\Models\Notification;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class NotificationController
 * @package App\Controllers
 */
class NotificationController extends Notification
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return
     */
    public final function updateNotification(Request $request, Response $response, $args)
    {
        return $response->withHeader('Content-Type', "application/json")
            ->withStatus(200)
            ->write(json_encode($this->checkNotification($request->getParams())));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return
     */
    public final function addNewNotification(Request $request, Response $response, $args)
    {
        $data = $request->getParams();
        return $response->withHeader('Content-Type', "application/json")
            ->withStatus(200)
            ->write(json_encode($this->addNotification($data['sourceToken'], $data['targetToken'], $data['Type'])));
    }
}