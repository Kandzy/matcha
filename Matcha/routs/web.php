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
use \App\Controllers\NotificationController;
use  \App\Controllers\BlackListController;
use App\Controllers\LikesController;
use App\Controllers\ChatController;
use App\Controllers\PopularityController;
use App\Controllers\ReportController;
use App\Controllers\HistoryController;

$app->group('/signin', function (){
    $this->post('', SigninController::class.":loginUser");
    $this->post('/password/recover', RecoverController::class.":recover");
    $this->post('/user/logged', SigninController::class.":isLogged");
});


$app->group('/signup', function () {
    $this->post('', SignupController::class.":registration");
});

$app->group('/profile', function ()
{
    $this->post("/create", DisplayProfileInformationController::class.":finishUserRegister");
});

$app->group('/chat', function(){
    $this->post('/rooms/create', ChatController::class.":createRoom");
    $this->post('/rooms/get', ChatController::class.":getRoom");
    $this->post('/message/send', ChatController::class.":sendMessage");
    $this->post('/message/get', ChatController::class.":getMessage");
    $this->post('/message/history', ChatController::class.":messageHistory");
});

$app->group('/users', function (){
    $this->post('/checkUReg', DisplayUsersInformationController::class.":CheckUserRegistration");
    $this->post('/all', UserListController::class.":getAllUsers");
    $this->post('/sorted', UserListController::class.":getSortedUsers");
    $this->post('/generate', UserController::class.":generate");
    $this->post('/update/{token}', UserController::class.":updateUser");
    $this->post('/{token}', UserListController::class.":getCurrentUser");
});

$app->group('/forum', function ()
{
    $this->post('', TopicController::class . ':getTopics')->setName('topics');
    $this->post('/add', TopicController::class . ':addTopic')->setName('topics.add');
    $this->post('/{id}', TopicController::class . ':show')->setName('topics.show');
});

$app->group('/notification', function (){
    $this->post('/check', NotificationController::class.":updateNotification");
    $this->post('/add', NotificationController::class.":addNewNotification");
    $this->post('/online', NotificationController::class.":checkStatus");
});

$app->group('/blacklist', function (){
    $this->post('/add', BlackListController::class.":addUser");
    $this->post('/remove', BlackListController::class.":removeUser");
    $this->post('/review', BlackListController::class.":reviewList");
    $this->post('/is_blocked', BlackListController::class.":checkUser");
});

$app->group('/like', function ()
{
    $this->post('/add', LikesController::class.":addLike");
    $this->post('/remove', LikesController::class.":removeLike");
    $this->post('/check', LikesController::class.":checkLikes");
    $this->post('/is_liked', LikesController::class.":isLiked");
});

$app->group('/popularity', function (){
    $this->post('/add', PopularityController::class.":addPopularity");
});

$app->group('/report', function (){
    $this->post('/fake', ReportController::class.":rFake");
});


$app->group('/history', function (){
    $this->post('/ofVisits', HistoryController::class.":hByUser");
    $this->post('/addVisits', HistoryController::class.":addVisit");
});

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
