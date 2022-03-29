<?php
/**
 * 路由对象
 * User: ganganlee
 * Date: 2022/3/21
 * Time: 17:00
 */

namespace Core;

class Router
{
    private $route = [];
    private $prefix = '';
    private $middleware = [];

    /**
     * get请求
     * @param string $params
     * @param $controller
     */
    public function get(string $path, array $action, array $middleware = [])
    {
        $path = trim($path, '/');
        global $globalRoute;
        $prefix = $this->prefix;
        $middleware = array_merge($this->middleware, $middleware);

        $method = 'GET/';
        $globalRoute[$method . $prefix . $path] = ['method' => $method, 'action' => $action, 'uri' => $path, 'middleware' => $middleware];
    }


    public function getRoute()
    {
        print_r($this->route);
    }

    /**
     * 设置路由组
     * @param string $prefix
     * @param array $middleware
     * @return Router
     */
    public function group(string $prefix, array $middleware = [])
    {
        $obj = new self();
        $prefix = trim($prefix, '/');
        $obj->prefix = $prefix . '/';
        $obj->middleware = $middleware;
        return $obj;
    }
}