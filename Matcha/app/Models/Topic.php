<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 3:25 PM
 */

namespace App\Models;
use \App\Controllers\Controller;
use \App\Database\DatabaseRequest;


/**
 * Class Topic
 * @package App\Models
 */
class Topic extends Controller
{
//    /**
//     * @return array
//     */
    protected final function getAllTopics()
    {
        $database = new DatabaseRequest($this->db);
        $data = $database->findData_ASSOC('topics', "*", "1=1 ORDER BY TopicCreationDate DESC");
        return $data;
    }

    /**
     * @param $user
     * @param $title
     * @param $description
     */
    protected final function addForumTopic($user, $title, $description){
        $database = new DatabaseRequest($this->db);
        $database->addTableData('topics', "Owner, UserID, Title, Description", "'{$_SESSION['User']->getUserLogin()}', '{$user['UserID']}', '{$title}', '{$description}'");
    }

    /**
     * @param $TopicID
     * @return array topicResponse
     */
    protected final function displayTopicData($TopicID)
    {
        $database = new DatabaseRequest($this->db);
        $topicData = $database->findData_ASSOC("topics","topics.TopicID, topics.Title, topics.Owner, topics.Description, topics.TopicCreationDate", "topics.TopicID='{$TopicID}'");
        $data = $database->findData_ASSOC('topiccomments 
        LEFT JOIN users ON topiccomments.UserID = users.UserID 
        LEFT JOIN topics ON topiccomments.TopicID = topics.TopicID',
            "topiccomments.TCommentID, topiccomments.TopicID, topiccomments.CreationDate, topiccomments.Comment, users.Login, topics.Title",
            "topiccomments.TopicID='{$TopicID}'");

        $i = 0;
        while($data[$i])
        {
            $data[$i]['Comment'] = htmlspecialchars_decode($data[$i]['Comment']);
            $i++;
        }
        $topicData[0]['Title'] = htmlspecialchars_decode($topicData[0]['Title']);
        $topicData[0]['Description'] = htmlspecialchars_decode($topicData[0]['Description']);
        $topicResponse = [
            'topic_about' => $topicData,
            'topic_content' => $data
        ];
        return $topicResponse;
    }
}

//    /**
//     * @return int
//     */
//    public function rows()
//    {
//        $i = 1;
//        $n = 0;
//        $len = strlen($this->Comment);
//        while ($len > $n) {
//            if ($this->Comment[$n] == PHP_EOL) {
//                $i++;
//            }
//            $n++;
//        }
//    return $i;
//    }
//    public function getTitle()
//    {
//        return $this->title;
//    }