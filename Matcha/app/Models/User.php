<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 12:13 PM
 */

namespace App\Models;

use PDO;

class User
{
    private $Login;
    private $ID;
    private $FirstName;
    private $LastName;
    private $data;

    public function getUserLogin(){
        return $this->Login;
    }

    private function setLogin($Login){
        $this->Login = $Login;
    }

    private function UploadData(){

    }
//    public function fullData()
//    {
//        if ($this->Name == null)
//        {
//            return $this->Username;
//        }
//        return "{$this->Username} / {$this->Name}";
//    }
}