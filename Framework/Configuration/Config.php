<?php

namespace Configuration;

/*
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

/*
 * Session variable keys and redirect url definition definition.
 */
define('URL_PROTOCOL', 'http://');
define('APP_USER_MANAGEMENT_URL', URL_PROTOCOL.'accounts.localhost.com');

/*
 * You can use the API call to authenticate a user if user roles manager and your site
 * are placed on different server instances. Set APP API AUTHENTICATION to true to use that.
 */
define('APP_API_AUTHENTICATION', false);
define('APP_API_ENDPOINT', 'http://accounts.localhost.com/api');
define('APP_API_USER', '');
define('APP_API_TOKEN', '');

/**
 * Configuration class.
 * The class represents application static configuration properties.
 *
 * @version 1.0.1
 */
class Config
{
    protected static $instance;


    public static function __callStatic($method, $args)
    {
        $self = self::_instance();

        switch ($method) {
            case 'path':
                return (object) $self->path;
            case 'urlSecurity':
                return (object) $self->urlSecurity;
            case 'cryptoSecurity':
                return (object) $self->cryptoSecurity;
            case 'generalProperties':
                return (object) $self->generalProperties;
        }

        return;
    }

    public static function _instance()
    {
        static $initialized = false;

        if (!$initialized) {
            self::$instance = new self();
            $initialized = true;
        }

        return self::$instance;
    }
}
