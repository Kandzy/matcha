<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 1:01 PM
 */

namespace App\Controllers;
use PDO;
use \App\Models\Topic;

class TopicController extends Controller
{

    public function index($request, $response)
    {
        $data = $_SESSION['User']->getData();
        return $this->view->render($response, 'topics/index.twig', compact('data'));
    }


    public function show($request, $response, $args)
    {
        $topic = $this->db->prepare("SELECT * FROM topics WHERE ID = :ID");
        $topic->execute([
            'ID' => $args['id']
        ]);
        $topic = $topic->fetch(PDO::FETCH_OBJ);
//        return $this->view->render($response, 'topics/show.twig', compact('topic'));
    }
}