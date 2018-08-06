<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 7/30/18
 * Time: 3:10 PM
 */

require 'vendor/autoload.php';

$app = new \Slim\App([
        'settings' => [
            'displayErrorDetails' => true,
        ]
    ]
);

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('View/', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $view;
};

$app->get('/', function($request, $response){
    return $this->view->render($response, 'signup.phtml');
})->setName('home');

$app->get('/loginController', function($request, $response){

    return $this->view->render($response, 'loginController.phtml');
})->setName('loginController.index');

$app->get('/contact', function ($request, $response){
  return $this->view->render($response, 'contact.twig');
})->setName('contact');

$app->post('/contact', function($request, $response){
    echo $request->getParam('email');
})->setName('contact');

$app->run();