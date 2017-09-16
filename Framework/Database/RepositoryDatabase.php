<?php

namespace Database;

use PDO;
use Configuration\Config as Config;

/**
 * Class RepositoryDatabase. This class helps to create PDO database connection.
 * Provides the possibility to wrap SQL specific object to business logic object and collection.
 *
 *  @version 1.0.1
 */
class RepositoryDatabase
{
    /**
     * Open the database connection with the credentials from application/config/config.php.
     *
     * @return application PDO object instance for specific configuration
     */
    public static function openConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php

        $options = array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_STRINGIFY_FETCHES => false, );

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/

        return new PDO(
            Config::databaseProperties()->Type.':host='.
            Config::databaseProperties()->Host.';dbname='.
            Config::databaseProperties()->Database.';charset='.
            Config::databaseProperties()->Charset,
            Config::databaseProperties()->User,
            Config::databaseProperties()->Password,
            $options
        );
    }
}
