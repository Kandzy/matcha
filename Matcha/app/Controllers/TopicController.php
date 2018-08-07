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
        $data = $database->findData_CLASS('topics', "*", "1=1 ORDER BY CreationDate DESC", Topic::class);
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

    public function show($request, $response, $args)
    {
        $topic = $this->db->prepare("SELECT * FROM topics WHERE ID = :ID");
        $topic->execute([
            'ID' => $args['id']
        ]);
        $topic = $topic->fetch(PDO::FETCH_OBJ);
        return $this->view->render($response, 'topics/show.twig', compact('topic'));
    }
}