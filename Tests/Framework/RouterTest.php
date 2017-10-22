<?php
//namespace Test\Framework\Router;

use Framework\Test\UnitTest;
use Framework\Core\HttpMessage\ServerRequest;
use Framework\Router\Router;

class RouterTest extends UnitTest
{
	public function initTestEnvironement()
	{
		$this->Router = new Router();
	}

	public function testGetMethod()
	{
		$request = new ServerRequest('GET', '/test');
		$route = $this->Router->get('test', '/test', function() { return 'hello test'; });
		$route = $this->Router->match($request);
		$this->TestEquals('test', $route->getName());
		$this->TestEquals('hello test', call_user_func_array($route->getCallback(), [$request]));
	}

	public function testGetMethodIfURLDoesNotExists()
	{
		$request = new ServerRequest('GET', '/test');
		$route = $this->Router->get('invalid', '/invalid', function() { return 'hello test'; });
		$route = $this->Router->match($request);
		$this->TestEquals(NULL, $route);
	}

	public function testGetMethodWithParameters()
	{
		$request = new ServerRequest('GET', '/test/my-slug-42');
		$route = $this->Router->get('test.simple', '/test', function() { return 'hello'; });
		$route = $this->Router->get('test.params', '/test{slug:[a-z0-9\-]+}-{id:[0-9]+}', function() { return 'hello test'; });
		$route = $this->Router->match($request);
		$this->TestEquals('test.params', $route->getName());
		$this->TestContains(['slug' => 'my-slug', 'id' => '42'] , call_user_func_array($route->getParams(), [$request]));

		//Test an bad request
		$request = new ServerRequest('GET', '/test/my_slug-42');
		$route = $this->Router->match($request);
		$this->TestEquals(NULL, $route);
	}

	public function testGenerateUri()
	{
		$request = new ServerRequest('GET', '/test/my-slug-42');
		$route = $this->Router->get('test.simple', '/test', function() { return 'hello'; });
		$route = $this->Router->get('test.params', '/test{slug:[a-z0-9\-]+}-{id:[0-9]+}', function() { return 'hello test'; });

		$uri = $this->Router->generateUri('test.params', ['slug' => 'test-generate', 'id' => 42]);
		$this->TestEquals('/test/test-generate-42', $uri);
	}
}
//[]