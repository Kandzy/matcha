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
use \App\Middleware\RedirectIfUnauthenticated;
use \App\Middleware\RedirectIfAunthenticated;
use \App\Controllers\DisplayUsersInformationController;
use \App\Middleware\FirstTimeConnectedUser;
use App\Controllers\DisplayProfileInformationController;
use App\Controllers\RecoverController;
use App\Controllers\UserListController;
use \Slim\Http\Response;
use \Slim\Http\Request;

$app->group('/signin', function (){
    $this->post('', SigninController::class.":loginUser");
    $this->post('/password/recover', RecoverController::class.":recover");
});


$app->group('/signup', function () {
    $this->post('', SignupController::class.":registration");
});

$app->group('/profile', function ()
{
    $this->post("/create", DisplayProfileInformationController::class.":finishUserRegister");
});

$app->get('/chat', function(Request $request,Response $response, $args){
    if($_SESSION['User']) {
        $data = [
            'Login' => $_SESSION['User']->getUserLogin()
        ];
    }
    return $this->view->render($response, 'chat/chat.twig', compact('data'));
});

$app->group('/users', function (){
    $this->post('', DisplayUsersInformationController::class.":index")->setName('users');
    $this->post('/checkUReg', DisplayUsersInformationController::class.":CheckUserRegistration");
    $this->post('/all', UserListController::class.":getAllUsers");
    $this->post('/sorted', UserListController::class.":getSortedUsers");
    $this->post('/generate', UserController::class.":generate");
    $this->post('/{username}', DisplayUsersInformationController::class.":displayUserPage")->setName('profile');

});

$app->group('/forum', function ()
{
    $this->post('', TopicController::class . ':getTopics')->setName('topics');
    $this->post('/add', TopicController::class . ':addTopic')->setName('topics.add');
    $this->post('/{id}', TopicController::class . ':show')->setName('topics.show');
});

//$app->post('/test', function ($request, $response)
//{
//    $param = $request->getParams();
//    $data = [
//        'id' => '1',
//        'name' => 'login',
//        'onemore' => $param
//    ];
//    return $response->withStatus(200)
//        ->withHeader('Content-Type', 'application/json')
//        ->write(json_encode($data));
//});

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