<?php

/**
 * Provide a location card view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view
 */

if (!defined('WPINC')) die('Silly human what are you doing here');

if (!function_exists('tt_locations_template')) {
    function tt_locations_template($params)
    {
        $locations = new Triage_Trak_Locations();
        $filter = new Triage_Trak_Locations_Filter();

        initialize_location_scripts($locations);
        initialize_custom_inline_styles('locations_css');

        $page = isset($_GET['l_page']) ? intval($_GET['l_page']) : 1;
        $paginate_class = !empty($params['show_paginate']) ? 'show-paginate' : '';


        $output = '<div class="tt_main_page">';
        $output .= '<div id="tt_loading_page" class="tt_locations_loading ' . $paginate_class . '"
                                 data-per-page="' . esc_attr($params['per_page']) . '"
                                 data-columns="' . esc_attr($params['grid_columns']) . '" 
                                 data-address ="' . esc_attr($params['show_address']) . '" 
                                 data-limit-address ="' . esc_attr($params['limit_address']) . '" 
                                 data-phone ="' . esc_attr($params['show_phone']) . '" 
                                 data-link-button ="' . esc_attr($params['show_link_button']) . '">';

        $output .= '<img src="' . TRIAGE_TRAK_BASE_URL . 'admin/img/loader.gif" alt="loader"></div>';

        if (!empty($params['show_map']))
            $output .= $locations->show_map($locations->get_location_list());

        if (!empty($params['show_filter']))
            $output .= $filter->show_filter();

        $output .= '<div id="tt_location_page" class="tt_location_page_class tt_content tt_container">';

        if ((isset($_GET['location']) && !empty($_GET['location'])) || ( !empty(get_query_var('location')))) {
            $output .= $locations->show_location();
        } else {
            $output .= $locations->show_locations($page, get_permalink(), $params);
        }

        $output .= '</div></div>';

        return $output;
    }
}
