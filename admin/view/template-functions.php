<?php

if (!function_exists('single_templates')) {
    /**
     * Add template for post type
     *
     * @param $template
     * @return string
     */
    add_filter('template_include', 'single_templates');
    function single_templates($template)
    {
        if (is_singular(array(T_T_DOCTOR_POST_TYPE)) &&
            file_exists(TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/doctors-list/templates/single-doctor.php')) {
            $template = TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/doctors-list/templates/single-doctor.php';
        }

        if (is_singular(array(T_T_LOCATION_POST_TYPE)) &&
            file_exists(TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/locations-list/templates/single-location.php')) {
            $template = TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/locations-list/templates/single-location.php';
        }

        return $template;
    }
}

if (!function_exists('custom_taxonomy_templates')) {
    /**
     * Add template for taxonomy
     *
     * @param $template
     * @return string
     */
    add_filter('taxonomy_template', 'custom_taxonomy_templates');
    function custom_taxonomy_templates($template)
    {

        if (is_tax('departments') || is_tax('conditions') || is_tax('procedures') &&
            file_exists(TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/doctors-list/templates/taxonomy.php')) {
            $template = TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/doctors-list/templates/taxonomy.php';
        }

        if (is_tax('loc_departments') &&
            file_exists(TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/locations-list/templates/taxonomy.php')) {
            $template = TRIAGE_TRAK_BASE_DIR . 'admin/shortcodes/locations-list/templates/taxonomy.php';
        }

        return $template;
    }
}

if (!function_exists('search_template')) {
    /**
     * Add template for search page
     *
     * @param $template
     * @return string
     */
    add_filter('template_include', 'search_template');
    function search_template($template)
    {

        if (is_search() &&
            file_exists(TRIAGE_TRAK_BASE_DIR . 'admin/widgets/search-bar/search.php')) {
            $template = TRIAGE_TRAK_BASE_DIR . 'admin/widgets/search-bar/search.php';
        }

        return $template;
    }
}

if (!function_exists('doctor_grid')) {
    /**
     * Get doctors grid
     *
     * @param $doctors_grid
     * @return string
     */
    function get_doctor_grid($doctors_grid)
    {
        $column = '';

        switch ($doctors_grid) {
            case 'one':
                $column = 'tt_col-lg-12 tt_one_col tt_m_bottom tt_doc_item';
                break;
            case 'two':
                $column = 'tt_col-xl-6 tt_col-lg-6 tt_col-md-6 tt_two_col tt_m_bottom tt_doc_item';
                break;
            case 'three':
                $column = 'tt_col-xl-4 tt_col-lg-6 tt_col-md-6 tt_three_col tt_m_bottom tt_doc_item';
                break;
            case 'four':
                $column = 'tt_col-xl-3 tt_col-lg-6 tt_col-md-6 tt_four_col tt_m_bottom tt_doc_item';
                break;
        }

        return $column;
    }
}

if (!function_exists('get_location_grid')) {
    /**
     * Get locations grid
     *
     * @param $locations_grid
     * @return string
     */
    function get_location_grid($locations_grid)
    {
        $column = '';

        switch ($locations_grid) {
            case 'one':
                $column = 'tt_col-lg-12 tt_one_col tt_m_bottom tt_loc_item';
                break;
            case 'two':
                $column = 'tt_col-lg-6 tt_col-md-6 tt_two_col tt_m_bottom tt_loc_item';
                break;
            case 'three':
                $column = 'tt_col-lg-4 tt_col-md-6 tt_three_col tt_m_bottom tt_loc_item';
                break;
            case 'four':
                $column = 'tt_col-lg-3 tt_col-md-6 tt_four_col tt_m_bottom tt_loc_item';
                break;
        }

        return $column;
    }
}

if (!function_exists('set_blank_for_external_url')) {
    /**
     * Function that return if url is external
     * @param $url
     * @return bool
     *
     * @version 2.4.0
     */
    function set_blank_for_external_url($url)
    {
        $parse_url = parse_url($url);
        if (!empty($parse_url) && !empty($parse_url['host'])) {
            echo 'target="blank"';
        }
        return false;
    }
}

if (!function_exists('initialize_custom_inline_styles')) {
    /**
     * Function that return inline styles by list option name
     *
     * @param $name
     */
    function initialize_custom_inline_styles($name)
    {
        $main_settings = get_tt_main_settings();
        $output = '';

        if (!empty($main_settings) && !empty($main_settings[$name])) {
            $output .= '<style>' . $main_settings[$name] . '</style>';
        }

        echo $output;
    }
}

if (!function_exists('tt_enqueue_styles')) {
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    2.5.0
     */
    function tt_enqueue_styles()
    {
        $triage_trak = new Triage_Trak();
        $style_deps_array = array();

        wp_enqueue_style($triage_trak->get_triage_trak(), TRIAGE_TRAK_BASE_URL . 'public/css/triage-trak-public.min.css',
            $style_deps_array, $triage_trak->get_version(), 'all');
        wp_enqueue_style('load-fa', TRIAGE_TRAK_BASE_URL . 'admin/exopite-simple-options/assets/font-awesome-4.7.0/font-awesome.min.css',
            $style_deps_array, $triage_trak->get_version(), 'all');
    }
}

if (!function_exists('tt_enqueue_scripts')) {
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    2.5.0
     */
    function tt_enqueue_scripts()
    {
        global $is_IE;
        $triage_trak = new Triage_Trak();

        wp_enqueue_script($triage_trak->get_triage_trak(), TRIAGE_TRAK_BASE_URL . 'public/js/triage-trak-public.js',
            array('jquery'), $triage_trak->get_version(), true);

        if ($is_IE) {
            wp_enqueue_script('polyfill', 'https://polyfill.io/v3/polyfill.min.js', array('jquery'), '', true);
        }

        wp_localize_script($triage_trak->get_triage_trak(), 'paginate_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'args' => '',
            'zip_codes' => ''
        ));
    }
}

if (!function_exists('initialize_select_scripts')) {
    function initialize_select_scripts()
    {
        wp_deregister_script('select-2');
        wp_enqueue_style('select2', TRIAGE_TRAK_BASE_URL . 'public/css/select2.min.css');
        wp_enqueue_script('select2', TRIAGE_TRAK_BASE_URL . 'public/js/select2.min.js', array('jquery'), '', true);
    }
}

if (!function_exists('initialize_doctor_scripts')) {
    function initialize_doctor_scripts()
    {
        // add dynamic styles for doctors
        wp_enqueue_style('doctors-dynamic-styles', TRIAGE_TRAK_BASE_URL . 'public/css/doctors-dynamic-styles.css',
            array(), filemtime(TRIAGE_TRAK_BASE_DIR . 'public/css/doctors-dynamic-styles.css'));
    }
}

if (!function_exists('initialize_location_scripts')) {
    function initialize_location_scripts()
    {
        // add dynamic styles for locations
        wp_enqueue_style('locations-dynamic-styles', TRIAGE_TRAK_BASE_URL . 'public/css/locations-dynamic-styles.css',
            array(), filemtime(TRIAGE_TRAK_BASE_DIR . 'public/css/locations-dynamic-styles.css'));

        // add dynamic scripts for locations map
        wp_enqueue_script('google-maps-locations', TRIAGE_TRAK_BASE_URL . 'public/js/gmaps.js', array('jquery'), '', true);
        add_action('wp_print_footer_scripts', 'google_maps_in_footer', 99);
    }
}

if (!function_exists('google_maps_in_footer')) {
    function google_maps_in_footer()
    {
        $locations = new Triage_Trak_Locations();
        ?>
        <script async defer
                src='https://maps.googleapis.com/maps/api/js?key=<?= $locations->get_google_api_key(); ?>&callback=initMap'></script>
        <?php
    }
}
if (!function_exists('tt_doctor_slider_scripts')) {
    function tt_doctor_slider_scripts()
    {
        wp_enqueue_script('tt-owl-script', TRIAGE_TRAK_BASE_URL . 'public/js/owl.carousel.min.js',
            array('jquery'), '', true);
    }
}

if (!function_exists('tt_add_shortcode_styles')) {
    function tt_add_shortcode_styles()
    {
        global $post;

        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'tt_doctors_list')) {
            tt_enqueue_styles();
            initialize_doctor_scripts();
            initialize_custom_inline_styles('doctors_css');
        }

        elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'tt_locations_list')) {
            tt_enqueue_styles();
            initialize_location_scripts();
            initialize_custom_inline_styles('locations_css');
        }

        elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'tt_departments_list')) {
            tt_enqueue_styles();
        }

        elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'tt_doctors_slider')) {
            tt_enqueue_styles();
            initialize_custom_inline_styles('doctors_css');
        }
    }

    add_action('wp_enqueue_scripts', 'tt_add_shortcode_styles');
}



if (!function_exists('tt_get_filter_options')) {
    function tt_get_filter_options($options)
    {
        $result_options = [];

        if (!empty($options)) {
            foreach ($options as $option) {
                $result_options[$option->name ?? ''] = $option->slug ?? '';
            }
        }

        $result_options = array_merge(['All Options' => ''], $result_options);

        return $result_options;
    }
}


if (!function_exists('check_param_var')) {
    function check_param_var($var_name)
    {
        if (isset($var_name) && !empty($var_name)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('sanitize_array')) {
    function sanitize_array($array)
    {
        foreach ((array)$array as $k => $v) {
            $array[$k] = sanitize_text_field($v);
        }
        return $array;
    }
}