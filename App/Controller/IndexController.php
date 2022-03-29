<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/3/21
 * Time: 17:35
 */

namespace App\Controller;

class IndexController
{
    public function index()
    {
        echo 'index';
    }

    public function user()
    {
        echo 'user';
    }

    public function info($id, $age)
    {
        echo 'id:' . $id . '<br>';
        echo 'age:' . $age . '<br>';
    }
}