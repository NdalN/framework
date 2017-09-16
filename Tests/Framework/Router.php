<?php

use Framework\Test\UnitTest;

use Framework\Core\Request;

class Router extends UnitTest
{
	public function __construct()
	{
		$this->Router = new Router();
	}

	public function testGetMethod()
	{
		$request = new Request('GET', '/test');
		$route = $this->Router->get('/blog', function() { return 'hello'; }, 'blog');
		$route = $this->Router->match($request);
		$this->TestEquals('test', $route->getName());
		$this->TestEquals('hello', call_user_func_array($route->getCallback(), [$request]));
	}

	public function testGetUrl()
	{
		$request = new Request('GET', '/test');
		$route = $this->Router->get('/blog', function() { return 'hello'; }, 'blog');
		$route = $this->Router->match($request);
		$this->TestEquals('test', $route->getName());
		$this->TestEquals('hello', call_user_func_array($route->getCallback(), [$request]));
	}

	public function testGetUrl()
	{
		$request = new Request('GET', '/test');
		$route = $this->Router->get('/blog', function() { return 'hello'; }, 'blog');
		$route = $this->Router->match($request);
		$this->TestEquals('test', $route->getName());
		$this->TestEquals('hello', call_user_func_array($route->getCallback(), [$request]));
	}
}
