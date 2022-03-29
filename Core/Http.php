<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/3/21
 * Time: 16:58
 */

namespace Core;

use Ganganlee\PhpResponse\Response;

class http
{
    /**
     * 处理路由
     */
    public static function handleRoute()
    {
        //获取请求uri
        $uri = $_SERVER['PATH_INFO'];
        $method = $_SERVER['REQUEST_METHOD'];

        //拼接uri
        $uri = $method . $uri;

        //加载路由文件
        include 'App/Router/route.php';
        global $globalRoute;
        $params = [];
        $routeKey = '';

        foreach ($globalRoute as $path => $route) {
            if ($uri == $path) {
                $routeKey = $path;
                break;
            }

            //判断是否存在可变参数
            if (strpos($path, ':') !== false) {
                $tmp = $path;

                //存在可变参数
                preg_match_all('/:(\w+\/?)/', $path, $match);

                $replace = $match[0];
                foreach ($replace as $field) {
                    $field = trim($field, '/');
                    $path = str_replace($field, '(\w+)', $path);
                }

                $path = str_replace('/', '\/', $path);
                $preg = '/^' . $path . '$/';
                preg_match($preg, $uri, $res);
                if (empty($res)) {
                    continue;
                }

                $routeKey = $tmp;
                array_shift($res);

                $params = $res;
                break;
            }
        }

        if (!$routeKey) {
            Response::ResponseError('路由不存在');
        }

        //匹配到路由，解析路由绑定的中间件及控制器，将请求传递到控制器中
        $middleware = $globalRoute[$routeKey]['middleware'];
        $action = $globalRoute[$routeKey]['action'];

        //判断是否存在中间件，存在中间件时，运行中间件
        if ($middleware) {
            $action['params'] = $params;
            self::execMiddleware($middleware, 0, count($middleware) - 1, $action);
            return;
        }

        self::execController($action[0], $action[1], $params);
    }

    /**
     * 执行中间件
     * @param $middle
     * @param $index
     * @param $maxIndex
     * @param $request
     */
    public static function execMiddleware($middle, $index, $maxIndex, $request)
    {
        if ($index < $maxIndex) {
            call_user_func([$middle[$index], 'handle'], [$middle, $index + 1, $maxIndex, $request], function ($request) {

                self::execMiddleware($request[0], $request[1], $request[2], $request[3]);
                return;
            });
        } else {
            call_user_func([$middle[$index], 'handle'], $request, function ($request) {
                //调用控制器方法
                self::execController($request[0], $request[1], $request['params']);
            });
        }
    }

    /**
     * 将请求发送至控制器中
     * @param $controller
     * @param $method
     * @param $params
     */
    public static function execController($controller, $method, $params)
    {
        $obj = new $controller;
        call_user_func_array([$obj, $method], $params);
    }
}