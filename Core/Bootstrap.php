<?php
/**
 * 框架指引程序
 * User: ganganlee
 * Date: 2022/3/21
 * Time: 16:17
 */

namespace Core;

include 'Env.php';

class Bootstrap
{

    /**
     * 框架执行入口
     */
    public static function main()
    {

        //设置跨域
        CrossDomain::main();

        //设置系统常量
        Constant::main();

        //加载配置文件
        try {
            Env::loadFile('.env');
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        //定义调试模式
        if (Env::get('debug')) {
            ini_set('display_errors', 'On');
        } else {
            ini_set('display_errors', 'Off');
        }

        //处理用户路由操作
        http::handleRoute();
    }
}