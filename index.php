<?php
/**
 * The NdalN modular framwork
 *
 * @author NdalN
 * @license OPEN-NdalN
 * @link http://ndaln.com
 */

/**
 * Configuration for: Error reporting.
 * Useful to show every little problem.
 * @link http://stackoverflow.com/questions/1053424/how-do-i-get-php-errors-to-display
 */
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_app_virtual_folder()
{
    $root = rtrim(DOCUMENT_ROOT, '/');
    $filePath = dirname(__FILE__);
    $subfolder = str_ireplace($root, '', $filePath);
    return ($subfolder != '' ? $subfolder . '/' : '/');
}

// Web server ROOT folder like "/var/www/".
define('DOCUMENT_ROOT', rtrim($_SERVER['DOCUMENT_ROOT'], '/'));
// Subfolder in case of application installed in subfolder.
define('APP_VIRTUAL_FOLDER', get_app_virtual_folder());


// Set a constant that holds the project's "application/modules" folder, like "/var/www/application".
define('APPLICATION', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'Application' . DIRECTORY_SEPARATOR);
// Application library folder path (Application library folder path (Services, Repositories, Entity etc) like "/var/www/application/modules".
define('MODULES', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'Application' . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR);


// Application library folder path (Application library folder path (Services, Repositories, Entity etc) like "/var/www/application/modules".
define('FRAMEWORK', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'Framework' . DIRECTORY_SEPARATOR);
// Application library folder path (Application library folder path (Services, Repositories, Entity etc) like "/var/www/application/modules".
define('FRAMEWORK_CORE', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'Framework' . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR);
// Application library folder path (Application library folder path (Services, Repositories, Entity etc) like "/var/www/application/modules".
define('FRAMEWORK_CONFIG', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'Framework' . DIRECTORY_SEPARATOR . 'Configuration' . DIRECTORY_SEPARATOR);

//Library folder path.
define('LIBS', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'Libs' . DIRECTORY_SEPARATOR);


// This is the application auto-loader registration.
require FRAMEWORK_CORE . 'Autoload.php';
require FRAMEWORK_CONFIG . 'AutoloadConfig.php';

// start the application
$Application = new Framework\Core\Application();
$Application->run(Framework\Core\HttpMessage\ServerRequest::initWithGlobals());
