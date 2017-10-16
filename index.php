<?php
// Environment of deploiment 
define('ENVIRONMENT', 'DEVELOPMENT');
define('TEST', false); // if test is active 


//Path Definition 
define('FRAMEWORK_DIR', 'Framework');												//FrameworkDir
define('MAIN_CONFIG_DIR', FRAMEWORK_DIR . DIRECTORY_SEPARATOR . 'Configuration');	//Main Config Dir


require 'Framework/Core/Autoload/InitAutoloader.php';

$Application = new \Framework\Core\Application();

$response = $Application->run(\Framework\Core\Request);

