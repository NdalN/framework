<?php
namespace Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Core\HttpMessage\Response;

class NotFoundMiddleware
{
	public function __invoke(ServerRequestInterface $request, callable $next)
	{
		return new Response(404, [], '<h1>404 : Not Found</h1>');
	}
}
