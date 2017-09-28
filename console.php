<?php

// This is the application auto-loader registration.
require 'Framework/Core/Autoload.php';
require 'Framework/Configuration/AutoloadConfig.php';
require 'Framework/Configuration/TestAutoloadConfig.php';
$Autoload->register();


use Framework\Test\UnitTest;
use Framework\Test\Test;

$Test = (new Test())
		->run();