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

class TopicController extends Controller
{

    public function index($request, $response)
    {
        $database = new DatabaseRequest($this->db);
        $data = $database->findData_CLASS('topics', "*", "1=1 ORDER BY TopicCreationDate DESC", Topic::class);
        return $this->view->render($response, 'topics/index.twig', compact('data'));
    }

    public function addTopic($request, $response, $args)
    {
        $params = $request->getParams();
        $database = new DatabaseRequest($this->db);
        $user = $_SESSION['User']->getData();
        $database->addTableData('topics', "Owner, UserID, Title, Description", "'{$_SESSION['User']->getUserLogin()}', '{$user['UserID']}', '{$params['Title']}', '{$params['Description']}'");
        return $response->withRedirect($this->router->pathFor('topics'));
    }

    public function addComment($request, $response, $args)
    {
        $params = $request->getParams();
        $database = new DatabaseRequest($this->db);
        $user = $_SESSION['User']->getData();
        $database->addTableData('topiccomments', 'UserID, TopicID, Comment', "'{$user['UserID']}', '{$args['id']}', '{$params['comment']}'");
        return $response->withRedirect("/topics/{$args['id']}");
    }

    public function show($request, $response, $args)
    {
//        $topic = $this->db->prepare("SELECT * FROM topics WHERE TopicID = :ID");
//        $topic->execute([
//            'ID' => $args['id']
//        ]);
//        $topic = $topic->fetch(PDO::FETCH_OBJ);
        $database = new DatabaseRequest($this->db);
        $topicData = $database->findData_ASSOC("topics","topics.TopicID, topics.Title, topics.Owner, topics.Description, topics.TopicCreationDate", "topics.TopicID='{$args['id']}'");
        $data = $database->findData_CLASS('topiccomments LEFT JOIN users ON topiccomments.UserID = users.UserID LEFT JOIN topics
ON topiccomments.TopicID = topics.TopicID', "topiccomments.TCommentID, topiccomments.TopicID, topiccomments.CreationDate, topiccomments.Comment, users.Login, topics.Title", "topiccomments.TopicID='{$args['id']}'", Topic::class);
        return $this->view->render($response, 'topics/show.twig', compact('data', 'topicData'));
    }
}