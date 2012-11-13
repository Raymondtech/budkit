<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * storage.php
 *
 * Requires PHP version 5.3
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 *
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 * 
 */

namespace Application\Setup\Models;

use Platform;
use Library;

/**
 * What is the purpose of this class, in one sentence?
 *
 * How does this class achieve the desired purpose?
 *
 * @category   Model
 * @author     Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * @copyright  1997-2012 Stonyhills HQ
 * @license    http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version    Release: 1.0.0
 * @link       http://stonyhillshq/documents/index/carbon4/utilities/application
 * @since      Class available since Release 1.0.0 Jan 14, 2012 4:54:37 PM
 */
final class Schema extends Platform\Model {

    /**
     * An instance of the schema model object
     * @var type 
     */
    static $instance;

    /**
     * The database object
     * @var type 
     */
    static $database;

    /**
     * This model has no data to display
     * @return boolean
     */
    public function display() {
        return false;
    }

    /**
     * Creates the authority table
     * 
     */
    private static function createAuthorityTable() {

        //Drop the authority table if exists, create if doesn't
        static::$database->query("DROP TABLE IF EXISTS `?authority`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?authority` (
                `authority_id` bigint(20) NOT NULL AUTO_INCREMENT,
                `authority_title` varchar(100) NOT NULL,
                `authority_parent_id` bigint(20) NOT NULL,
                `authority_name` varchar(45) NOT NULL COMMENT '	',
                `authority_description` varchar(255) DEFAULT NULL,
                `lft` int(11) NOT NULL,
                `rgt` int(11) NOT NULL,
                PRIMARY KEY (`authority_id`),
                UNIQUE KEY `authority_name_UNIQUE` (`authority_name`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;"
        );
        //Dumping data for table authority?
        static::$database->query(
                "INSERT INTO `?authority` (`authority_id`, `authority_title`, `authority_parent_id`, `authority_name`, `authority_description`, `lft`, `rgt`) VALUES
            (1, 'PUBLIC', 0, 'PUBLIC', 'All unregistered nodes, users and applications', 1, 8),
            (2, 'Registered Users', 1, 'REGISTEREDUSERS', 'All registered nodes with a known unique identifier', 2, 7),
            (3, 'Moderators', 2, 'MODERATORS', 'System moderators, Users allowed to manage user generated import', 3, 6),
            (4, 'Super Administrators', 3, 'MASTERADMINISTRATORS', 'Special users with awesome powers', 4, 5);"
        );
    }

    private static function createAuthorityPermissionsTable() {

        //Drop the authority table if exists, create if doesn't
        static::$database->query("DROP TABLE IF EXISTS `?authority_permissions`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?authority_permissions` (
                `authority_permission_key` bigint(20) NOT NULL AUTO_INCREMENT,
                `authority_id` bigint(20) NOT NULL,
                `permission_area_uri` varchar(255) NOT NULL,
                `permission` varchar(45) NOT NULL DEFAULT '1',
                `permission_type` varchar(45) NOT NULL,
                `permission_title` varchar(45) NOT NULL,
                PRIMARY KEY (`authority_permission_key`),
                UNIQUE KEY `UNIQUE` (`permission_area_uri`,`permission_type`,`authority_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
        //Dumping default permission data to authority_permission tablegit
        static::$database->query(
                "INSERT INTO `?authority_permissions` (`authority_permission_key`, `authority_id`, `permission_area_uri`, `permission`, `permission_type`, `permission_title`) VALUES
            (1, 4, '/system/admin(/[a-z0-9-]*)*', 'allow', 'special', 'Admin Panel'),
            (2, 1, '/member/session(/[a-z0-9-]*)*', 'allow', 'execute', 'Site Login'),
            (3, 1, '/member/account(/[a-z0-9-]*)*', 'allow', 'execute', 'Site Signup'),
            (4, 2, '/system/activity(/[a-z0-9-]*)*', 'allow', 'execute', 'Update Status'),
            (5, 2, '/content(/[a-z0-9-]*)*', 'allow', 'execute', 'View Content'),
            (6, 1, '/setup/install(/[a-z0-9-]*)*', 'allow', 'execute', 'Setup Installer'),
            (7, 2, '/system/start(/[a-z0-9-]*)*', 'allow', 'view', 'Start Pages'),
            (8, 2, '/member(/[a-z0-9-]*)*', 'allow', 'view', 'Read User Profiles');"
        );
    }

    private static function createMenutable() {

        //Drop the menu table if it already exists;
        static::$database->query("DROP TABLE IF EXISTS `?menu`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?menu` (
                `menu_id` int(11) NOT NULL AUTO_INCREMENT,
                `menu_parent_id` int(11) NOT NULL DEFAULT '0',
                `menu_title` varchar(45) NOT NULL,
                `menu_url` varchar(100) NOT NULL,
                `menu_classes` varchar(45) DEFAULT NULL,
                `menu_order` int(11) NOT NULL DEFAULT '0',
                `menu_group_id` int(11) NOT NULL,
                `menu_type` varchar(45) NOT NULL DEFAULT 'link',
                `menu_callback` varchar(255) DEFAULT NULL,
                `lft` int(11) NOT NULL,
                `rgt` int(11) NOT NULL,
                `menu_iscore` TINYINT(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`menu_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;
            "
        );
        //Default menu data input;
        static::$database->query(
                "INSERT INTO `?menu` (`menu_id`, `menu_parent_id`, `menu_title`, `menu_url`, `menu_classes`, `menu_order`, `menu_group_id`, `menu_type`, `menu_callback`, `lft`, `rgt`, `menu_iscore`) VALUES
                (1, 0, 'Dashboard', '/system/admin/index', ' ', 1, 1, 'link', NULL, 1, 2, 1),
                (2, 0, 'Site Content', '/system/admin/content/lists', '', 2, 1, 'link', NULL, 3, 12, 1),
                (3, 2, 'All Content', '/system/admin/content/lists/', ' ', 3, 1, 'link', NULL, 4, 11, 1),
                (4, 2, 'Media Manager', '/system/admin/content/media', ' ', 4, 1, 'link', NULL, 5, 10, 1),
                (5, 2, 'Categories Manager', '/system/admin/content/categories', ' ', 5, 1, 'link', NULL, 6, 9, 1),
                (6, 2, '%{ext:contentlist}', '/system/admin/content/lists/:application', ' ', 6, 1, 'method', 'lookup', 7, 8, 1),
                (7, 0, 'Your Network', '/system/admin/network/index', '', 7, 1, 'link', '', 13, 24, 1),
                (8, 7, 'Members', '/system/admin/network/members/lists', '', 8, 1, 'link', '', 14, 23, 1),
                (9, 7, 'Permissions', '/system/admin/network/authorities', '', 9, 1, 'link', '', 15, 22, 1),
                (10, 7, 'Relationships', '/system/admin/network/relationships', '', 10, 1, 'link', '', 16, 21, 1),
                (11, 7, 'Analytics', '/system/admin/network/analytics', '', 11, 1, 'link', '', 17, 20, 1),
                (12, 7, '%{ext:network}', '/system/admin/network', '', 12, 1, 'method', 'lookup', 18, 19, 1),
                (13, 0, 'Platform', '/system/admin/manage', NULL, 13, 1, 'link', '', 25, 36, 1),
                (14, 13, 'Multisite', '/system/admin/manage/sites', '', 14, 1, 'link', '', 26, 35, 1),
                (15, 13, 'Groups', '/system/admin/manage/groups', '', 15, 1, 'link', '', 27, 34, 1),
                (16, 13, 'Custom Types', '/system/admin/manage/fields', '', 16, 1, 'link', '', 28, 33, 1),
                (17, 13, 'Messaging', '/system/admin/manage/emails', '', 17, 1, 'link', '', 29, 32, 1),
                (18, 13, '%{ext:extensionlist}', '/system/admin/manage/:extensions', '', 18, 1, 'method', 'lookup', 30, 31, 1),
                (19, 0, 'Settings', '/system/admin/settings/configuration', '', 19, 1, 'link', '', 37, 48, 1),
                (20, 19, 'Configuration', '/system/admin/settings/configuration', '', 20, 1, 'link', '', 38, 47, 1),
                (21, 19, 'Appearance', '/system/admin/settings/appearance', '', 21, 1, 'link', '', 39, 46, 1),
                (22, 19, 'Maintenance', '/system/admin/settings/maintenance', '', 22, 1, 'link', '', 40, 45, 1),
                (23, 19, 'Navigation', '/system/admin/settings/navigation', '', 23, 1, 'link', '', 41, 44, 1),
                (24, 19, '%{ext:settings}', '/system/admin/settings/:application', '', 24, 1, 'method', 'lookup', 42, 43, 1),
                (25, 0, 'Extensions', '/system/admin/extensions/index', '', 25, 1, 'link', '', 49, 56, 1),
                (26, 25, 'Installed', '/system/admin/extensions/installed', '', 26, 1, 'link', '', 50, 55, 1),
                (27, 25, 'Repositories', '/system/admin/extensions/repositories', '', 27, 1, 'link', '', 51, 54, 1),
                (28, 25, 'Editor', '/system/admin/extensions/editor', '', 28, 1, 'link', '', 52, 53, 1),
                (29, 0, 'Applications', '/system/admin/applications/index', '', 29, 1, 'link', '', 56, 65, 1),
                (30, 29, 'System', '/system/admin/application/master', '', 30, 1, 'link', '', 57, 64, 1),
                (52, 29, 'Pages', '/system/admin/application/pages', '', 30, 1, 'link', '', 58, 63, 1),
                (53, 29, 'Campus', '/system/admin/application/campus', '', 30, 1, 'link', '', 59, 62, 1),
                (31, 29, '%{ext:applications}', '/system/admin/applications/', '', 31, 1, 'method', 'lookup', 60, 61, 1),
                (32, 0, 'Account Information', '/member/settings/account', '', 0, 2, 'link', NULL, 1, 2, 1),
                (33, 0, 'Profile Data', '/member/settings/profile', NULL, 0, 2, 'link', NULL, 3, 4, 1),
                (36, 0, 'Notifications', '/member/settings/notifications', NULL, 0, 2, 'link', NULL, 5, 6, 1),
                (37, 0, 'Privacy', '/member/settings/privacy', NULL, 0, 2, 'link', NULL, 7, 8, 1),
                (38, 0, 'Activity', '/member/profile/display/activity', NULL, 0, 5, 'link', NULL, 1, 2, 0),
                (39, 0, 'About Me', '/member/profile/display/information', NULL, 0, 5, 'link', NULL, 3, 4, 0),
                (40, 0, 'Achievements', '/member/profile/display/achievements', NULL, 0, 5, 'link', NULL, 5, 6, 0),
                (41, 0, 'Network', '/member/profile/display/network', NULL, 0, 5, 'link', NULL, 9, 10, 0),
                (42, 0, 'Dashboard', '/system/start/index', NULL, 0, 3, 'link', NULL, 1, 2, 1),
                (43, 0, 'Activity', '/system/start/dashboard/activity', NULL, 0, 3, 'link', NULL, 3, 4, 1),
                (44, 0, 'Content', '/system/start/dashboard/content', NULL, 0, 3, 'link', NULL, 5, 6, 1),
                (45, 0, 'Notifications', '/system/start/dashboard/notifications', NULL, 0, 3, 'link', NULL, 7, 8, 1),
                (46, 0, 'Analytics & Trends', '/system/start/dashboard/analytics', NULL, 0, 3, 'link', NULL, 9, 10, 1),
                (47, 0, 'Inbox', '/member/messages/inbox', NULL, 0, 4, 'link', NULL, 1, 2, 1),
                (48, 0, 'Sent Messages', '/member/messages/sent', NULL, 0, 4, 'link', NULL, 3, 4, 1),
                (49, 0, 'Live Chat', '/member/messages/live', NULL, 0, 4, 'link', NULL, 5, 6, 1),
                (50, 0, 'Deleted Messages', '/member/messages/trash', NULL, 0, 4, 'link', NULL, 7, 8, 1),
                (51, 0, 'Drafts', '/member/messages/drafts', NULL, 0, 4, 'link', NULL, 9, 10, 1);"
        );
    }

    private static function createMenuGroupTable() {

        static::$database->query("DROP TABLE IF EXISTS `?menu_group`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?menu_group` (
                `menu_group_id` int(11) NOT NULL AUTO_INCREMENT,
                `menu_group_title` varchar(45) NOT NULL,
                `menu_group_order` int(11) NOT NULL DEFAULT '0',
                `menu_group_uid` varchar(45) NOT NULL,
                `menu_group_iscore` TINYINT(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`menu_group_id`),
                UNIQUE KEY `menu_group_id_UNIQUE` (`menu_group_id`),
                UNIQUE KEY `menu_group_uid_UNIQUE` (`menu_group_uid`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
        ");
        static::$database->query(
                "INSERT INTO `?menu_group` (`menu_group_id`, `menu_group_title`, `menu_group_order`, `menu_group_uid`, `menu_group_iscore`) VALUES
            (1, 'AdminPanel Menu', 1, 'adminmenu', 1),
            (2, 'Settings Menu', 2, 'settingsmenu', 1),
            (3, 'Dashboard Menu', 0, 'dashboardmenu', 1),
            (4, 'Messages menu', 0, 'messagesmenu', 1),
            (5, 'Profile menu', 0, 'profilemenu', 1);"
        );
    }

    private static function createOptionsTable() {
        static::$database->query("DROP TABLE IF EXISTS `?options`");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?options` (
                `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `option_group_id` varchar(64) NOT NULL DEFAULT  '',
                `option_name` varchar(64) NOT NULL DEFAULT '',
                `option_value` longtext NOT NULL,
                `option_autoload` varchar(20) NOT NULL DEFAULT 'yes',
                PRIMARY KEY (`option_id`),
                UNIQUE KEY `option_name` (`option_name`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    private static function createContentmetaTable() {
        static::$database->query("DROP TABLE IF EXISTS `?contentmeta`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?contentmeta` (
                `contentmeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `contentmeta_content_id` bigint(20) unsigned NOT NULL DEFAULT '0',
                `contentmeta_key` varchar(255) DEFAULT NULL,
                `contentmeta_value` longtext,
                PRIMARY KEY (`contentmeta_id`),
                KEY `content_id` (`contentmeta_content_id`),
                KEY `meta_key` (`contentmeta_key`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    private static function createContentsTable() {
        static::$database->query("DROP TABLE IF EXISTS `?contents`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?contents` (
                `content_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `content_author` bigint(20) unsigned NOT NULL DEFAULT '0',
                `content_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `content_date_gmt` datetime NOT NULL,
                `content_body` longtext NOT NULL,
                `content_title` text NOT NULL,
                `content_excerpt` text NOT NULL,
                `content_status` varchar(20) NOT NULL DEFAULT 'publish',
                `content_comment_status` varchar(20) NOT NULL DEFAULT 'open',
                `content_ping_status` varchar(20) NOT NULL DEFAULT 'open',
                `content_password` varchar(20) NOT NULL DEFAULT '',
                `content_name` varchar(200) NOT NULL DEFAULT '',
                `content_to_ping` text NOT NULL,
                `content_pinged` text NOT NULL,
                `content_modified` datetime NOT NULL,
                `content_modified_gmt` datetime NOT NULL,
                `content_body_filtered` text NOT NULL,
                `content_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
                `content_guid` varchar(255) NOT NULL DEFAULT '',
                `content_menu_order` int(11) NOT NULL DEFAULT '0',
                `content_type` varchar(20) NOT NULL DEFAULT 'article',
                `content_mime_type` varchar(100) NOT NULL DEFAULT '',
                `content_comment_count` bigint(20) NOT NULL DEFAULT '0',
                PRIMARY KEY (`content_id`),
                KEY `content_name` (`content_name`),
                KEY `type_status_date` (`content_type`,`content_status`,`content_date`,`content_id`),
                KEY `content_parent` (`content_parent`),
                KEY `content_author` (`content_author`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    private static function createSessionTable() {
        static::$database->query("DROP TABLE IF EXISTS `?session`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?session` (
                `session_id` bigint(20) NOT NULL AUTO_INCREMENT,
                `session_token` varchar(150) NOT NULL,
                `session_host` varchar(80) NOT NULL,
                `session_ip` varchar(45) NOT NULL,
                `session_agent` text NOT NULL,
                `session_expires` int(11) NOT NULL,
                `session_lastactive` int(11) NOT NULL,
                `session_registry` text NOT NULL,
                `session_key` varchar(100) NOT NULL,
                PRIMARY KEY (`session_id`),
                UNIQUE KEY `session_key_UNIQUE` (`session_key`),
                UNIQUE KEY `session_token_UNIQUE` (`session_token`),
                UNIQUE KEY `session_key_token` (`session_token`,`session_key`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    private static function createUsermetaTable() {
        static::$database->query("DROP TABLE IF EXISTS `?usermeta`");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?usermeta` (
                `usermeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `usermeta_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
                `usermeta_key` varchar(255) DEFAULT NULL,
                `usermeta_value` longtext,
                PRIMARY KEY (`usermeta_id`),
                KEY `user_id` (`usermeta_user_id`),
                KEY `meta_key` (`usermeta_key`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    private static function createUsersTable() {

        static::$database->query("DROP TABLE IF EXISTS `?users`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?users` (
                `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                `user_name_id` varchar(60) NOT NULL DEFAULT '',
                `user_name` varchar(250) NOT NULL DEFAULT '',
                `user_password` varchar(255) NOT NULL,
                `user_email` varchar(100) NOT NULL DEFAULT '',
                `user_url` varchar(100) NOT NULL DEFAULT '',
                `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `user_key` varchar(60) NOT NULL DEFAULT '',
                `user_status` int(11) NOT NULL DEFAULT '0',
                PRIMARY KEY (`user_id`),
                UNIQUE KEY `user_unique` (`user_name_id`,`user_email`),
                UNIQUE KEY `user_email_unique` (`user_email`),
                UNIQUE KEY `user_name_unique` (`user_name_id`),
                KEY `user_login_key` (`user_name_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;"
        );
    }

    private static function createObjectsAuthorityTable() {
        static::$database->query("DROP TABLE IF EXISTS `?objects_authority`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?objects_authority` (
                `object_authority_id` int(11) NOT NULL AUTO_INCREMENT,
                `authority_id` bigint(20) NOT NULL,
                `object_id` varchar(45) NOT NULL,
                PRIMARY KEY (`object_authority_id`),
                UNIQUE KEY `object_authority` (`authority_id`,`object_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    private static function createObjectsTable() {

        static::$database->query("DROP TABLE IF EXISTS `?objects`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?objects` (
                `object_id` int(11) NOT NULL AUTO_INCREMENT,
                `object_type` varchar(55) NOT NULL DEFAULT 'entity',
                `object_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                `object_uri` varchar(20) NOT NULL,
                `object_status` enum('disabled','active') DEFAULT 'active',
                PRIMARY KEY (`object_id`),
                UNIQUE KEY `object_uri` (`object_uri`),
                KEY `object_id_idx` (`object_id`),
                KEY `object_uri_idx` (`object_uri`)
              ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;"
        );
    }

    private static function createPropertiesTable() {
        static::$database->query("DROP TABLE IF EXISTS `?properties`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?properties` (
                `property_id` int(11) NOT NULL AUTO_INCREMENT,
                `property_parent` int(11) DEFAULT NULL,
                `property_name` varchar(90) NOT NULL,
                `property_label` text,
                `property_datatype` varchar(50) NOT NULL DEFAULT 'varchar',
                `property_charsize` int(11) DEFAULT NULL,
                `property_default` varchar(255) DEFAULT NULL,
                `property_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                `property_indexed` tinyint(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`property_id`),
                UNIQUE KEY `property_name` (`property_name`),
                KEY `property_datatype_idxfk` (`property_datatype`)
              ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;"
        );
    }

    private static function createPropertyDatatypeTable() {
        static::$database->query("DROP TABLE IF EXISTS `?property_datatypes`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?property_datatypes` (
                `datatype_id` int(11) NOT NULL AUTO_INCREMENT,
                `datatype_name` varchar(50) DEFAULT NULL,
                `datatype_is_numeric` tinyint(4) DEFAULT '0',
                `datatype_is_datetime` tinyint(4) DEFAULT '0',
                `datatype_not_null` tinyint(4) DEFAULT '0',
                `datatype_validation` varchar(255) DEFAULT NULL,
                `datatype_enum` varchar(255) DEFAULT NULL COMMENT 'Lookup Fields',
                PRIMARY KEY (`datatype_id`),
                UNIQUE KEY `datatype_name` (`datatype_name`)
              ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;"
        );
    }

    private static function insertPropertyDatatypes() {
        static::$database->query(
                "INSERT INTO `?property_datatypes` (`datatype_id`, `datatype_name`, `datatype_is_numeric`, `datatype_is_datetime`, `datatype_not_null`, `datatype_validation`) VALUES
                    (1, 'char', 0, 0, 0, NULL),
                    (2, 'varchar', 0, 0, 0, NULL),
                    (3, 'tinytext', 0, 0, 0, NULL),
                    (4, 'text', 0, 0, 0, NULL),
                    (5, 'mediumtext', 0, 0, 0, NULL),
                    (6, 'longtext', 0, 0, 0, NULL),
                    (7, 'blob', 0, 0, 0, NULL),
                    (8, 'mediumblob', 0, 0, 0, NULL),
                    (9, 'longblob', 0, 0, 0, NULL),
                    (10, 'tinyint', 1, 0, 0, NULL),
                    (11, 'smallint', 1, 0, 0, NULL),
                    (12, 'mediumint', 1, 0, 0, NULL),
                    (13, 'int', 1, 0, 0, NULL),
                    (14, 'bigint', 1, 0, 0, NULL),
                    (15, 'float', 1, 0, 0, NULL),
                    (16, 'double', 1, 0, 0, NULL),
                    (17, 'decimal', 1, 0, 0, NULL),
                    (18, 'time', 0, 0, 0, NULL),
                    (19, 'timestamp', 0, 0, 0, NULL),
                    (20, 'enum', 0, 0, 0, NULL),
                    (21, 'datetime', 0, 0, 0, NULL),
                    (22, 'date', 0, 0, 0, NULL);"
        );
    }

    public static function createPropertyValuesProxyTable($tableName) {

        if( strtolower($tableName) === static::$database->replacePrefix("?property_values")):
        
            static::$database->query(
                "CREATE TABLE IF NOT EXISTS `{$tableName}` (
                   `value_id` mediumint(11) NOT NULL AUTO_INCREMENT,
                   `value_data` text NOT NULL,
                   `value_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                   `property_id` int(11) NOT NULL,
                   `object_id` int(11) NOT NULL,
                   PRIMARY KEY (`value_id`),
                   UNIQUE KEY `object_property_uid` (`object_id`,`property_id`),
                   KEY `property_id_idxfk` (`property_id`),
                   KEY `object_id_idxfk` (`object_id`)
                 ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;"
            );

            static::$database->query("DROP TRIGGER IF EXISTS `{$tableName}_validate_insert`;");
            static::$database->query(
                    "CREATE TRIGGER `{$tableName}_validate_insert` BEFORE INSERT ON `?property_values`
                    FOR EACH ROW
                    BEGIN
                        CALL ?property_value_validate(NEW.property_id, NEW.value_data);
                    END;"
            );

            static::$database->query("DROP TRIGGER IF EXISTS `{$tableName}_validate_update`;");
            static::$database->query(
                    "CREATE TRIGGER `{$tableName}_validate_update` BEFORE UPDATE ON `?property_values`
                    FOR EACH ROW
                    BEGIN
                        CALL ?property_value_validate(NEW.property_id, NEW.value_data);
                    END;"
            );
        endif;
    }

    private static function createPropertyValuesTable() {
        static::$database->query("DROP TABLE IF EXISTS `?property_values`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?property_values` (
                    `value_id` mediumint(11) NOT NULL AUTO_INCREMENT,
                    `value_data` text NOT NULL,
                    `value_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `property_id` int(11) NOT NULL,
                    `object_id` int(11) NOT NULL,
                    PRIMARY KEY (`value_id`),
                    UNIQUE KEY `object_property_uid` (`object_id`,`property_id`),
                    KEY `property_id_idxfk` (`property_id`),
                    KEY `object_id_idxfk` (`object_id`)
                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;"
        );
        static::$database->query("DROP PROCEDURE IF EXISTS `property_value_validate`;");
        static::$database->query(
                "CREATE PROCEDURE `?property_value_validate`(IN _property_id INT, IN _value_data LONGTEXT) 
                BEGIN 
                    DECLARE _validationFails CONDITION FOR SQLSTATE '99001';
                    DECLARE _dataTypeRegExp VARCHAR(255); 
                    DECLARE _signalText TEXT;
                    SELECT r.datatype_validation  FROM `?properties` AS d INNER JOIN `?property_datatypes` AS r WHERE `property_id`= _property_id AND d.property_datatype=r.datatype_name INTO _dataTypeRegExp;
                    IF (_dataTypeRegExp IS NOT NULL) THEN
                            IF (_value_data NOT REGEXP(_dataTypeRegExp)) THEN
                            	SET _signalText = CONCAT('The inserted/updated value fails the property data type validation');
                                SIGNAL _validationFails SET MESSAGE_TEXT=_signalText; 
                            END IF;
                    END IF;
                END;"
        );

        static::$database->query("DROP TRIGGER IF EXISTS `?property_value_validate_insert`;");
        static::$database->query(
                "CREATE TRIGGER `?property_value_validate_insert` BEFORE INSERT ON `?property_values`
                FOR EACH ROW
                BEGIN
                    CALL ?property_value_validate(NEW.property_id, NEW.value_data);
                END;"
        );

        static::$database->query("DROP TRIGGER IF EXISTS `?property_value_validate_update`;");
        static::$database->query(
                "CREATE TRIGGER `?property_value_validate_update` BEFORE UPDATE ON `?property_values`
                FOR EACH ROW
                BEGIN
                    CALL ?property_value_validate(NEW.property_id, NEW.value_data);
                END;"
        );
    }

    private static function createUsersView() {
        static::$database->query(
                "CREATE OR REPLACE VIEW `?users_` AS
                SELECT
                    o.object_id,
                    o.object_uri,
                    MAX(IF(p.property_name = 'first_name', v.value_data, null)) AS first_name,
                    MAX(IF(p.property_name = 'middle_name', v.value_data, null)) AS middle_name,
                    MAX(IF(p.property_name = 'last_name', v.value_data, null)) AS last_name,
                    MAX(IF(p.property_name = 'password', v.value_data, null)) AS password,
                    MAX(IF(p.property_name = 'api_key', v.value_data, null)) AS api_key,
                    MAX(IF(p.property_name = 'email', v.value_data, null)) AS email
                FROM ?property_values v
                LEFT JOIN ?properties p ON p.property_id = v.property_id
                LEFT JOIN ?objects o ON o.object_id=v.object_id
                WHERE o.object_type='user' GROUP BY o.object_id"
        );
    }

    private static function createIndices() {

        static::$database->query("ALTER TABLE `?properties` ADD CONSTRAINT `properties_ibfk_` FOREIGN KEY (`property_datatype`) REFERENCES `?property_datatypes` (`datatype_name`);");
        static::$database->query(
                "ALTER TABLE `?property_values`
                    ADD CONSTRAINT `property_values_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `?objects` (`object_id`),
                    ADD CONSTRAINT `property_values_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `?properties` (`property_id`) ON DELETE CASCADE;"
        );
    }

    private static function addDefaultData() {
        
    }

    public static function createTables() {

        static::createAuthorityTable();
        static::createAuthorityPermissionsTable();

        static::createMenutable();
        static::createMenuGroupTable();
        static::createOptionsTable();
        //static::createContentmetaTable();
        //static::createContentsTable();
        static::createSessionTable();

        static::createObjectsTable();
        static::createObjectsAuthorityTable();
        static::createPropertiesTable();
        static::createPropertyDatatypeTable();
        static::createPropertyValuesTable();
        static::createIndices();
        static::insertPropertyDatatypes();

        //static::createUsermetaTable();
        //static::createUsersTable();
        //static::createUsersView();
        static::addDefaultData();

        if (!static::$database->commitTransaction()) {
            static::setError(static::$database->getError());
            return false;
        }

        return true;
    }

    public static function getInstance() {

        //If the class was already instantiated, just return it
        if (isset(static::$instance))
            return static::$instance;

        static::$instance = new self;
        static::$database = Library\Database::getInstance(Library\Config::getParamSection("database"), TRUE);

        //Begin trnasation
        static::$database->startTransaction();


        return static::$instance;
    }

}

