<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 10/22/18
 * Time: 7:51 PM
 */

namespace App\Models;


use App\Controllers\Controller;
use App\Database\DatabaseRequest;

/**
 * Class Notification
 * @package App\Models
 */
class Notification extends Controller
{
    /**
     * @param $data
     * @return array
     * @internal param $token
     */
    protected final function checkNotification($data)
    {
        $database = new DatabaseRequest($this->db);
        $notification = $database->findData_ASSOC("notification",
            "NID, Type, sourceID, sourceName, TargetID, TargetName, TargetToken",
            "TargetToken='{$data['token']}'");
        if($notification) {
            for ($i = 0; $notification[$i]; $i++) {
                $database->deleteTableData("notification", "NID='{$notification[$i]['NID']}'");
            }
        }
        else{
            return [
                'notification' => false,
                'message' => "No new notifications",
            ];
        }
//        $database->deleteTableData("notification", "TargetToken='{$data['token']}'");
        return $notification;
    }

    /**
     * @param $sourceToken
     * @param $targetToken
     * @param $Type
     * @return bool
     */
    protected final function addNotification($sourceToken, $targetToken, $Type)
    {
        $database = new DatabaseRequest($this->db);
        $target = $database->findData_ASSOC('users', "UserID, CONCAT(FirstName, ' ', LastName) as Name", "token='{$targetToken}'");
        $source = $database->findData_ASSOC('users', "UserID, CONCAT(FirstName, ' ', LastName) as Name", "token='{$sourceToken}'");
        if ($target && $source) {
            $database->addTableData("notification", "Type, sourceID, sourceName, TargetID, TargetName, TargetToken",
                "'{$Type}', '{$source[0]['UserID']}', '{$source[0]['Name']}', '{$target[0]['UserID']}', '{$target[0]['Name']}', '{$targetToken}'");
            return true;
        }
        else
        {
            return false;
        }
    }
}