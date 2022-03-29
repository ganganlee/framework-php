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

    /**
     * post请求
     * @param string $path
     * @param array $action
     * @param array $middleware
     */
    public function post(string $path, array $action, array $middleware = [])
    {
        $path = trim($path, '/');
        global $globalRoute;
        $prefix = $this->prefix;
        $middleware = array_merge($this->middleware, $middleware);

        $method = 'POST/';
        $globalRoute[$method . $prefix . $path] = ['method' => $method, 'action' => $action, 'uri' => $path, 'middleware' => $middleware];
    }

    /**
     * PUT请求
     * @param string $path
     * @param array $action
     * @param array $middleware
     */
    public function put(string $path, array $action, array $middleware = [])
    {
        $path = trim($path, '/');
        global $globalRoute;
        $prefix = $this->prefix;
        $middleware = array_merge($this->middleware, $middleware);

        $method = 'PUT/';
        $globalRoute[$method . $prefix . $path] = ['method' => $method, 'action' => $action, 'uri' => $path, 'middleware' => $middleware];
    }

    /**
     * DELETE请求
     * @param string $path
     * @param array $action
     * @param array $middleware
     */
    public function delete(string $path, array $action, array $middleware = [])
    {
        $path = trim($path, '/');
        global $globalRoute;
        $prefix = $this->prefix;
        $middleware = array_merge($this->middleware, $middleware);

        $method = 'DELETE/';
        $globalRoute[$method . $prefix . $path] = ['method' => $method, 'action' => $action, 'uri' => $path, 'middleware' => $middleware];
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