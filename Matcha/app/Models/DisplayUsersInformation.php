<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/7/18
 * Time: 11:43 AM
 */

namespace App\Models;
use \App\Controllers\Controller;
use \App\Database\DatabaseRequest;


/**
 * Class DisplayUsersInformation
 * @package App\Models
 */
class DisplayUsersInformation extends Controller
{
    /**
     * get full date. Test function
     */
    protected function allUsers()
    {
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $data = $database->findData_ASSOC("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender, Orientation, map_height, map_width, Bio, Tags, Avatar", "1=1");
        return $data;
    }

    protected function userPage($args){
        $database = new DatabaseRequest($this->db);
        $database->UseDB('db_matcha');
        $Login = htmlspecialchars(addslashes($args['username']));
        $data = $database->findData_ASSOC("users", "UserID, Login, Email, FirstName, LastName, City, Country, Age, Notification, Gender,Orientation, map_height, map_width, Bio, Tags, Avatar", "Login='{$Login}'");
        return $data;
    }
}