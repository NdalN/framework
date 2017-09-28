<?php

namespace Framework\Core;

use Framework\Core\HttpMessage\HttpMessageIO;
// use Framework\Core\HttpMessage;
use Framework\Core\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * Implements application module management.
 *
 * @version 1.0.1
 */
class Application
{
	/**
	 * List of module
	 *
	 * @var array
	 */
	private $modules = [];

	/**
	 * Middleware instance
	 *
	 * @var Middleware
	 */
	private $Middleware;

	/**
	 * Container instance
	 *
	 * @var Container
	 */
	private $container;

	/**
	 * Application constructor 
	 *
	 * @param array $modules module list
	 * @param array $middlewares middleware list
	 * @param string $containerDefinition path definition of container
	 */
	public function __construct(array $modules, array $middlewares, string $containerDefinition)
	{
		$this->Middleware = new Middleware(); //???

		foreach ($modules as $module)
		{
			$this->modules[] = new $module();
		}

		foreach ($middlewares as $middleware)
		{
			$this->Middleware->pipe($middleware);
		}
	}

	public function run(ServerRequestInterface $request): ResponseInterface
	{
		//??? need to load module with container

        $this->Middleware->process($request);
		

		HttpMessageIO::send();
	}
}
