<?php

/**
 * User Roles Manager Advanced Example PHP application - an extremely simple user management PHP application
 *
 * @author MakemakeCode
 * @link http://makemakecode.com
 * @link http://forum.makemakecode.com/
 * @link http://makemakecode.com/documents/index.html
 */

/**
 * Configuration for: Error reporting.
 * Useful to show every little problem.
 * @link http://stackoverflow.com/questions/1053424/how-do-i-get-php-errors-to-display
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
define('APP', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'application' . DIRECTORY_SEPARATOR);

// Application library folder path (Application library folder path (Services, Repositories, Entity etc) like "/var/www/application/modules".
define('APP_MODULES', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'application' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

// Vendors' library folder path.
define('APP_VENDORS', DOCUMENT_ROOT . APP_VIRTUAL_FOLDER . 'vendors' . DIRECTORY_SEPARATOR);

// Application content virtual folder path.
define('APP_CONTENT', APP_VIRTUAL_FOLDER);

// This is the application auto-loader registration.
if (file_exists(APP_MODULES . 'Configuration/Autoload.php')) {
    require APP_MODULES . 'Configuration/Autoload.php';
}

// This is the vendors library auto-loader registration.
if (file_exists(APP_VENDORS . 'autoload.php')) {
    require APP_VENDORS . 'autoload.php';
}

// start the application
$app = new \Core\Application();
