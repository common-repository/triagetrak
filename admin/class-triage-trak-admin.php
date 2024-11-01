<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 * @author     Your Name <email@example.com>
 */
class Triage_Trak_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $triage_trak The ID of this plugin.
     */
    private $triage_trak;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /*************************************************************
     * ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE
     *
     * @tutorial access_plugin_admin_public_methodes_from_inside.php
     */
    /**
     * Store plugin main class to allow public access.
     *
     * @since    1.0.0
     * @var object      The main class.
     */
    public $main;

    /*************************************************************
     * ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE
     *
     * @tutorial access_plugin_admin_public_methodes_from_inside.php
     */
    /**
     * Initialize the class and set its properties.
     *
     * @param string $triage_trak The name of this plugin.
     * @param string $version The version of this plugin.
     * @param $plugin_main
     * @since    1.0.0
     */
    public function __construct($triage_trak, $version, $plugin_main)
    {
        $this->triage_trak = $triage_trak;
        $this->version = $version;
        $this->main = $plugin_main;
    }

    /**
     * Register the StyleSheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->triage_trak, TRIAGE_TRAK_BASE_URL . 'admin/css/triage-trak-admin.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->triage_trak, TRIAGE_TRAK_BASE_URL . 'admin/js/triage-trak-admin.js', array('jquery'), $this->version, false);
        wp_localize_script( $this->triage_trak, 'wp_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );
    }

    public function create_menu()
    {
        /**
         * Create a submenu page under Settings.
         * Framework also add "Settings" to your plugin in plugins list.
         *
         */
        $config_submenu = array(
            'type' => 'menu',                                       // Required, menu or metabox
            'id' => 'triage-trak-main-settings',                    // Required, meta box id, unique per page, to save: get_option( id )
            'parent' => $this->triage_trak,                         // Parent page of plugin menu (default Settings [options-general.php])
            'submenu' => true,                                      // Required for submenu
            'title' => esc_html__('Settings', TRIAGE_TRAK_TEXT_DOMAIN),   // The title of the options page and the name in admin menu
            'capability' => 'manage_options',                       // The capability needed to view the page
            'plugin_basename' => TRIAGE_TRAK_BASE_NAME,             // Plugin name
            'multilang' => false,                                   // To turn of multilang, default on
        );

        /**
         * Available fields:
         * - ACE field
         * - attached
         * - backup
         * - button
         * - botton_bar
         * - card
         * - checkbox
         * - color
         * - color_wp
         * - content
         * - date
         * - editor
         * - group/accordion item
         * - hidden
         * - image
         * - image_select
         * - meta
         * - notice
         * - number
         * - password
         * - radio
         * - range
         * - select
         * - switcher
         * - tab
         * - tap_list
         * - text
         * - textarea
         * - typography
         * - upload
         * - video mp4/oembed
         */

        /**
         * include all option files
         */
        foreach (glob(TRIAGE_TRAK_BASE_DIR . '/admin/option-fields/*') as $options) {
            include_once $options;
        }

        /**
         * options order
         */
        $fields[] = tt_get_general_options();
        $fields[] = tt_get_plugin_info_options();
        $fields[] = tt_get_doctors_list_options();
        $fields[] = tt_get_doctor_options();
        $fields[] = tt_get_doctors_filter_options();
        $fields[] = tt_get_locations_list_options();
        $fields[] = tt_get_location_options();
        $fields[] = tt_get_locations_filter_options();

        /**
         * instantiate your admin page
         */
        new Exopite_Simple_Options_Framework($config_submenu, $fields);

        $options = array();
        foreach ($fields as $tab => $settings) {
            if (is_array($settings)) {
                foreach ($settings as $option) {
                    if (isset($option['default'])) {
                        $options[$option['id']] = $option['default'];
                    }
                    if (is_array($option)) {
                        foreach ($option as $opt) {
                            if (isset($opt['default'])) {
                                $options[$opt['id']] = $opt['default'];
                            }
                        }
                    }
                }
            }
        }

        return $options;
    }

    public function add_plugin_admin_menu()
    {
        add_menu_page('Plugin settings', 'WebSitter Pro', 'manage_options', $this->triage_trak, '', TRIAGE_TRAK_BASE_URL . 'admin/img/MenuIcon.png', 58);

        add_submenu_page($this->triage_trak, '', __('Authentication', TRIAGE_TRAK_TEXT_DOMAIN),
            'manage_options', $this->triage_trak, array($this, 'display_plugin_setup_page'));
        add_submenu_page($this->triage_trak, '', __('Import', TRIAGE_TRAK_TEXT_DOMAIN),
            'manage_options', 'triage-trak-import', array($this, 'display_plugin_import_page'));
    }

    public function display_plugin_setup_page()
    {
        include_once('view/admin/triage-trak-admin-display.php');
    }

    public function display_plugin_import_page()
    {
        include_once('view/admin/triage-trak-import-display.php');
    }

    /**
     * This function runs when WordPress completes its upgrade process
     * It iterates through each plugin updated to see if ours is included
     *
     * @param $upgrader_object Array
     * @param $options Array
     * @link https://catapultthemes.com/wordpress-plugin-update-hook-upgrader_process_complete/
     * @link https://codex.wordpress.org/Plugin_API/Action_Reference/upgrader_process_complete
     */
    public function upgrader_process_complete( $upgrader_object, $options ) {

        // If an update has taken place and the updated type is plugins and the plugins element exists
        if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {

            // Iterate through the plugins being updated and check if ours is there
            foreach( $options['plugins'] as $plugin ) {
                if( $plugin == TRIAGE_TRAK_BASE_NAME ) {

                    set_transient( $this->triage_trak . '_updated', 1 );

                }
            }
        }
    }

    /**
     * Show a notice to anyone who has just updated this plugin
     * This notice shouldn't display to anyone who has just installed the plugin for the first time
     */
    public function display_update_notice() {

        if( get_transient( $this->triage_trak . '_updated' ) ) {

            echo '<div class="notice notice-success is-dismissible"><p><strong>' . __( 'Thanks for updating', TRIAGE_TRAK_TEXT_DOMAIN ) . '</strong><a href="'. admin_url('?page=triage-trak-import') .'">' . __( 'Import Data', TRIAGE_TRAK_TEXT_DOMAIN ) . '</a></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

            delete_transient( $this->triage_trak . '_updated' );
        }

    }
}