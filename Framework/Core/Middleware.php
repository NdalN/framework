<?php

namespace Framework\Core;

use Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

/**
 * Undocumented class
 */
class Middleware
{
	/**
	 * List of middleware
	 *
	 * @var srting[]
	 */
	private $middlewares;

	/**
	 * Current middleware
	 *
	 * @var integer
	 */
	private $index = 0;

	/**
	 * Add a middleaware
	 *
	 * @param string $middleware middleware to add
	 * @return self
	 */
	public function pipe(string $middleware): self
	{
		$this->middlewares[] = $middleware;

		return $this;
	}

	public function process(ServerRequestInterface $request): ResponseInterface
	{
		$middleware = $this->getMiddleware();
		if (is_null($middleware)) {
			throw new Exception('Error Processing Request Middleware NotFound !');
			
		}
		return call_user_func_array($middleware, [$request, [$this, 'process']]);
	}

	private function getMiddleware(): ?callable
	{
		if (array_key_exists($this->index, $this->middlewares)) {	
			$middleware = $this->container->get($this->middlewares[$this->index]);
			$this->index++;
			return $middleware;
		}

		return null;
	}
}

