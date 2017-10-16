<?php
namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Framework\Core\HttpMessage\Response;

class DispatcherMiddleware
{
	/**
	 * Container instance
	 *
	 * @var Router
	 */
	private $Container;

	public function __construct(ContainerInterface $Container)
	{
		$this->Container = $Container;
	}

	public function __invoke(ServerRequestInterface $request, callable $next)
	{
		$route = $request->getAttribute(Router\Route::class);

		if (is_null($route)) {
			return $next($request);
		}

		$callback = $route->getCallback();	
		if (is_string($callback)) {
			$callback = $this->Container->get($callback);
		}

		$response = call_user_func_array($callback, [$request]);
		if (is_string($response))
		{
			return new Response(200, [], $response);
		}
		elseif ($response instanceof ResponseInterface) {
			return $response;
		}
		else {
			throw new Exception('The response is not a string or an instance of ResponseInterface');
		}
	}
}
