<?php

namespace Framework\Core;

//use Framework\Core\HttpMessage;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * Implements application module management.
 *
 * @version 1.0.1
 */
class Application
{
	private $modules = [];

	public function __construct(array $modules)
	{
		foreach ($modules as $module)
		{
			$this->modules[] = new $module();
		}
	}

	public function run(ServerRequestInterface $request): ResponseInterface
	{
        
        if ()
        {
            
        }
	}
}
