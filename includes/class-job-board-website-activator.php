<?php

/**
 * Fired during plugin activation
 *
 * @link       https://N/A
 * @since      1.0.0
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/includes
 * @author     Michaelangelo Mamaclay <mamaclaymichael20@gmail.com>
 */
class Job_Board_Website_Activator
{
	/**
	 * Method to execute when the plugin is activated.
	 *
	 * @since 1.0.0
     * @return void
	 */
	public static function activate(): void
    {
        self::setupTables();
	}

    /**
     * Set up the tables needed by the plugin.
     *
     * @return void
     */
    protected static function setupTables(): void
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $tables = [
            self::settings_table(),
        ];

        foreach ($tables as $table) {
            $name = $table[0];
            $columns = $table[1];

            $sql = sprintf(
                "CREATE TABLE %s (%s) %s;",
                $name,
                $columns,
                $charset_collate
            );
            dbDelta( $sql );
        }
    }

    /**
     * Set up the table columns.
     *
     * @return array<string>
     */
    protected static function settings_table(): array
    {
        return [
            JBW_TABLE_SETTINGS,
            '`id` MEDIUMINT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `_token` VARCHAR(255) NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)'
        ];
    }
}
