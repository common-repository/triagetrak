<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Triage_Trak
 * @subpackage Triage_Trak/includes
 * @author     Your Name <email@example.com>
 */
class Triage_Trak
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Triage_Trak_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $triage_trak The string used to uniquely identify this plugin.
     */
    protected $triage_trak;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /*************************************************************
     * ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN
     *
     * @tutorial access_plugin_and_its_methodes_later_from_outside_of_plugin.php
     */
    /**
     * Store plugin admin class to allow public access.
     *
     * @since    20180622
     * @var object      The admin class.
     */
    public $admin;

    /**
     * Store plugin public class to allow public access.
     *
     * @since    20180622
     * @var object      The admin class.
     */
    public $public;
    // END ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN

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
    // ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->triage_trak = 'triage-trak';
        $this->version = '3.1.0';

        /*************************************************************
         * ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE
         *
         * @tutorial access_plugin_admin_public_methodes_from_inside.php
         */
        $this->main = $this;
        // ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Triage_Trak_Loader. Orchestrates the hooks of the plugin.
     * - Triage_Trak_i18n. Defines internationalization functionality.
     * - Triage_Trak_Admin. Defines all hooks for the admin area.
     * - Triage_Trak_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'includes/class-triage-trak-loader.php';
        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'includes/class-triage-trak-i18n.php';
        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/class-triage-trak-admin.php';
        /**
         * The class responsible for router.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-router-triage-trak.php';
        /**
         * The class responsible for import data.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-import-triage-trak.php';
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-import-changes-triage-trak.php';
        /**
         * The class responsible for parse data.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-parser-triage-trak.php';
        /**
         * The class responsible for force pull data.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-pull-data-triag-trak.php';
        /**
         * The class responsible for auth.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-auth-triage-trak.php';
        /**
         * The class responsible for doctors.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-doctors-triage-trak.php';
        /**
         * The class responsible for pagination class.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-pagination-triage-trak.php';
        /**
         * The class responsible for doctors filter.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-doctors-filter-triage-trak.php';
        /**
         * The class responsible for locations.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-locations-triage-trak.php';
        /**
         * The class responsible for locations filter.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-locations-filter-triage-trak.php';
        /**
         * The class responsible for generate zip codes lists.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-trak-zip-codes-list.php';
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'public/class-triage-trak-public.php';
        /**
         * Custom Post Types
         */
        require_once TRIAGE_TRAK_BASE_DIR  . 'includes/class-triage-trak-post-types.php';
        /**
         * The class responsible for defining all actions for AJAX
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'includes/class-triage-trak-ajax.php';
        /**
         * The file for adding all dynamic styles
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/dynamic-styles.php';
        /**
         * The file for adding shortcode compatibility for wpbackery
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/lib/helpers.php';
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/shortcodes.php';
        /**
         * The file for adding shortcode compatibility for WP Editor
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/editor-shortcodes.php';

        /**
         * The file for adding widget compatibility
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/widgets/widgets.php';
        /**
         * The file for adding triagetrak api templates
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/template-functions.php';

        /**************************************
         * EXOPITE SIMPLE OPTIONS FRAMEWORK
         *
         * Get Exopite Simple Options Framework
         *
         * @link https://github.com/JoeSz/Exopite-Simple-Options-Framework
         * @link https://www.joeszalai.org/exopite/exopite-simple-options-framework/
         *
         * @tutorial app_option_page_for_plugin_with_options_framework.php
         */
        require_once TRIAGE_TRAK_BASE_DIR . 'admin/exopite-simple-options/exopite-simple-options-framework-class.php';
        // END EXOPITE SIMPLE OPTIONS FRAMEWORK

        $this->loader = new Triage_Trak_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Triage_Trak_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new Triage_Trak_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new Triage_Trak_Admin($this->get_triage_trak(), $this->get_version(), $this->get_triage_trak());

        // Add menu item
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');

        /*************************************************************
         * ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE
         * (COMBINED WITH ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN)
         *
         *
         * @tutorial access_plugin_admin_public_methodes_from_inside.php
         */
        $this->admin = new Triage_Trak_Admin($this->get_triage_trak(), $this->get_version(), $this->main);
        // END ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE

        /*************************************************************
         * ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN
         *
         * @tutorial access_plugin_and_its_methodes_later_from_outside_of_plugin.php
         */
        // $this->admin = new Triage_Trak_Admin( $this->get_triage_trak(), $this->get_version() );

        $this->loader->add_action('admin_enqueue_scripts', $this->admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $this->admin, 'enqueue_scripts');
        // END ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN

        /***********************************
         * EXOPITE SIMPLE OPTIONS FRAMEWORK
         *
         * Save/Update our plugin options
         *
         * @tutorial app_option_page_for_plugin_with_options_framework.php
         */
        $this->loader->add_action('init', $this->admin, 'create_menu');
        // END EXOPITE SIMPLE OPTIONS FRAMEWORK

        /**
         * Create custom post type
         *
         */

        $plugin_post_types = new Triage_Trak_Post_Types();

        $this->loader->add_action( 'init', $plugin_post_types, 'create_custom_post_type' );

        $plugin_force_pull = new Triage_Trak_Pull_Data();
        $this->loader->add_action( 'wp_ajax_nopriv_force_pull', $plugin_force_pull, 'force_pull' );
        $this->loader->add_action('wp_ajax_force_pull', $plugin_force_pull, 'force_pull');

        $this->loader->add_action( 'wp_ajax_nopriv_import_data', $plugin_force_pull, 'import_data' );
        $this->loader->add_action('wp_ajax_import_data', $plugin_force_pull, 'import_data');

        $this->loader->add_action( 'wp_ajax_nopriv_get_import_data', $plugin_force_pull, 'get_import_data' );
        $this->loader->add_action('wp_ajax_get_import_data', $plugin_force_pull, 'get_import_data');


        /**
         * This function runs when WordPress completes its upgrade process
         * It iterates through each plugin updated to see if ours is included
         */
        $this->loader->add_action( 'upgrader_process_complete', $plugin_admin, 'upgrader_process_complete', 10, 2 );

        /**
         * Show a notice to anyone who has just updated this plugin
         * This notice shouldn't display to anyone who has just installed the plugin for the first time
         */
        $this->loader->add_action( 'admin_notices', $plugin_admin, 'display_update_notice' );

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        /*************************************************************
         * ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE
         * (COMBINED WITH ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN)
         */
        $this->public = new Triage_Trak_Public($this->get_triage_trak(), $this->get_version(), $this->main);
        // END ACCESS PLUGIN ADMIN PUBLIC METHODES FROM INSIDE

        /*************************************************************
         * ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN
         */
        $this->loader->add_action('wp_enqueue_scripts', $this->public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $this->public, 'enqueue_scripts', 999);
        // END ACCESS PLUGIN AND ITS METHODES LATER FROM OUTSIDE OF PLUGIN

        $doctor_class = new Triage_Trak_Doctors();
        $this->loader->add_action( 'wp_ajax_nopriv_paginate', $doctor_class, 'doctor_paginate_handler' );
        $this->loader->add_action('wp_ajax_paginate', $doctor_class, 'doctor_paginate_handler');
        $this->loader->add_action('wp_enqueue_scripts', $doctor_class, 'google_fonts');

        $doctors_filter = new Triage_Trak_Doctors_Filter();
        $this->loader->add_action( 'wp_ajax_nopriv_filter', $doctors_filter, 'ajax_filter_function' );
        $this->loader->add_action('wp_ajax_filter', $doctors_filter, 'ajax_filter_function');

        $location_class = new Triage_Trak_Locations();
        $this->loader->add_action( 'wp_ajax_nopriv_location_paginate', $location_class, 'location_paginate_handler' );
        $this->loader->add_action('wp_ajax_location_paginate', $location_class, 'location_paginate_handler');

        $locations_filter = new Triage_Trak_Locations_Filter();
        $this->loader->add_action( 'wp_ajax_nopriv_locations_filter', $locations_filter, 'locations_filter_function' );
        $this->loader->add_action('wp_ajax_locations_filter', $locations_filter, 'locations_filter_function');

        $zipcodes_lists = new Triage_Trak_Zip_Codes_List();
        $this->loader->add_filter( 'posts_orderby',$zipcodes_lists, 'locations_orderby_zipcodes_list', 10, 2 );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }
    /**
     * Validate fields from admin area plugin settings form ('exopite-lazy-load-xt-admin-display.php')
     * @param mixed $input as field form settings form
     * @return mixed as validated fields
     */

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.0.0
     */
    public function get_triage_trak()
    {
        return $this->triage_trak;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version()
    {
        return $this->version;
    }
}
