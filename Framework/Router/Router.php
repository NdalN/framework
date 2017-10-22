<?php
namespace Framework\Router;

use Framework\Router\Route;
use Framework\Router\RouteInterface;
use Psr\Http\Message\RequestInterface;

/**
* Router class
*/
class Router
{
	/**
	 * Contain all routes
	 *
	 * @var array
	 */
	private $routes = [];

	/***************************************************************
	 * Adding all Route Type 
	 ***************************************************************/

	/**
	 * Adding route with get method
	 *
	 * @param String $name name of route
	 * @param String $route route
	 * @param Callable $callback callback if route match
	 * @return void
	 */
	public function get(String $name, String $route, Callable $callback)
	{
		$this->addRoute('GET', new Route($name, $route, $callback));
	}

	/**
	 * Adding route with post method
	 *
	 * @param String $name name of route
	 * @param String $route route
	 * @param Callable $callback callback if route match
	 * @return void
	 */
	public function post(String $name, String $route, Callable $callback)
	{
		$this->addRoute('POST', new Route($name, $route, $callback));
	}

	/**
	 * Adding route with put method
	 *
	 * @param String $name name of route
	 * @param String $route route
	 * @param Callable $callback callback if route match
	 * @return void
	 */
	public function put(String $name, String $route, Callable $callback)
	{
		$this->addRoute('PUT', new Route($name, $route, $callback));
	}

	/**
	 * Adding route with delete method
	 *
	 * @param String $name name of route
	 * @param String $route route
	 * @param Callable $callback callback if route match
	 * @return void
	 */
	public function delete(String $name, String $route, Callable $callback)
	{
		$this->addRoute('DELETE', new Route($name, $route, $callback));
	}

	/**
	 * Adding route with Patch method
	 *
	 * @param String $name name of route
	 * @param String $route route
	 * @param Callable $callback callback if route match
	 * @return void
	 */
	public function patch(String $name, String $route, Callable $callback)
	{
		$this->addRoute('PATCH', new Route($name, $route, $callback));
	}

	/**
	 * Adding route with Head method
	 *
	 * @param String $name name of route
	 * @param String $route route
	 * @param Callable $callback callback if route match
	 * @return void
	 */
	public function head(String $name, String $route, Callable $callback)
	{
		$this->addRoute('HEAD', new Route($name, $route, $callback));
	}

	/**
	 * Adding route with all method
	 *
	 * @param String $method
	 * @param RouteInterface $route
	 * @return RouteInterface
	 */
	private function addRoute(String  $method, RouteInterface $route):RouteInterface
	{
		$this->route[$Method][$name] = $route;
		return $route;
	}


	/***************************************************************
	 * Other
	 ***************************************************************/


	/**
	 * Retrieves all routes.
	 * Useful if you want to process or display routes.
	 * @return array All Routes.
	 */
	public function getRoutes() {
		return $this->routes;
	}

	/***************************************************************
	 * Prossesing route
	 ***************************************************************/

	/**
	 * Retrun a route if request matching with a route
	 *
	 * @param RequestInterface $request
	 * @return Route|null
	 */
	public function match(RequestInterface $request): ?Route
	{
		$uri = $request->getUri();
		$method = $request->getMethod();

		foreach ($this->routes as $route) {
			$params = $route->getparams();
			$routeName = $route->getRoute();

			//if is a simpel route withous params
			if (isset($params[0]))
			{
				$routeRegex = $routeName;

				//if params is found this is a complex route
				foreach ($params as $name => $regex)
				{
					$routeRegex = str_replace(':' . $name , $regex, $routeRegex);
				}

				if (preg_match($routeRegex, $routeName))
				{
					return $route;
				}
			}
		}
		
		return NULL;
	}

	/**
	 * Exctrate the params of url, make a final matching url and return a final route object
	 *
	 * @param Route $route
	 * @return Route
	 */
	public function compileRoute(Route $route): Route
	{
		$regexULR = '#^/([a-z0-9-]+/)+#';
		$regexParams = '#{([a-z0-9-]+):(.+)}#';
		//$regexSplitParams = '#}(.)?{#';

		$routeURL = $route->getRoute(); 
		//$paramsRoute = preg_replace('', $regexULR, $route);
		$paramsCount = preg_match_all($regexParams, $paramsRoute, $route);
		$params = [];

		if (empty($paramsCount))
		{
			foreach ($paramsRoute as $param) {
				$param = explode(':', trim($param, '{}')); //removre {} to the begin and end and separe the name of regex
				$params[$param[0]] = $param[1];

				$routeURL = preg_replace_callback($regexParams, function($match) {
					return ':' . $match[1];
				}, $routeURL);
				//$routeURL = preg_replace('$$', $regexParams, $routeURL);
			}
		}
		else
		{
			$params = []; //the route don't have a params
		}

		$route = $route->setParams($params);
		return $route;
	}

	/**
	 * Generate a uri whith a route name  and params
	 *
	 * @param String $name
	 * @param Array $params
	 * @param String $method
	 * @return String|null
	 */
	public function generateUri(String $name, Array $params = [], String $method ='GET'): ?String
	{
		//get the route
		if (isset($this->route[$method][$name]))
		{
			$Route = $this->route[$method][$name];

			$route = $Route->getRoute();

			if (isset($params[0]))
			{
				foreach ($params as $name => $value)
				{
					$uri = str_replace(':'. $name, $value, $route);

					if (strpos($url, ':') !== false)
					{
						throw new Exception("Params don't repace", 1);
					}
				}
			}
			else
			{
				$uri = $route;
			}

			return $uri;
		}

		return NUll;
	}
}
