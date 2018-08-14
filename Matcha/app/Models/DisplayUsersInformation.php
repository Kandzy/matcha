<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/7/18
 * Time: 11:43 AM
 */

namespace App\Models;


/**
 * Class DisplayUsersInformation
 * @package App\Models
 */
class DisplayUsersInformation
{
    /**
     * get full date. Test function
     */
    public function getAllDataFromUser()
    {
        echo "Login: {$this->Login} / Email: {$this->Email} / FirstName: {$this->FirstName} / LastName: {$this->LastName} / City: {$this->City} / Country: {$this->Country} / Age:{$this->Age} / Notification:{$this->Notification} / Gender:{$this->Gender} / Tags:{$this->Tags} / BIO:{$this->Bio} / Map H : {$this->map_height} W: {$this->map_width};";
        echo "</br>";
    }
}