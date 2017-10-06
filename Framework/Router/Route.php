<?php
namespace Framework\Router;

/**
* 
*/
class Route implements RouterInterface
{
	private $name;

	private $route;

	private $params = [];

	private $callback;

	public function __construct(String $name, Callable $callback, String $route, Array $params = [])
	{
		$this->name = $name;
		$this->route = $route;
		$this->params = $params;
		$this->callback = $callback;
	}

	public function getName(): String
	{
		return $this->name;
	}

	public function getCallback(): Callable
	{
		return $this->callback;
	}

	public function getRoute(): String
	{
		return $this->route;
	}

	public function getParams(): Array
	{
		return $this->params;
	}

	public function addParam(String $name, String $regex)
	{
		$this->params[$name] = $regex;
	}

	public function setParams(Array $params)
	{
		$this->params = $params;
	}

	public function setRoute(Array $route)
	{
		$this->route = $route;
	}
}