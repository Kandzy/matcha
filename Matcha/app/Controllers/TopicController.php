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

/**
 * Class TopicController
 * @package App\Controllers
 */
class TopicController extends Controller
{

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getTopics($request, $response)
    {
        $database = new DatabaseRequest($this->db);
        $data = $database->findData_ASSOC('topics', "*", "1=1 ORDER BY TopicCreationDate DESC");
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($data));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function addTopic($request, $response, $args)
    {
        $params = $request->getParams();
        $database = new DatabaseRequest($this->db);
        $user = $_SESSION['User']->getData();
        $title = htmlspecialchars(addslashes($params['Title']));
        $description = htmlspecialchars(addslashes($params['Description']));
        $database->addTableData('topics', "Owner, UserID, Title, Description", "'{$_SESSION['User']->getUserLogin()}', '{$user['UserID']}', '{$title}', '{$description}'");
        return $response->withRedirect($this->router->pathFor('topics'));
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function addComment($request, $response, $args)
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
    public function show($request, $response, $args)
    {
//        $topic = $this->db->prepare("SELECT * FROM topics WHERE TopicID = :ID");
//        $topic->execute([
//            'ID' => $args['id']
//        ]);
//        $topic = $topic->fetch(PDO::FETCH_OBJ);
        $TopicID = htmlspecialchars(addslashes($args['id']));
        $database = new DatabaseRequest($this->db);
        $topicData = $database->findData_ASSOC("topics","topics.TopicID, topics.Title, topics.Owner, topics.Description, topics.TopicCreationDate", "topics.TopicID='{$TopicID}'");
        $data = $database->findData_CLASS('topiccomments 
        LEFT JOIN users ON topiccomments.UserID = users.UserID 
        LEFT JOIN topics ON topiccomments.TopicID = topics.TopicID',
            "topiccomments.TCommentID, topiccomments.TopicID, topiccomments.CreationDate, topiccomments.Comment, users.Login, topics.Title",
            "topiccomments.TopicID='{$TopicID}'", Topic::class);

        $i = 0;
        while($data[$i])
        {
            $data[$i]->Comment = htmlspecialchars_decode($data[$i]->Comment);
            $i++;
        }
        $topicData[0]['Title'] = htmlspecialchars_decode($topicData[0]['Title']);
        $topicData[0]['Description'] = htmlspecialchars_decode($topicData[0]['Description']);
        return $this->view->render($response, 'topics/show.twig', compact('data', 'topicData'));
    }
}