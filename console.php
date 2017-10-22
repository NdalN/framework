<?php
// Environment of deploiment 
define('ENVIRONMENT', 'DEVELOPMENT');
define('TEST', true); // if test is active 


//Path Definition
define('BASSE_DIR', dirname(__FILE__));
define('FRAMEWORK_DIR', 'Framework');												//FrameworkDir
define('MAIN_CONFIG_DIR', FRAMEWORK_DIR . DIRECTORY_SEPARATOR . 'Configuration');	//Main Config Dir

echo "\n------------------[DEBUG-AUTOLOADER]------------------\n\n";
// This is the application auto-loader registration.
require 'Framework/Core/Autoload/InitAutoloader.php';
new Framework\Core\Autoload\InitAutoloader(true);

echo "\n------------------[DEBUG-UNIT_TEST]---------------------\n\n";

//use Framework\Test\UnitTest;
use Framework\Test\Test;
$Test = new Test();
$Test->run();

echo "\n------------------[TEST-RESULT]---------------------\n\n";

$Test->getTestResult();