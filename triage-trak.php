<?php
/**
 * Plugin Name:       WebSitter Pro
 * Description:       This plugin connects WebSitter Pro to WordPress. WebSitter Pro is a cloud based software that provides comprehensive and easy management of doctor bios, services and practice locations.
 * Version:           4.0.11
 * Author:            WebSitter Pro
 * Author URI:        https://websitterpro.pointsgroup.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if (!defined('WPINC')) die();

define('TRIAGE_TRAK_TEXT_DOMAIN', 'triage-trak');
define('T_T_DOCTOR_POST_TYPE', 'tt_doctor');
define('T_T_LOCATION_POST_TYPE', 'tt_location');
/**
 * Store plugin base dir, for easier access later from other classes.
 * (eg. Include, pubic or admin)
 */
define('TRIAGE_TRAK_BASE_DIR', plugin_dir_path(__FILE__));

/**
 * Store plugin base url, for easier access later from other classes.
 * (eg. Include, pubic or admin)
 */
define('TRIAGE_TRAK_BASE_URL', plugin_dir_url(__FILE__));

/********************************************
 * RUN CODE ON PLUGIN UPGRADE AND ADMIN NOTICE
 *
 * @tutorial run_code_on_plugin_upgrade_and_admin_notice.php
 */
define('TRIAGE_TRAK_BASE_NAME', plugin_basename(__FILE__));
// RUN CODE ON PLUGIN UPGRADE AND ADMIN NOTICE

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-triage-trak-activator.php
 */
function activate_triage_trak()
{
    require_once TRIAGE_TRAK_BASE_DIR . 'includes/class-triage-trak-activator.php';
    Triage_Trak_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-triage-trak-deactivator.php
 */
function deactivate_triage_trak()
{
    require_once TRIAGE_TRAK_BASE_DIR . 'includes/class-triage-trak-deactivator.php';
    Triage_Trak_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_triage_trak');
register_deactivation_hook(__FILE__, 'deactivate_triage_trak');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require TRIAGE_TRAK_BASE_DIR . 'includes/class-triage-trak.php';

/********************************************
 * THIS ALLOW YOU TO ACCESS YOUR PLUGIN CLASS
 * eg. in your template/outside of the plugin.
 *
 * Of course you do not need to use a global,
 * you could wrap it in singleton too,
 * or you can store it in a static class,
 * etc...
 *
 * @tutorial access_plugin_and_its_methodes_later_from_outside_of_plugin.php
 */
global $pbt_prefix_triage_trak;
$pbt_prefix_triage_trak = new Triage_Trak();
$pbt_prefix_triage_trak->run();

new Triage_Trak_Import_Changes();

// END THIS ALLOW YOU TO ACCESS YOUR PLUGIN CLASS
