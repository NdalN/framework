<?php
namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;

class MethodMiddleware
{
	public function __invoke(ServerRequestInterface $request, callable $next)
	{
		$parsedBody = $request->getParsedBody();
		
		if (array_key_exists('_methode', $parsedBody) && in_array(['_method'], ['DELETE', 'PUT']))
		{
			$request = $request->withMethod($parsedBody['_method']);
		}

		return $next($request);
	}
}
