<?php

// namespace Framework\Core\Autoload;

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

			if (TEST) {
				$autoloadTest = json_decode(file_get_contents(MAIN_CONFIG_DIR . DIRECTORY_SEPARATOR . 'AutoloadTest.json'), true);
				$autoload = array_merge($autoload , $autoloadTest);
			}

			//Set Psr-7
            foreach ($autoload['psr-4'] as $namespace => $path) {
				$loader->setPsr4($namespace, $path);
			}
			
			//set ClassMap
            if ($autoload['classMap']) {
				$loader->addClassMap($autoload['classMap']);
			}
			
			//Set NameSpace
			foreach ($autoload['nameSpace'] as $namespace => $path) {
				$loader->set($namespace, $path);
			}
        }
		
        $loader->register(true);


        return $loader;
	}
}
