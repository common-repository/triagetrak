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

if (!defined('WPINC')) die();

add_shortcode('triage_trak_locations', 'locations_shortcode_handler');
function locations_shortcode_handler()
{
    $locations = new Triage_Trak_Locations();
    $filter = new Triage_Trak_Locations_Filter();

    $locations_block = '';
    $locations_filter = '';
    $custom_option = get_option('triage-trak-main-settings');
    $location_permalink = get_option('location_permalink');
    $post_name = get_post_field('post_name');

    if (!$location_permalink || strcmp($location_permalink, $post_name) !== 0) {
        update_option('location_permalink', $post_name);
    }

    if (!empty($custom_option) && !empty($custom_option['locations_css'])) {
        $locations_css = $custom_option['locations_css'];
    } else {
        $locations_css = '';
    }

    $page = isset($_GET['l_page']) ? intval($_GET['l_page']) : 1;

    $locations_map = $locations->show_map($locations->get_location_list());

    if(!empty($locations->get_location_list())){
        $locations_filter = $filter->show_filter();
    }

    if (isset($_GET['location']) && !empty($_GET['location'])) {
        $template = $locations->show_location();
    } else {

        $template = $locations->show_locations($page, get_permalink());
    }

    $locations_block .= '<div class="tt_main_page">';
    $locations_block .= '<div id="tt_loading_page"><img src="' . plugin_dir_url(dirname(__FILE__)) . '/img/loader.gif" alt="loader"></div>';
    $locations_block .= $locations_map;
    $locations_block .= $locations_filter;
    $locations_block .= '<style>' . $locations_css . '</style>';
    $locations_block .= '<div id="tt_location_page" class="tt_doctors_content tt_container">' . $template . '</div>';
    $locations_block .= '</div>';

    return  $locations_block;
}