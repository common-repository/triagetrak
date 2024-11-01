<?php

/**
 * Provide a doctor card view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view
 */

if (!defined('WPINC')) die();

add_shortcode('triage_trak_doctors', 'doctors_shortcode_handler');
function doctors_shortcode_handler()
{
    $doctors = new Triage_Trak_Doctors();
    $filter = new Triage_Trak_Doctors_Filter();

    $filter_template = '';
    $our_team_block = '';
    $custom_option = get_option('triage-trak-main-settings');
    $doctor_permalink = get_option('doctor_permalink');
    $post_name = get_post_field('post_name');

    if (!$doctor_permalink || strcmp($doctor_permalink, $post_name) !== 0) {
        update_option('doctor_permalink', $post_name);
    }

    if (!empty($custom_option) && !empty($custom_option['doctors_css'])) {
        $doctors_css = $custom_option['doctors_css'];
    } else {
        $doctors_css = '';
    }

    $page = isset($_GET['d_page']) ? intval($_GET['d_page']) : 1;

    // if we has doctors, show filter
    $list_doctors = $doctors->get_doctors($page);

    if (!empty($list_doctors) && !empty($list_doctors->data)){
        $filter_template .= $filter->show_filter();
    }


    if (isset($_GET['user']) && !empty($_GET['user'])) {

        $template = $doctors->show_doctor();

    } else {

        $template = $doctors->show_doctors($page, get_permalink());
    }

    $our_team_block .= '<div class="tt_main_page">';
    $our_team_block .= '<div id="tt_loading_page"><img src="' . plugin_dir_url(dirname(__FILE__)) . '/img/loader.gif" alt="loader"></div>';
    $our_team_block .= $filter_template;
    $our_team_block .= '<style>' . $doctors_css . '</style>';
    $our_team_block .= '<div id="tt_doctors_page" class="tt_doctors_content tt_container">' . $template . '</div>';
    $our_team_block .= '</div>';

    return  $our_team_block;
}