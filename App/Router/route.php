<?php
/**
 * 定义路由文件
 * User: ganganlee
 * Date: 2022/3/21
 * Time: 17:05
 */

/**
 * @var \App\Router\ $router
 */

namespace App\Router;

use App\Controller\IndexController;
use App\Middle\Auth;
use Core\Router;

$route = new Router();
$route->get('/', [IndexController::class, 'index'], [Auth::class]);

//注册路由组
$v1 = $route->group('/v1');
{
    $v1->get('/user', [IndexController::class, 'user']);
    $v1->get('/user/:id/', [IndexController::class, 'info']);
    $v1->get('/user/:id/:age', [IndexController::class, 'info']);
}