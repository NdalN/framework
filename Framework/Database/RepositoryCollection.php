<?php

namespace Database;

use PDO;

/**
 * Class RepositoryCollection. This is collection management class.
 * Provides the possibility to wrap SQL specific object to business logic object and collection.
 *
 *  @version 1.0.1
 */
class RepositoryCollection
{
    /**
     * Represents entity classes namespace.
     *
     * @var string
     */
    private static $entityNamespace = '\\Entities\\';

    /**
     * Represents SQL server cursor array properties.
     *
     * @return array
     */
    private static function cursor()
    {
        return array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY);
    }

    /**
     * [command description].
     *
     * @param string $sql SQL statement string.
     *
     * @return object SQL server prepered sql statement.
     */
    public static function command($sql)
    {
        $connection = RepositoryDatabase::openConnection();

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

        return $connection->prepare($sql, self::Cursor());
    }

    /**
     * Returns first or default instance of spisified class for executed SQL statement.
     * http://coursesweb.net/php-mysql/integer-float-value-select-pdo-string-numeric_t.
     *
     * @param object $command SQL server prepered sql statement.
     * @param string $class   Class name.
     *
     * @return object Instance of specified class
     */
    public static function getResultFirstOrDefault($command, $class = null)
    {
        $result = self::getResult($command, $class);

        if (count($result) > 0) {
            return $result[0];
        } elseif ($class != null) {
            $full_class_name = 'Entities\\'.$class;

            return new $full_class_name();
        } else {
            return $result;
        }
    }

    /**
     * Returns array of spisified class instance for executed SQL statement.
     * http://coursesweb.net/php-mysql/integer-float-value-select-pdo-string-numeric_t.
     *
     * @param object $command SQL server prepered sql statement.
     * @param string $class   Class name.
     *
     * @return object Instance of specified class
     */
    public static function getResult($command, $class = null)
    {
        $result = array();

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . \Utilities\Helper::debugPDO($sql, $parameters);  exit();

        if ($command->execute()) {
            // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
            // core/controller.php! If you prefer to get an associative array as the result, then do
            // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
            // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...

            // if fetch() returns at least one row (not false), adds the rows in $correct for return

            if (($row = $command->fetch(PDO::FETCH_ASSOC)) !== false) {
                do {
                    // check each column if it has numeric value, to convert it from 'string'
                    // http://stackoverflow.com/questions/9833325/how-to-get-the-field-data-type-and-in-pdo
                    foreach ($row as $k => $v) {
                        if (strlen($v) <= 15 && (is_int($v) || is_numeric($v))) {
                            $row[$k] = $v + 0;
                        } else {
                            $row[$k] = $v;
                        }
                    }

                    $result[] = $row;
                } while ($row = $command->fetch(PDO::FETCH_ASSOC));
            }
        }

        // If class was specified then create an array of specified class instances .
        // If no class specified the return array of standard class instances.

        if (isset($class)) {
            $result_entities = array();
            $class_name = self::$entityNamespace.$class;

            foreach ($result as $row) {
                $result_entities[sizeof($result_entities)] = new $class_name($row);
            }

            return $result_entities;
        } else {
            return $result;
        }
    }
}
