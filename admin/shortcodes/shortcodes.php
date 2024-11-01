<?php

if (!function_exists('tt_load_shortcode_interface')) {
    function tt_load_shortcode_interface()
    {
        include_once TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/lib/shortcode-interface.php';
    }
    add_action('tt_before_options_map', 'tt_load_shortcode_interface');
}

if (!function_exists('tt_load_shortcodes')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     * and loads load.php file in each. Hooks to tt_after_options_map action
     *
     */
    function tt_load_shortcodes()
    {
        foreach (glob(TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/*/load.php') as $shortcode_load) {
            include_once $shortcode_load;
        }

        do_action('tt_shortcode_loader');
    }
    add_action('tt_before_options_map', 'tt_load_shortcodes');
}

/**
 * Run all option map for shortcodes
 */
do_action('tt_before_options_map');







