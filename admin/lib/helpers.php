<?php

if (!function_exists('get_tt_main_settings')) {
    /**
     * Get settings array
     * @return mixed
     */
    function get_tt_main_settings()
    {
        return get_option('triage-trak-main-settings');
    }
}

if (!function_exists('tt_is_auth_success')) {
    /**
     * Get auth success
     * @return mixed
     */
    function tt_is_auth_success()
    {
        return get_option('tt_auth_success');
    }
}

if (!function_exists('tt_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     *
     * @version 2.4.0
     */
    function tt_visual_composer_installed()
    {
        //is Visual Composer installed?
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('tt_init_shortcode_loader')) {
    function tt_init_shortcode_loader()
    {
        include_once 'shortcode-loader.php';
    }

    add_action('tt_shortcode_loader', 'tt_init_shortcode_loader');
}

if (!function_exists('tt_get_template_part')) {
    /**
     * Function that include template part
     * @param $template
     * @param array $params
     * @param array $args
     * @return false|string
     *
     * @version 2.4.0
     */
    function tt_get_api_template_part($template, $params = array(), $args = array())
    {
        $templates = array();
        $output = '';

        if (is_array($params) && count($params)) {
            extract($params);
        }

        if (is_array($args) && count($args)) {
            extract($args);
        }

        if ($template !== '') {
            $templates[] = $template . '.php';
        }

        $template_path = tt_find_template_path($templates);

        if ($template_path) {
            ob_start();

            include $template_path;

            $output = ob_get_contents();
            ob_end_clean();
        }

        return $output;
    }
}

if (!function_exists('tt_find_template_path')) {
    /**
     * Function that return template path
     * @param $template_names
     * @return string
     *
     * @version 2.4.0
     */
    function tt_find_template_path($template_names)
    {
        $template_path = '';

        foreach ((array)$template_names as $template_name) {
            if (!$template_name) {
                continue;
            }

            if (file_exists(TRIAGE_TRAK_BASE_DIR . $template_name)) {
                $template_path = TRIAGE_TRAK_BASE_DIR . $template_name;
                break;
            }
        }
        return $template_path;
    }
}