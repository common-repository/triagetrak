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

if (!defined('WPINC')) die('Silly human what are you doing here');

if (!function_exists('doctors_template')) {
    function doctors_template($params)
    {
        $doctors = new Triage_Trak_Doctors();
        $filter = new Triage_Trak_Doctors_Filter();

        initialize_doctor_scripts();
        initialize_custom_inline_styles('doctors_css');

        $page = isset($_GET['d_page']) ? intval($_GET['d_page']) : 1;
        $paginate_class = !empty($params['show_paginate']) ? 'show-paginate' : '';
        $output = '<div class="tt_main_page">';
        $output .= '<div id="tt_loading_page" class="tt_doctors_loading ' . $paginate_class . '"
                                 data-per-page="' . esc_attr($params['per_page']) . '"
                                 data-columns="' . esc_attr($params['grid_columns']) . '"
                                 data-link-btn="' . esc_attr($params['show_link_button']) . '"
                                 data-show-conditions="' . esc_attr($params['show_doc_conditions']) . '"
                                 data-limit-conditions="' . esc_attr($params['limit_conditions']) . '"
                                 data-departments="' . esc_attr($params['doc_departments']) . '"
                                 data-conditions="' . esc_attr($params['doc_conditions']) . '"
                                 data-procedures="' . esc_attr($params['doc_procedures']) . '">';

        $output .= '<img src="' . TRIAGE_TRAK_BASE_URL . 'admin/img/loader.gif" alt="loader"></div>';

        if (!empty($params['show_filter']))
            $output .= $filter->show_filter();

        $output .= '<div id="tt_doctors_page" class="tt_doctors_page_class tt_content tt_container">';

        if ((isset($_GET['user']) && !empty($_GET['user'])) || ( !empty(get_query_var('user')))) {
            $output .= $doctors->show_doctor();
        } else {
            $output .= $doctors->show_doctors($page, get_permalink(), $params);
        }

        $output .= '</div></div>';

        return $output;
    }
}
