<?php

/**
 * Fired during plugin activation
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Triage_Trak
 * @subpackage Triage_Trak/includes
 * @author     Your Name <email@example.com>
 */
class Triage_Trak_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        /**
         * Update default options
         */

        $settings = new Triage_Trak_Admin('triage-trak', '', '');

        // get current options from db
        $current_settings = get_tt_main_settings();

        // if current options is empty update default options
        if(empty($current_settings)){
            update_option('triage-trak-main-settings', $settings->create_menu());
        }

        /**
         * Custom Post Types
         */
        require_once TRIAGE_TRAK_BASE_DIR  . 'includes/class-triage-trak-post-types.php';

        $plugin_post_types = new Triage_Trak_Post_Types();

        $plugin_post_types->create_custom_post_type();

        /**
         * This only required if custom post type has rewrite!
         *
         * Remove rewrite rules and then recreate rewrite rules.
         *
         */
        flush_rewrite_rules();

    }


}

