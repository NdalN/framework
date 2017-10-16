<?php

namespace Framework\Core;

class Application
{
	function __construct()
	{

	}

	public function run(ServerRequestInterface $request): ResponseInterface
	{
		
	}

	public function temp()
	{
		if ((!empty($uri)) AND $uri[-1] === '/') {
			substr($uri, 0 , 1);
		} else {
			# code...
		}
		
	}
}