<?php

/**
 * Fired during plugin uninstall
 *
 * @link       https://N/A
 * @since      1.0.0
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/includes
 */

/**
 * Fired during plugin uninstall.
 *
 * This class defines all code necessary to run during the plugin's uninstall.
 *
 * @since      1.0.0
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/includes
 * @author     Michaelangelo Mamaclay <mamaclaymichael20@gmail.com>
 */
class Job_Board_Website_Uninstaller
{
    /**
     * Method to execute when the plugin is uninstalled.
     *
     * @since 1.0.0
     * @return void
     */
    public static function uninstall(): void
    {
        self::dropTables();
    }

    /**
     * Drop plugin tables.
     *
     * @return void
     */
    protected static function dropTables(): void
    {
        global $wpdb;

        $tables = [
            JBW_TABLE_SETTINGS
        ];

        foreach ($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS {$table}");
        }
    }
}
