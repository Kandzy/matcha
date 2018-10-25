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

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    protected final function listOfUsers(&$data, $userToken){
        $database = new DatabaseRequest($this->db);
        $ulist = $database->findData_ASSOC("users", "token, Avatar, Age, FirstName, LastName, Gender, Tags, UserID, Orientation, Popularity, map_height, map_width", "token<>'{$userToken}' AND FullRegister='1'");
        $currentUser = $database->findData_ASSOC("users", "token, Avatar, Age, FirstName, LastName, Gender, Tags, UserID, Popularity, map_height, map_width", "token='{$userToken}'");
        $ulist = array_reverse($ulist);
        for ($i = 0; !empty($ulist[$i]); $i++)
        {
            $ulist[$i]['photos'] = $database->findData_ASSOC('Pictures', "PicID, url", "UserID='{$ulist[$i]['UserID']}'");
            $ulist[$i]['range'] = $this->distance($currentUser[0]['map_width'], $currentUser[0]['map_height'], $ulist[$i]['map_width'], $ulist[$i]['map_height'], "K");
            $ulist[$i]['Status'] = true;
        }
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