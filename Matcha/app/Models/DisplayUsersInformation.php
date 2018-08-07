<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/7/18
 * Time: 11:43 AM
 */

namespace App\Models;


class DisplayUsersInformation
{
    public function getAllDataFromUser()
    {
        echo "Login: {$this->Login} / Email: {$this->Email} / FirstName: {$this->FirstName} / LastName: {$this->LastName} / City: {$this->City} / Country: {$this->Country} / Age:{$this->Age} ;";
        echo "</br>";
    }
}