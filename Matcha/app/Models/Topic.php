<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 3:25 PM
 */

namespace App\Models;


class Topic
{
    public function getTopics()
    {
        echo "{$this->Title} | Onwer: {$this->Owner} | Date: {$this->CreationDate}</br>Description: {$this->Description}";
    }
//    public function getTitle()
//    {
//        return $this->title;
//    }
}