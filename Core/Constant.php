<?php
/**
 * 设置常量跟市区
 * User: Administrator
 * Date: 2021/2/5
 * Time: 16:58
 */

namespace Core;

class Constant
{
    public static function main()
    {
        //设置时区
        date_default_timezone_set("Asia/Shanghai");

        //定义网站根目录
        define("ROOT", $_SERVER['DOCUMENT_ROOT']);

        //定义template根目录
        define("ROOT_VIEW", ROOT . '/view');

        //定义静态资源目录
        define("ROOT_STATIC", ROOT . '/static');

        //定义缓存目录
        define('CACHE_DIR', ROOT . '/cache');
    }
}