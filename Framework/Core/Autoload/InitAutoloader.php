<?php

namespace Framework\Core\Autoload;

class InitAutoloader
{
	private static $loader;

	public function __construct(Bool $loadConfigFile = false)
	{
		if (null !== self::$loader) {
            return self::$loader;
		}

		require __DIR__ . '/Autoload.php';
		self::$loader = $loader = new Autoloader();

		//loading a autoloader config file
        if($loadConfigFile)
        {
			$autoload =  json_decode(file_get_contents(MAIN_CONFIG_DIR . DIRECTORY_SEPARATOR . 'Autoload.json'), true);

			//if is environement of test lauch adding the test autoload config 
			if (TEST) {
				$autoloadTest = json_decode(file_get_contents(MAIN_CONFIG_DIR . DIRECTORY_SEPARATOR . 'AutoloadTest.json'), true);
				$autoload = array_merge_recursive($autoload , $autoloadTest);
			}

			//Set Psr-7
            foreach ($autoload['psr-4'] as $namespace => $path) {
				$loader->addNamespace($namespace, $path);
			}
        }
		
        $loader->register();

        return $loader;
	}
}
