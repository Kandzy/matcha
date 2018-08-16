<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/16/18
 * Time: 12:21 PM
 */

namespace App\Controllers;


/**
 * Class MainPage
 * @package App\Controllers
 */
class MainPage extends Controller
{
    /**
     * @param $req
     * @param $res
     * @param $args
     * @return mixed
     */
    public function index($req, $res, $args){
        $currentUser = $_SESSION['User']->getData();
        
        return $this->view->render($res, 'mainpage/mainpage.twig', compact('data'));
    }
}