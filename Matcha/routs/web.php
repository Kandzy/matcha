<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 11:46 AM
 */

use \App\Models\User;
use \App\Controllers\TopicController;
use \App\Controllers\UserController;
use \App\Controllers\SigninController;
use \App\Controllers\SignupController;

$app->group('/signin', function (){
    $this->get('', SigninController::class.":index")->setName('signin');
    $this->post('', SigninController::class.":loginUser");
});


$app->group('/signup', function () {
    $this->get('', SignupController::class . ":index")->setName('signup');
    $this->post('', SignupController::class.":registration");
});

$app->group('/recover', function () {
    $this->get('/password', function ()
    {
       echo "Recover Password";
    });
});


$app->group('/users', function (){
    $this->get('', function ($request, $response, $args){
       $UID = $request->getParam("id");
       echo $UID."</br>";
       echo "All users";
    });
    $this->get('/find', function ($request, $response, $args){
        echo "Lets find user!";
    });
    $this->get('/{username}', function ($request, $response, $args){
        echo $args['username'];
    })->setName('user.profile');
    $this->get('/{username}/update', function ()
    {
       echo "UPDATE";
    });
});

$app->get('/', function (){
    echo "Main Page";
});


$app->group('/topics', function ()
{
    $this->get('', TopicController::class . ':index')->setName('topics');
    $this->get('/{id}', TopicController::class . ':show')->setName('topics.show');
});

$app->get('/redirect', UserController::class.":redirect")->setName('top.st');

//$app->get('/', function (){
//    $user = new User;
//});
//
//$app->get('/users', UserController::class.":index")->setName('users');
//
//$app->get('/users/{username}[/{email}]', function ($request, $response, $args)
//{
//    $user = $this->db->prepare("SELECT * FROM users WHERE Username = :username") ;
//    $user->execute([
//        'username' => $args['username']
//    ]);
//    if (isset($args['email'])) {
//        echo $args['email']."</br>";
//    }
//    $param = $request->getParam('pid');
//    echo $param;
//    echo '</br>';
//    var_dump($user->fetchAll(PDO::FETCH_ASSOC));
//});

//$app->get('/contact', function ($request, $response){
//    return $this->view->render($response, 'contact.twig');
//})->setName('contact');
//
//$app->get('/contact/confirm', function ($request, $response){
//    return $this->view->render($response, 'contact_confirm.twig');
//})->setName('contact.confirmed');
////
//$app->post('/contact', function($request, $response){
//    $params = $request->getParams();
//    return $response->withRedirect('contact/confirm');
//})->setName('contact');

//$app->get('/user[/{user}]', function ($request, $response, $args) {
//    // getUser($args.user);
//    if (!isset($args['user']))
//    {
//        echo "No args";
//    }
//    else {
//        echo $args['user'];
//    }
//
//    $user = [
//        'user1' => ['username' => 'ololo'],
//        'id' => 'fhfghfgh'
//    ];
//
//    return $this->view->render($response, 'user.twig', compact('user'));
////    print_r($args);
//})->setName('user.name');



//$app->group('/topics', function (){
//    $this->get('', function (){
//        echo "topic list";
//    });
//
//    $this->get('/{id}', function ($request, $response, $args){
//        echo "Topic id:".$args['id'];
//    });
//
//    $this->post('', function (){
//        echo "post topic list";
//    });
//});
//
//$app->get('/', function (){
////    $this->db->exec("USE matcha");
//    $prep = $this->db->prepare("SELECT * FROM users");
//    $prep->execute();
//    $users = $prep->fetchAll(PDO::FETCH_ASSOC);
////    for
//    $var = 0;
//    foreach ($users as $user)
//    {
//        $var++;
//        echo $var.") Username: ".$user['Username']." Email: ".$user['Email']. " Name: ".$user['Name']."</br>";
//    }
//
//});

//$app->get('/', function ($request, $response){
//    echo "fuck!";
//   echo $this->user->getUserLogin();
//})->setName("main");