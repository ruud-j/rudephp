<?php

use RudePHP\Exception\RouteNotFoundException;
use RudePHP\Http\Request\Method;
use RudePHP\Http\Request\Request;
use RudePHP\Http\Routing\Dispatcher;
use RudePHP\Http\Routing\Route;
use RudePHP\Http\Routing\RoutePath;
use RudePHP\Http\Routing\RouteStorage;

class DispatcherTest extends PHPUnit_Framework_TestCase
{
    public function testDispatchGet()
    {
        $routeStorage = new RouteStorage();
        $route = new Route(Method::GET, new RoutePath('/foo/bar'), function() {return 41;});
        $routeStorage->register($route);

        $dispatcher = new Dispatcher($routeStorage);

        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo/bar']);
        $this->assertEquals(41, $dispatcher->dispatch($request));
    }

    public function testDispatchPost()
    {
        $routeStorage = new RouteStorage();
        $route = new Route(Method::POST, new RoutePath('/foo/bar'), function() {return 41;});
        $routeStorage->register($route);

        $dispatcher = new Dispatcher($routeStorage);

        $request = new Request(['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/foo/bar']);
        $this->assertEquals(41, $dispatcher->dispatch($request));
    }

    public function testDispatchException()
    {
        $routeStorage = new RouteStorage();
        $route = new Route(Method::GET, new RoutePath('/foo/bar'), function() {return 41;});
        $routeStorage->register($route);

        $dispatcher = new Dispatcher($routeStorage);

        $this->expectException(RouteNotFoundException::class);
        $request = new Request(['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/foo']);
        $dispatcher->dispatch($request);
    }
}