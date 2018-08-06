<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 11:43 AM
 */

require __DIR__.'/../vendor/autoload.php';
use \App\Controllers\UserController;

session_start();

$app = new \Slim\App([
        'settings' => [
            'displayErrorDetails' => true,
        ]
    ]
);

$container = $app->getContainer();

$container['db'] = function ()
{
    $DB_DSN = "mysql:3306";
    $DB_USER = "web";
    $DB_PASSWORD = "1234";
    $obj = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    return $obj;
};

//$container['user'] = function () {
//    $user = new UserController();
//  return $user;
//};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/View/', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};

include "databaseInstall.php";


require __DIR__."/../routs/web.php";
