<?php
/**
 * 用户授权中间件
 * User: Administrator
 * Date: 2022/3/21
 * Time: 17:40
 */

namespace App\Middle;

use Core\Middleware;
use Ganganlee\PhpResponse\Response;

class Auth extends Middleware
{
    public static function handle($request, $next)
    {
        // TODO: Implement handle() method.

        echo '加载了中间件<br>';

        Response::ResponseError('结束请求');
        $next($request);
    }
}