<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/public
 * @author     Your Name <email@example.com>
 */
class Triage_Trak_Public
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
     * @since    20180622
     * @var object      The main class.
     */
    public $main;
    // END ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE


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
    // END ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        if (tt_is_css_folder_writable() &&
            (!file_exists(TRIAGE_TRAK_BASE_DIR . 'public/css/doctors-dynamic-styles.css') ||
                !file_exists(TRIAGE_TRAK_BASE_DIR . 'public/css/locations-dynamic-styles.css'))) {
            do_action('exopite_sof_after_generate_field');
        }
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts(){}
}
