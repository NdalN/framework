<?php
/**
 * The NdalN modular framwork
 *
 * @author NdalN
 * @license OPEN-NdalN
 * @link http://ndaln.com
 */

// This is the application auto-loader registration.
// require FRAMEWORK_CORE . 'Autoload.php';
// require FRAMEWORK_CONFIG . 'AutoloadConfig.php';

require 'Framework/Core/Autoload.php';
require 'Framework/Configuration/AutoloadConfig.php';
$Autoload->register();

//Liste of active module
$modules = [
    \Application\AdminModule::class,
    \Application\BlogModule::class
];

//Liste of active middleware
$middlewares = [
    \Framework\Middleware::TrailingSlashMiddleware::class, //First
    \Framework\Middleware::MethodMiddleware::class,
    \Framework\Middleware::RouterMiddleware::class,
    \Framework\Middleware::DispatcherMiddleware::class,
    \Framework\Middleware\NotFoundMiddleware::class //Last
];

//Start the application
$Application = new Framework\Core\Application($modules, $middlewares);

$Application->run(Framework\Core\HttpMessage\ServerRequest::getfromGlobals());

