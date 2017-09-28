<?php

use Framework\Test\UnitTest;

use Framework\Core\Route;
use Framework\Core\HttpMessage\Request;

class RouterTest extends UnitTest
{
	public function initTestEnvironement()
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

}
