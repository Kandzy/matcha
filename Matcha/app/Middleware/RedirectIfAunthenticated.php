<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/7/18
 * Time: 11:29 AM
 */

namespace App\Middleware;


class RedirectIfAunthenticated
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['User'])) {
            $response = $response->withRedirect('/');
        }
        return $next($request, $response);
    }
}