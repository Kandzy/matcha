<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/7/18
 * Time: 10:54 AM
 */

namespace App\Middleware;


/**
 * Class RedirectIfUnauthenticated
 * @package App\Middleware
 */
class RedirectIfUnauthenticated
{
    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        if (!isset($_SESSION['User']))
        {
                $response = $response->withRedirect('/signin');
        }
        return $next($request, $response);
    }
}