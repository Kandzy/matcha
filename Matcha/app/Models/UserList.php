<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 9/25/18
 * Time: 2:41 PM
 */

namespace App\Models;


use App\Controllers\Controller;
use App\Database\DatabaseRequest;

/**
 * Class UserList
 * @package App\Models
 */
class UserList extends Controller
{
    /**
     * @param $data
     * @param $ulist
     */
    private final function maxValues(&$data, $ulist){
        $data['maxAge'] = 16;
        $data['maxPopular'] = 0;
        foreach ($ulist as $value)
        {
            if ($data['maxAge'] < $value['Age']) {
                $data['maxAge'] = $value['Age'];
            }
            if ($data['maxPopular'] < $value['Popularity']) {
                $data['maxPopular'] = $value['Popularity'];
            }
        }
    }

    /**
     * @param $ulist
     * @param DatabaseRequest $database
     */
    private final function userTags(&$ulist, DatabaseRequest $database){
        $i = 0;
        while ($ulist[$i])
        {
            $uid = $ulist[$i]['UserID'];
            $ulist[$i]['Tags'] = $database->findData_ASSOC("user_tag  LEFT JOIN tags ON user_tag.tag=tags.tid", "tags.tag", "user_tag.user='$uid'");
            $i++;
        }
    }

    /**
     * tags -> preference!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */

    protected final function listOfUsers(&$data){
        $database = new DatabaseRequest($this->db);
        $ulist = $database->findData_ASSOC("users", "token, Avatar, Age, FirstName, LastName, Gender, Tags, UserID, Popularity", "1=1");
        $this->maxValues($data, $ulist);
        $this->userTags($ulist, $database);
        $data['users'] = $ulist;
        $data['message'] = "Users data were received";
    }

    protected final function sortUsersBy(&$data, $sortBy){
        $database = new DatabaseRequest($this->db);
        $maxAge = htmlspecialchars(addslashes($sortBy['maxAge']));
        $minAge = htmlspecialchars(addslashes($sortBy['minAge']));
        $minPop = htmlspecialchars(addslashes($sortBy['minPop']));
        $maxPop = htmlspecialchars(addslashes($sortBy['maxPop']));
        $orientation = htmlspecialchars(addslashes($sortBy['sexPref']));
        $preferences = $sortBy['preferances'];
        $ulist = $database->findData_ASSOC("users", "token, Avatar, Age, FirstName, LastName, Gender, Tags, UserID, Popularity",
            "Age BETWEEN {$minAge} AND {$maxAge} AND Popularity BETWEEN {$minPop} AND {$maxPop} AND Orientation='{$orientation}'");
        $data['users'] = $ulist;
    }
}