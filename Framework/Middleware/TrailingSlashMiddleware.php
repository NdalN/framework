<?php
namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Core\HttpMessage\Response;

class TrailingSlashMiddleware
{
	public function __invoke(ServerRequestInterface $request, callable $next)
	{
		$uri = $request->getUri()->getPath();

		if (!empty($uri) && $uri[-1] === '/') {
			return (new Response())
				->withStatus(301)
				->withHeader('Location', substr($uri, 0, -1));
		}

		return $next($request);
	}
}
