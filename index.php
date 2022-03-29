<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/3/21
 * Time: 16:08
 */

//开启session
session_start();

//引入自动加载类
include 'vendor/autoload.php';

//定义路由变量，保存路由列表
$globalRoute = [];

//进入引导程序
use Core\Bootstrap;
Bootstrap::main();
