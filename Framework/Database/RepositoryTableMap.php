<?php

namespace Database;

/**
 * Represents the mapping between entity and data storage table name.
 */
class RepositoryTableMap
{
    /**
     * Represents mapping between entity and data storage table name.
     *
     * @var array
     */
    private static $entityTable = null;

    /**
     * Gets mapping between entity and data storage table name.
     *
     * @return stdClass Returns mapping between entity and data storage table name.
     */
    public static function getEntityTables()
    {
        if (self::$entityTable == null) {
            self::$entityTable = array(
                //'Comment' => 'Comments',
                'Comment' => 'Comments',
                'PageID' => 'PagesID',
                'Like' => 'Likes',
                'Report' => 'Reports',
                'AuxUser' => 'AuxUsers',
                'Domain' => 'Domains',
                'Configuration' => 'Configurations',
                'AuditEvent' => 'AuditEvents',
                'AuditEventSource' => 'AuditEventSources',
                'AuditEventType' => 'AuditEventTypes',
            );
        }

        return (object) self::$entityTable;
    }
}
