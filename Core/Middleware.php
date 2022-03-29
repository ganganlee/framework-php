<?php
/**
 * 中间件抽象类
 * User: Administrator
 * Date: 2022/3/21
 * Time: 17:41
 */

namespace Core;

abstract class Middleware
{
    public static $next;

    public static function setNext($next)
    {
        self::$next = $next;
    }

    abstract public static function handle($request, $next);
}