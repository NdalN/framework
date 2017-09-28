<?php
namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;

class RouterMiddleware
{
	/**
	 * Router instance
	 *
	 * @var Router
	 */
	private $Router;

	public function __construct(Router $Router)
	{
		$this->Router = $Router;
	}

	public function __invoke(ServerRequestInterface $request, callable $next)
	{
		$route = $this->Router->match($request);

		if (is_null($route)) {
			return $next($request);
		}

		$params = $route->getParams();
		$request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
			return $request->withAttribute($key, $params[$key]);
		}, $request);

		$request = $request->withAttribute(get_class($route), $route);

		return $next($request);
	}
}
