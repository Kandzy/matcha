<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/14/18
 * Time: 11:31 AM
 */

namespace App\Middleware;


use App\Database\DatabaseRequest;

/**
 * Class FirstTimeConnectedUser
 * @package App\Middleware
 */
class FirstTimeConnectedUser
{
    private $database;

    /**
     * FirstTimeConnectedUser constructor.
     * @param $database
     */
    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        $db = new DatabaseRequest($this->database);
        if (method_exists($_SESSION['User'], "getUserLogin")) {
            $login = htmlspecialchars(addslashes($_SESSION['User']->getUserLogin()));
            $data = $db->findData_ASSOC("users", "FullRegister", "Login='{$login}'");
            if ($data[0]['FullRegister'] == 0) {
                $redirect = '/profile/' . $login . '/register';
                return $response->withRedirect($redirect);
            }
        }else {
            return $response->withRedirect('/signin');
        }
        return $next($request, $response);
    }
}