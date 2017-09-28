<?php
use Framework\Test\UnitTest;
use Framework\Core\HttpMessage\ServerRequest;

class TrailingSlashMiddlewareTest extends UnitTest
{
	public function test(Type $var = null)
	{
		$request = new ServerRequest('GET', '/testslash/');
		
		// ??? Test Middleware

		$this->testContains('testslash', $response->getHeader('Location'));
		$this->testEquals(301, $response->getStatusCode());
	}
	
}
