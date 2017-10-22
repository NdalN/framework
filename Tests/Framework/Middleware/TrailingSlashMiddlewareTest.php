<?php
use Framework\Test\UnitTest;
use Framework\Core\HttpMessage\ServerRequest;

class TrailingSlashMiddlewareTest extends UnitTest
{
	/**
	 * Undocumented variable
	 *
	 * @var [type]
	 */
	private $Middleware;

	public function initTestEnvironement()
	{
		$this->Middleware = new Framework\Middleware\TrailingSlashMiddleware;
	}

	public function removeTrailingSlash()
	{
		$request = new ServerRequest('GET', '/testslash/');
		
		call_user_func_array($this->Middleware, [$request, function ($request){
			$this->testContains('testslash', $request->getHeader('Location'));
			$this->testEquals(301, $request->getStatusCode());
		}]);
	}
}
