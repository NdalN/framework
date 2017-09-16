<?php

namespace Database;

use PDO;

/**
 * Abstract RepositoryItem Class. This is result set item wrapper management class.
 * This class represents common business object class wrapper.
 * It needs to define common logic for saving/removing/updating in the database.
 *
 * @version 1.0.1
 */
class RepositoryItem
{
    /**
     * Represents entity primary key field. It needs to create insert/updat/delete statements for specific entity.
     *
     * @var string
     */
    protected $primaryFiledName;

    /**
     * Represent array of PDO cursor properties.
     *
     * @return array Returns array of PDO cursor properties.
     */
    private static function cursor()
    {
        return array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY);
    }

    /**
     * Gets an entitity table name.
     *
     * @return string Returns an entitity table name.
     */
    private function getTableName()
    {
        $classname = get_called_class();
        $classname = substr($classname, strrpos($classname, '\\') + 1);

        return strtolower(\Database\RepositoryTableMap::getEntityTables()->{$classname});
    }

    /**
     * Opens connection and prepared SQL statements for execution.
     *
     * @param string $sql SQL statements string.
     *
     * @return object Returns PDO prepared cpmmand object.
     */
    public static function command($sql)
    {
        $connection = RepositoryDatabase::openConnection();

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

        return $connection->prepare($sql, self::Cursor());
    }

    /**
     * Loads database specefic array to a bussines logic object insatnce.
     *
     * @param array $instance    Row of SQL server result set array.
     * @param array $result_item SQL server result set array.
     *
     * @return array Returns array of business object instances.
     */
    protected function loadFromSqlResultSetRow($instance, $result_item = array())
    {
        if (sizeof($result_item) == 0) {
            $this->IsLoaded = false;

            return;
        }

        $class_var_entries = get_class_vars(get_class($instance));

        while ($entry = each($class_var_entries)) {
            $var_name = $entry['key'];

            if ($var_name == 'primaryFiledName') {
                continue;
            }

            $var_value = $entry['value'];

            $this->$var_name = $result_item[$var_name];
        }

        $this->IsLoaded = true;
    }

    /**
     * Saves business object instance to the database. If business object instance primary key is less then zero, new row will be inserted.
     *
     * @return bool Returns true if the SQL statements execution was successful.
     */
    public function save()
    {
        $pre_sql = 'SHOW COLUMNS FROM '.$this->getTableName();

        $command = RepositoryDatabase::openConnection()->prepare($pre_sql);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . \Utilities\Helper::debugPDO($sql, $parameters);  exit();

        $command->execute();

        $pre_res = $command->fetchAll(PDO::FETCH_ASSOC);

        $fields = array();

        foreach ($pre_res as $pre_record) {
            $fields[] = $pre_record['Field'];
        }

        $object_vars = get_object_vars($this);

        unset($object_vars[$this->primaryFiledName]);

        foreach ($object_vars as $k => $v) {
            if (!in_array($k, $fields)) {
                unset($object_vars[$k]);
            }
        }

        if (isset($this->{$this->primaryFiledName}) && $this->{$this->primaryFiledName} >= 0) {
            $update_sql = 'UPDATE '.$this->getTableName().' SET ';

            unset($object_vars[$this->primaryFiledName]);

            foreach ($object_vars as $name => $value) {
                $update_sql .= strtolower($name).'=:param'.$name.', ';
            }

            $update_sql = substr($update_sql, 0, -2);

            $update_sql .= ' WHERE '.strtolower($this->primaryFiledName).'='.$this->{$this->primaryFiledName};

            $command = RepositoryDatabase::openConnection()->prepare($update_sql);

            if (property_exists(get_class($this), 'Modified')) {
                $object_vars['Modified'] = \Utilities\Helper::getUTCNow();
            }

            foreach ($object_vars as $name => $value) {
                if (is_a($value, 'DateTime')) {
                    $command->bindValue(':param'.$name, $value->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
                } else {
                    $command->bindParam(':param'.$name, $value);
                }

                unset($value);
            }
            $res = $command->execute();
        } else {
            if (property_exists(get_class($this), 'Created') && $object_vars['Created'] == null) {
                $object_vars['Created'] = \Utilities\Helper::getUTCNow();
            }

            $insert_sql = 'INSERT INTO '.$this->getTableName();
            $insert_fields = '';
            $insert_params = '';

            foreach ($object_vars as $name => $value) {
                $insert_fields .= $name.', ';
                $insert_params .= ':param'.$name.', ';
            }

            $insert_fields = substr($insert_fields, 0, -2);
            $insert_params = substr($insert_params, 0, -2);

            $insert_sql = $insert_sql.'('.$insert_fields.') VALUES('.$insert_params.')';

            $connection = RepositoryDatabase::openConnection();
            $command = $connection->prepare($insert_sql);

            foreach ($object_vars as $name => $value) {
                if (is_a($value, 'DateTime')) {
                    $command->bindValue(':param'.$name, $value->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
                } else {
                    $command->bindParam(':param'.$name, $value);
                }

                unset($value);
            }

            $res = $command->execute();

            $this->{$this->primaryFiledName} = $connection->lastInsertId();
        }

        return $res;
    }

    /**
     * Deletes business object instance from the database.
     *
     * @return bool Returns true if the SQL statements execution was successful.
     */
    public function delete()
    {
        if (isset($this->primaryFiledName)) {
            if ($this->{$this->primaryFiledName} != null) {
                //////////////////////////////////////////
                // Delete item by primarry key
                //////////////////////////////////////////

                $delete_sql = 'DELETE FROM '.$this->getTableName().
                    ' WHERE '.strtolower($this->primaryFiledName).'='.
                         $this->{$this->primaryFiledName};

                return $command = RepositoryDatabase::openConnection()->query($delete_sql);
            } else {
                //////////////////////////////////////////
                // Delete item by values not primarry key
                //////////////////////////////////////////

                $object_vars = get_object_vars($this);

                unset($object_vars[$this->primaryFiledName]);
                unset($object_vars['primaryFiledName']);

                $delete_field_params = '';

                foreach ($object_vars as $name => $value) {
                    $delete_field_params .= strlen($delete_field_params) > 0 ? ' AND ' : ' ';
                    $delete_field_params .= $name.' = :param'.$name;
                }

                $delete_sql = \Utilities\Helper::format('DELETE FROM {0} WHERE {1} ', $this->getTableName(), $delete_field_params);

                $connection = RepositoryDatabase::openConnection();

                $command = $connection->prepare($delete_sql);

                foreach ($object_vars as $name => $value) {
                    $command->bindParam(':param'.$name, $value);
                    unset($value);
                }

                return true;
            }

            // useful for debugging: you can see the SQL behind above construction by using:
            // echo '[ PDO DEBUG ]: ' . \Utilities\Helper::debugPDO($sql, $parameters);  exit();
        } else {
            return false;
        }
    }
}
