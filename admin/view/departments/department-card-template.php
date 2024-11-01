<?php

/**
 * Provide a department card view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view
 */

if (!defined('WPINC')) die('Silly human what are you doing here');

if (!function_exists('departments_template')) {
    add_shortcode('tt_departments_list', 'departments_template');

    function departments_template($params)
    {
        $departments = new Triage_Trak_Locations_Filter();
        $count = $params['departments_count'];
        $all_departments = $departments->get_departments($count);

        $output = '';
        $output .= '<ul class="tt_departments_list">';

        foreach ($all_departments as $department) {
            $output .= '<li><a href="' . $department->page_url . '" target="' . $params['target'] . '" >' . $department->name . '</a></li>';
        }

        $output .= '</ul>';

        return $output;

    }
}


