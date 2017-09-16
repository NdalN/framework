<?php

namespace Core;

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

	public function run()
	{
		
	}
}
