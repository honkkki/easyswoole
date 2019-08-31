<?php


namespace App\HttpController;
use FastRoute\RouteCollector;
use EasySwoole\Http\AbstractInterface\AbstractRouter;


class Router extends AbstractRouter
{
    function initialize(RouteCollector $routeCollector)
    {
        $routeCollector->get('/test','Index/test');

        $routeCollector->get('/main', 'Main/IndexController/index');

        $routeCollector->get('/add', 'Main/IndexController/add');
        $routeCollector->get('/co', 'Main/IndexController/coAdd');
        $routeCollector->get('/classic', 'Main/IndexController/classicAdd');

    }
}