<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 1:01 PM
 */
namespace App\Controllers;
use App\Database\DatabaseRequest;
use PDO;
use \App\Models\Topic;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class TopicController
 * @package App\Controllers
 */
class TopicController extends Topic
{

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getTopics(Request $request,Response $response)
    {
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($this->getAllTopics()));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function addTopic(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        $user = "Aika";
        $title = htmlspecialchars(addslashes($params['Title']));
        $description = htmlspecialchars(addslashes($params['Description']));
        $this->addForumTopic($user, $title, $description);
        return $response->withRedirect($this->router->pathFor('topics'));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function addComment(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        $database = new DatabaseRequest($this->db);
        $user = $_SESSION['User']->getData();
        $comment = htmlspecialchars(addslashes($params['comment']));
        $id = htmlspecialchars(addslashes($args['id']));
        $database->addTableData('topiccomments', 'UserID, TopicID, Comment', "'{$user['UserID']}', '{$id}', '{$comment}'");
        return $response->withRedirect("/topics/{$args['id']}");
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function show(Request $request, Response $response, $args)
    {
        $TopicID = htmlspecialchars(addslashes($args['id']));
        $topicResponse = $this->displayTopicData($TopicID);
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($topicResponse));
    }
}