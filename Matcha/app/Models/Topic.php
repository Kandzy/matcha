<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/2/18
 * Time: 3:25 PM
 */

namespace App\Models;


/**
 * Class Topic
 * @package App\Models
 */
class Topic
{
    public function getTopics(){
        echo "{$this->Title} | Onwer: {$this->Owner} | Date: {$this->TopicCreationDate}</br>Description: {$this->Description}";
    }

    /**
     * @return int
     */
    public function rows()
    {
        $i = 1;
        $n = 0;
        $len = strlen($this->Comment);
        while ($len > $n) {
            if ($this->Comment[$n] == PHP_EOL) {
                $i++;
            }
            $n++;
        }
    return $i;
    }
//    public function getTitle()
//    {
//        return $this->title;
//    }
}