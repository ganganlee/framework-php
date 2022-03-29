# framework-php
php开发框架，此框架只包含
 - 控制器模块 - controller
 - 数据层模块 - model
 - 路由模块 - route
 - 中间件模块 - middleware
 
 ### 路由使用文档
 - 路由文件在App/Route/route.php定义
 ```php
//定义一个get请求
$route->get('/', [IndexController::class, 'index'], [Auth::class]);
//规则：第一个参数是对应的路由，第二个参数是对应的控制器跟方法，第三个是可选参数，对应的是中间件，中间件执行的先后顺序是按照此处定义的先后顺序执行的，可以定义多个中间件，自定义中间件参考下文

//定义一个post请求，put,delete请求同理
$route->post('/login',[IndexController::class,'login']);

//定义一个路由参数，:id表示可以在控制器的方法中接收到该参数，控制器的定义参考上文
$route->get('/info/:id',[IndexController::class,'login']);

//定义一个路由组
$v1 = $route->group('/v1',[Auth::class]);
{
    $v1->get('/user', [IndexController::class, 'user']);
    $v1->get('/user/:id/', [IndexController::class, 'info']);
    $v1->get('/user/:id/:age', [IndexController::class, 'info']);
}
//规则：第一个参数对应路由前缀，第二个参数对应路由中间件，中间件的执行顺序对应此处的顺序，可以定义多个中间件
//定义路由组时返回一个新的路由对象，再用此对象定义此路由组中的路由
```