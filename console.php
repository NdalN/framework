<?php
// Environment of deploiment 
define('ENVIRONMENT', 'DEVELOPMENT');
define('TEST', true); // if test is active 


//Path Definition 
define('FRAMEWORK_DIR', 'Framework');												//FrameworkDir
define('MAIN_CONFIG_DIR', FRAMEWORK_DIR . DIRECTORY_SEPARATOR . 'Configuration');	//Main Config Dir


// This is the application auto-loader registration.
require 'Framework/Core/Autoload/InitAutoloader.php';

new InitAutoloader(true);

//use Framework\Test\UnitTest;
use Framework\Test\Test;

$Test = new Test();
$Test->run();
$Test->getTestResult();