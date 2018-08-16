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
use \App\Controllers\MainPage;
use App\Controllers\DisplayProfileInformationController;

$app->group('/signin', function (){
    $this->get('', SigninController::class.":index")->setName('signin');
    $this->post('', SigninController::class.":loginUser");
    $this->get('/logout', UserController::class.":setUserLogout")->setName('signin.logout');
})->add(new RedirectIfAunthenticated);


$app->group('/signup', function () {
    $this->get('', SignupController::class . ":index")->setName('signup');
    $this->post('', SignupController::class.":registration");
})->add(new RedirectIfAunthenticated);

$app->group('/recover', function () {
    $this->get('/password', function ()
    {
       echo "Recover Password";
    });
});


$app->group('/users', function (){
    $this->get('', DisplayUsersInformationController::class.":index")->setName('users');
    $this->post('/find', DisplayUsersInformationController::class.":findUser")->setName('user.find.field');
    $this->get('/find', DisplayUsersInformationController::class.":findUserPage")->setName('user.find');
    $this->get('/{username}', DisplayUsersInformationController::class.":displayUserPage")->setName('profile');
})->add(new RedirectIfUnauthenticated)->add(new FirstTimeConnectedUser($container->db));

$app->group('/profile', function ()
{
    $this->get('', DisplayProfileInformationController::class.":redirProfile")->setName('take.profile');
    $this->get('/{username}', DisplayProfileInformationController::class.":displayProfilePage")->setName('current.profile');
    $this->get('/{username}/register', DisplayProfileInformationController::class.":finishUserRegister");
    $this->post('/{username}/register/sendData', DisplayProfileInformationController::class.":registerUserSendData")->setName('registerUserSendData');
    $this->post('/uploadPhoto', function ()
    {
        echo $_FILES['photoloader']['name'];
    });
    $this->get('/{username}/update', function ()
    {
        echo "UPDATE";
    })->setName('profile.update');
})->add(new RedirectIfUnauthenticated);

$app->get('/', MainPage::class.":index")->add(new FirstTimeConnectedUser($container->db));

$app->get('/chat', function($request, $response, $args){
    if($_SESSION['User']) {
        $data = [
            'Login' => $_SESSION['User']->getUserLogin()
    ];
    }
    return $this->view->render($response, 'chat/chat.twig', compact('data'));
})->add(new RedirectIfUnauthenticated())->add(new FirstTimeConnectedUser($container->db))->setName('chat');

$app->group('/topics', function ()
{
    $this->get('', TopicController::class . ':index')->setName('topics');
    $this->post('', TopicController::class . ':addTopic')->setName('topics.add');
    $this->get('/{id}', TopicController::class . ':show')->setName('topics.show');
    $this->post('/{id}', TopicController::class . ':addComment');
})->add(new RedirectIfUnauthenticated)->add(new FirstTimeConnectedUser($container->db));

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