<?php

require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/doctors/doctor-cards-dynamic-styles.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/doctors/doctor-buttons-dynamic-styles.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/doctors/doctors-dynamic-styles.php';

require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/locations/locations-dynamic-styles.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/locations/location-buttons-dynamic-styles.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/custom-styles/locations/location-cards-dynamic-styles.php';

if (!function_exists('tt_is_css_folder_writable')) {
    /**
     * Function that checks if css folder is writable
     * @return bool
     *
     * @version 0.1
     * @uses is_writable()
     */
    function tt_is_css_folder_writable()
    {
        $css_dir = TRIAGE_TRAK_BASE_DIR . 'public/css/';

        return is_writable($css_dir);
    }
}

if (!function_exists('tt_writable_assets_folders_notice')) {
    /**
     * Function that prints notice that css and js folders aren't writable. Hooks to admin_notices action
     *
     * @version 0.1
     * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
     */
    function tt_writable_assets_folders_notice()
    {
        global $pagenow;
        $is_theme_options_page = isset($_GET['page']) && strstr($_GET['page'], 'triage-trak-main-settings');

        if ($pagenow === 'admin.php' && $is_theme_options_page) {
            if (!tt_is_css_folder_writable()) { ?>
                <div class="error">
                    <p><?php esc_html_e('Note that writing permissions aren\'t set for folders containing css and js files on your server.
					We recommend setting writing permissions in order to optimize your site performance.
					If writing permissions aren\'t set for folders containing CSS files on your server, 
					you will see a warning message at the top of the theme options page. ', 'triage-trak'); ?></p>
                    <p><?php esc_html_e('In order to remove that message, 
					you need to change permissions for the wp-content/plugin/triagetrak/public/css folders and set them to 755. 
					We recommend setting writing permissions in order to optimize your site performance. 
					If you have any issues with this, please contact your hosting service provider.', 'triage-trak'); ?></p>
                </div>
            <?php }
        }
    }

    add_action('admin_notices', 'tt_writable_assets_folders_notice');
}

if (!function_exists('tt_generate_options_css')) {
    /**
     * Get custom styles and store them in custom.css file or use inline css fallback
     * @param $css_file
     * @param $data
     */
    function tt_generate_options_css($css_file, $data)
    {
        global $wp_filesystem;
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        WP_Filesystem();

        if (tt_is_css_folder_writable()) {
            $css_dir = TRIAGE_TRAK_BASE_DIR . 'public/css/';
            $wp_filesystem->put_contents($css_dir . $css_file, $data);
        }
    }
}