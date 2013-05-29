<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * schema.php
 *
 * Requires PHP version 5.4
 *
 * LICENSE: This source file is subject to version 3.01 of the GNU/GPL License 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.txt  If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 * send a note to support@stonyhillshq.com so we can mail you a copy immediately.
 * 
 */

namespace Application\Setup\Models;

use Platform;
use Library;

/**
 * Generates and performs the database installation transaction
 *
 * @category  Application
 * @package   Data Model
 * @license   http://www.gnu.org/licenses/gpl.txt.  GNU GPL License 3.01
 * @version   1.0.0
 * @since     Jan 14, 2012 4:54:37 PM
 * @author    Livingstone Fultang <livingstone.fultang@stonyhillshq.com>
 * 
 */
final class Schema extends Platform\Model {

    /**
     * An instance of the schema model object
     * @var object 
     */
    static $instance;

    /**
     * The database object
     * @var object 
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
     * @return void
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

    /**
     * Used mainly to contain user defined groups. A basis of privacy
     * @Return false;
     */
    private static function createGroupsTable() {
        static::$database->query("DROP TABLE IF EXISTS `?groups`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?groups` (
                `group_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
                `group_name` VARCHAR(45) NOT NULL ,
                `group_title` VARCHAR(45) NOT NULL ,
                `group_description` VARCHAR(100) NULL ,
                `group_owner` VARCHAR(20) NOT NULL ,
                `group_parent_id` INT NOT NULL ,
                `group_lft` INT NOT NULL DEFAULT 0 ,
                `group_rgt` INT NOT NULL DEFAULT 0 ,
                PRIMARY KEY (`group_id`) ,
                INDEX `group_owner_uri` (`group_owner` ASC) 
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;"
        );
    }

    /**
     * Creates the authority permission table
     * @return void
     */
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
            (1, 4, '^/settings/system(/[a-z0-9-]*)*', 'allow', 'special', 'System Settings'),
            (2, 1, '^/system/authenticate(/[a-z0-9-]*)*', 'allow', 'execute', 'Site Login'),
            (5, 2, '^/system/media([s]*/[a-z0-9-]*)*', 'allow', 'execute', 'View Content'),
            (6, 1, '^/setup/install(/[a-z0-9-]*)*', 'allow', 'execute', 'Setup Installer'),
            (7, 2, '^/system/start(/[a-z0-9-]*)*', 'allow', 'view', 'Start Pages'),
            (8, 2, '^/system/upload([s]*/[a-z0-9-]*)*', 'allow', 'execute', 'System Uploads'),
            (9, 1, '^/system/search(/[a-z0-9-]*)*', 'allow', 'execute', 'System Search'),
            (10, 2, '^/system/message([s]*/[a-z0-9-]*)*', 'allow', 'execute', 'System Messages'),
            (11, 2, '^/member(/[a-z0-9-]*)*', 'allow', 'execute', 'Execute Member actions'),
            (12, 1, '^/system/object([s]*/[a-z0-9-]*)*', 'allow', 'view', 'System Objects'),
            (13, 2, '^/settings/member(/[a-z0-9-]*)*', 'allow', 'execute', 'Member Settings'),
            (14, 2, '^/system/appointment([s]*/[a-z0-9-]*)*', 'allow', 'execute', 'Appointments'),
            (15, 2, '^/system/notification([s]*/[a-z0-9-]*)*', 'allow', 'execute', 'Notifications'),
            (16, 2, '^/system/extension([s]*/[a-z0-9-]*)*', 'allow', 'execute', 'Extensions');"
        );
    }

    /**
     * Creates the menu table
     * @return void
     */
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
                (48, 0, 'Messages', '', NULL, 0, 4, 'link', NULL, 1, 4, 1),
                (49, 48, 'Chat', '/system/messages/chat', NULL, 0, 4, 'link', NULL, 2, 3, 1),
                (55, 0, 'Start Here', '', NULL, 0, 3, 'link', NULL, 1, 6, 1),
                (56, 55, 'Dashboard', '/system/start/dashboard', NULL, 0, 3, 'link', NULL, 2, 5, 1),
                (58, 55, 'Notifications', '/system/notifications/list', NULL, 0, 3, 'link', NULL, 3, 4, 1),
                (72, 0, 'Personal', '', NULL, 0, 2, 'link', NULL, 1, 12, 1),
                (73, 72, 'Account', '/settings/member/account', '', 0, 2, 'link', NULL, 2, 11, 1),
                (74, 72, 'Profile', '/settings/member/profile', NULL, 0, 2, 'link', NULL, 3, 10, 1),
                (75, 72, 'Notifications', '/settings/member/notifications', NULL, 0, 2, 'link', NULL, 9, 7, 1),
                (76, 72, 'Privacy', '/settings/member/privacy', NULL, 0, 2, 'link', NULL, 5, 8, 1),
                (98, 72, 'Appearance', '/settings/member/appearance', NULL, 0, 2, 'link', NULL, 6, 7, 1),
                (77, 0, 'Access Control', '', NULL, 0, 2, 'link', NULL, 1, 10, 1),
                (78, 77, 'Permissions', '/settings/system/permissions', '', 9, 2, 'link', '', 2, 9, 1),
                (79, 0, 'System', '', '', 19, 2, 'link', '', 1, 16, 1),
                (80, 79, 'Configuration', '/settings/system/configuration', '', 20, 2, 'link', '', 2, 15, 1),
                (34, 79, 'Sever', '/settings/system/server', '', 20, 2, 'link', '', 3, 14, 1),
                (33, 79, 'Input', '/settings/system/input', '', 20, 2, 'link', '', 4, 13, 1),
                (32, 79, 'Localization', '/settings/system/localization', '', 20, 2, 'link', '', 5,12, 1),
                (30, 79, 'Emails', '/settings/system/emails', '', 20, 2, 'link', '', 7, 10, 1),
                (25, 79, 'Maintenance', '/settings/system/maintenance', '', 20, 2, 'link', '', 8, 9, 1),
                (84, 0, 'Content Types', '', '', 19, 1, 'link', '', 1, 13, 1),
                (85, 84, 'Photos', '/system/media/photo/gallery', NULL, 0, 1, 'link', NULL, 3, 12, 1),
                (86, 84, 'Audio', '/system/media/audio/gallery', NULL, 0, 1, 'link', NULL, 4, 11, 1),
                (87, 84, 'Videos', '/system/media/video/gallery', NULL, 0, 1, 'link', NULL, 5, 10, 1),
                (88, 84, 'Text', '/system/media/text/gallery', '', 23, 1, 'link', '', 6, 9, 1),
                (89, 84, 'Other', '/system/media/rich/gallery', '', 24, 1, 'link', '', 6, 8, 1),
                (90, 0, 'Network', '', NULL, 0, 6, 'link', NULL, 1, 12, 1);"
        );
    }

    /**
     * Creates the menu group table
     * @return void
     */
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
            (1, 'Media Menu', 1, 'mediamenu', 1),
            (2, 'Settings Menu', 2, 'settingsmenu', 1),
            (3, 'Dashboard Menu', 3, 'dashboardmenu', 1),
            (4, 'Messages menu', 4, 'messagesmenu', 1),
            (5, 'Profile menu', 5, 'profilemenu', 1),
            (6, 'People menu', 6, 'peoplemenu', 1);"
        );
    }

    /**
     * Creates the options table
     * @return void
     */
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

    /**
     * Creates the content MetaTable
     * @deprecated 21/02/2012 v1.0.0 
     * @return void
     */
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

    /**
     * Creates the content table
     * @deprecated 21/02/2012 v1.0.0. System content uses the new EAV system
     * @return void
     */
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

    /**
     * Creates the session table
     * @return void
     */
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

    /**
     * Creates the User MetaTable
     * @deprecated 21/02/2012 v1.0.0 
     * @return void
     */
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

    /**
     * Creates the Users table
     * @deprecated 21/02/2012 v1.0.0 Uses the new EAV model
     * @return void
     */
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

    /**
     * Creates the object authority table
     * @return void
     */
    private static function createObjectsAuthorityTable() {
        static::$database->query("DROP TABLE IF EXISTS `?objects_authority`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?objects_authority` (
                `object_authority_id` int(11) NOT NULL AUTO_INCREMENT,
                `authority_id` bigint(20) NOT NULL,
                `object_id` bigint(20) NOT NULL,
                PRIMARY KEY (`object_authority_id`),
                UNIQUE KEY `object_authority` (`authority_id`,`object_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    /**
     * Creates the object authority table
     * @return void
     */
    private static function createObjectsGroupTable() {
        static::$database->query("DROP TABLE IF EXISTS `?objects_group`;");
        static::$database->query(
           "CREATE TABLE IF NOT EXISTS `?objects_group` (
                `object_group_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
                `group_id` INT NOT NULL ,
                `object_uri` VARCHAR(20) NOT NULL ,
                PRIMARY KEY (`object_group_id`) ,
                UNIQUE INDEX `object_group_id_UNIQUE` (`object_group_id` ASC) 
            )ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    }

    /**
     * Many to many table describing edges between object (nodes)
     */
    private static function createObjectsEdgesTable() {
        static::$database->query("DROP TABLE IF EXISTS `?objects_edges`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?objects_edges` (
              `object_edge_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `edge_head_object` varchar(20) NOT NULL,
              `edge_name` varchar(45) NOT NULL,
              `edge_tail_object` varchar(20) NOT NULL,
              `edge_weight` INT(5) NOT NULL DEFAULT  '1',
              `edge_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `edge_description` varchar(100) DEFAULT NULL,
              PRIMARY KEY (`object_edge_id`),
              UNIQUE KEY `object_edge_id_UNIQUE` (`object_edge_id`),
              UNIQUE KEY `object_edge_head_tail_UNIQUE` (`edge_head_object`,`edge_tail_object`,`edge_name`),
              KEY `edge_head_uri` (`edge_head_object`),
              KEY `edge_tail_uri` (`edge_tail_object`),
              CONSTRAINT `edge_tail_uri` FOREIGN KEY (`edge_tail_object`) REFERENCES `?objects` (`object_uri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
              CONSTRAINT `edge_head_uri` FOREIGN KEY (`edge_head_object`) REFERENCES `?objects` (`object_uri`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );
    }

    /**
     * Creates the object rating table
     * @return void;
     */
    private static function createObjectsRatingTable() {
        static::$database->query("DROP TABLE IF EXISTS `?objects_rating`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?objects_rating` (
                `rating_id` int(11) NOT NULL AUTO_INCREMENT ,
                `object_id` int(11) NOT NULL ,
                `rating_user` varchar(50) NOT NULL,
                `rating` int(11) NOT NULL DEFAULT '0',
                `rating_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`rating_id`) ,
                UNIQUE KEY `object_rating` (`rating_user`,`object_id`),
                KEY `object_id_idx` (`object_id`),
                CONSTRAINT `objects_rating_ibfk_1` FOREIGN KEY (`object_id` ) REFERENCES `?objects` (`object_id` )
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
        //CONSTRAINT `objects_rating_ibfk_1` FOREIGN KEY (`object_id` ) REFERENCES `?objects` (`object_id` )
    }

    /**
     * Creates the objects table
     * @return void
     */
    private static function createObjectsTable() {

        static::$database->query("DROP TABLE IF EXISTS `?objects`;");
        static::$database->query(
                "CREATE TABLE IF NOT EXISTS `?objects` (
                `object_id` int(11) NOT NULL AUTO_INCREMENT,
                `object_type` varchar(55) NOT NULL DEFAULT 'entity',
                `object_created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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

    /**
     * Creates the object property table
     * @return void
     */
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

    /**
     * Creates the property datatype table
     * @return void
     */
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

    /**
     * Inserts default property datatypes to the property datatype table
     * @return void
     */
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

    /**
     * Query for creating property values by proxy table
     * @param string $group
     * @return void
     */
    public static function createPropertyValuesProxyTable($group) {

        $group = strtolower($group);
        if (!empty($group)) :
            static::$database->query("DROP TABLE IF EXISTS `?{$group}_property_values`;");
            static::$database->query(
                    "CREATE TABLE IF NOT EXISTS `?{$group}_property_values` (
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

            static::$database->query("DROP TRIGGER IF EXISTS `?{$group}_property_value_validate_insert`;");
            static::$database->query(
                    "CREATE TRIGGER `?{$group}_property_value_validate_insert` BEFORE INSERT ON `?{$group}_property_values`
                    FOR EACH ROW
                    BEGIN
                        CALL ?property_value_validate(NEW.property_id, NEW.value_data);
                    END;"
            );

            static::$database->query("DROP TRIGGER IF EXISTS `?{$group}_property_value_validate_update`;");
            static::$database->query(
                    "CREATE TRIGGER `?{$group}_property_value_validate_update` BEFORE UPDATE ON `?{$group}_property_values`
                    FOR EACH ROW
                    BEGIN
                        CALL ?property_value_validate(NEW.property_id, NEW.value_data);
                    END;"
            );

            //Add reference constrains
            static::$database->query(
                    "ALTER TABLE `?{$group}_property_values`
                    ADD CONSTRAINT `{$group}_property_values_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `?objects` (`object_id`),
                    ADD CONSTRAINT `{$group}_property_values_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `?properties` (`property_id`) ON DELETE CASCADE;"
            );
        endif;
    }

    /**
     * Query for creating the property values table
     * @return void
     */
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

    /**
     * SQL query for creating the user views table
     * @deprecated 21/02/2012 v1.0.0 
     * @return void
     */
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

    /**
     * Query for adding indicies to the property values table
     * @return void
     */
    private static function createIndices() {

        static::$database->query("ALTER TABLE `?properties` ADD CONSTRAINT `properties_ibfk_` FOREIGN KEY (`property_datatype`) REFERENCES `?property_datatypes` (`datatype_name`);");
        static::$database->query(
                "ALTER TABLE `?property_values`
                    ADD CONSTRAINT `property_values_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `?objects` (`object_id`),
                    ADD CONSTRAINT `property_values_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `?properties` (`property_id`) ON DELETE CASCADE;"
        );
    }

    /**
     * Runs the database installation transaction
     * @return boolean
     */
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
        static::createGroupsTable();
        static::createObjectsAuthorityTable();
        static::createObjectsGroupTable();
        static::createObjectsEdgesTable();
        static::createPropertiesTable();
        static::createPropertyDatatypeTable();
        static::createPropertyValuesTable();
        static::createIndices();
        static::insertPropertyDatatypes();
        static::createObjectsRatingTable();
        static::createPropertyValuesProxyTable("attachment"); //The attachment table
        static::createPropertyValuesProxyTable("media"); //The media table
        static::createPropertyValuesProxyTable("user"); //The users table
        //static::createUsermetaTable();
        //static::createUsersTable();
        //static::createUsersView();

        if (!static::$database->commitTransaction()) {
            static::setError(static::$database->getError());
            return false;
        }

        return true;
    }

    /**
     * Returns an instance of the database schema
     * @return type
     */
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

