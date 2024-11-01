<?php

/**
 * The file that defines the core filter class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-doctors-triage-trak.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-trak-zip-codes-list.php';

if (!class_exists('Triage_Trak_Doctors_Filter')) {

    class Triage_Trak_Doctors_Filter extends Triage_Trak_Doctors
    {
        public $zip_code_class;

        /**
         * Show filter selects by options
         *
         * @param $select_name
         * @return string generated HTML selects with options
         */
        public function show_select($select_name)
        {
            $select = '';
            $label_name = ucwords(str_replace('_', ' ', $select_name));
            if ($select_name) {
                $base_select = '<select id="tt_' . esc_attr($select_name) . '" name="' . esc_attr($select_name) . '[]" class="select_picker ' . esc_attr($select_name) . '" data-placeholder="' . esc_html__($label_name, TRIAGE_TRAK_TEXT_DOMAIN) . '" multiple="multiple">';

                if ($select_name == 'doctors') {
                    $options = get_posts(['post_type' => T_T_DOCTOR_POST_TYPE, 'numberposts' => -1]);
                    foreach ($options as $option) {
                        $base_select .= '<option value="' . $option->ID . '">' . $option->post_title . '</option>';
                    }

                } else {
                    $options = get_terms($select_name);
                    foreach ($options as $option) {
                        $base_select .= '<option value="' . $option->slug . '">' . $option->name . '</option>';
                    }
                }

                $base_select .= '</select>';

                // add labels for IE instead of placeholders
                $select = $this->ie_labels($label_name);
                $select .= $base_select;
            }
            return $select;
        }

        /**
         *  Show ajax result for selected filter parameters
         */
        public function ajax_filter_function()
        {
            $params = [];
            $doctors_zipcodes = [];

            $args = array(
                'post_type' => T_T_DOCTOR_POST_TYPE,
                'post_status' => 'publish',
                'meta_key' => 'dnd_order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC'
            );

            if (check_param_var($params['doc_departments']) || check_param_var($params['doc_conditions']) ||
                check_param_var($params['doc_procedures']) || check_param_var($_POST['languages']) ||
                check_param_var($_POST['body_parts']) || check_param_var($_POST['departments']) ||
                check_param_var($_POST['sub_specialties']) || check_param_var($_POST['conditions']) ||
                check_param_var($_POST['procedures']) || check_param_var($_POST['injury_types'])) {
                $args['tax_query'] = array('relation' => 'AND');
            }

            if (check_param_var($_POST['params'])) {

                $params = $_POST['params'];
                $args["posts_per_page"] = sanitize_text_field($params['per_page']);

                if (check_param_var($params['doc_departments'])) {

                    $args['tax_query'][] = array(
                        'taxonomy' => 'departments',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($params['doc_departments']),
                    );
                }

                if (check_param_var($params['doc_conditions'])) {

                    $args['tax_query'][] = array(
                        'taxonomy' => 'conditions',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($params['doc_conditions']),
                    );
                }

                if (check_param_var($params['doc_procedures'])) {

                    $args['tax_query'][] = array(
                        'taxonomy' => 'procedures',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($params['doc_procedures']),
                    );
                }

            }

            if (check_param_var($_POST['doctors'])) {
                $args['post__in'] = sanitize_array($_POST['doctors']);
            }

            if (check_param_var($_POST['departments'])) {
                $departments = $_POST['departments'];

                if (check_param_var($params['doc_departments'])) {
                    $departments = array_merge($departments, $params['doc_procedures']);
                }

                $args['tax_query'][] = array(
                    'taxonomy' => 'departments',
                    'field' => 'slug',
                    'terms' => sanitize_array($departments),
                );
            }

            if (check_param_var($_POST['conditions'])) {
                $conditions = $_POST['conditions'];

                if (check_param_var($params['doc_conditions'])) {
                    $conditions = array_merge($conditions, [$params['doc_conditions']]);
                }

                $args['tax_query'][] = array(
                    'taxonomy' => 'conditions',
                    'field' => 'slug',
                    'terms' => sanitize_array($conditions),
                );
            }

            if (check_param_var($_POST['procedures'])) {
                $procedures = $_POST['procedures'];

                if (check_param_var($params['doc_procedures'])) {
                    $procedures = array_merge($procedures, [$params['doc_procedures']]);
                }

                $args['tax_query'][] = array(
                    'taxonomy' => 'procedures',
                    'field' => 'slug',
                    'terms' => sanitize_array($procedures),
                );
            }

            if (check_param_var($_POST['languages'])) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'languages',
                    'field' => 'slug',
                    'terms' => sanitize_array($_POST['languages']),
                );
            }

            if (check_param_var($_POST['body_parts'])) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'body_parts',
                    'field' => 'slug',
                    'terms' => sanitize_array($_POST['body_parts']),
                );
            }

            if (check_param_var($_POST['sub_specialties'])) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'sub_specialties',
                    'field' => 'slug',
                    'terms' => sanitize_array($_POST['sub_specialties']),
                );
            }

            if (check_param_var($_POST['injury_types'])) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'injury_types',
                    'field' => 'slug',
                    'terms' => sanitize_array($_POST['injury_types']),
                );
            }

            if(check_param_var($_POST['patient_ages']) || check_param_var($_POST['new_patients']) ||
                check_param_var($_POST['doc_zip_code']) || check_param_var($_POST['letters'])){
                $args['meta_query'] = array('relation' => 'AND');
            }

            if(check_param_var($_POST['patient_ages'])){
                $args['meta_query'][] = array(
                    'key' => 'patient_ages',
                    'value' => sanitize_text_field($_POST['patient_ages']),
                );
            }

            if (check_param_var($_POST['doc_zip_code']) && empty($_POST['doctors'])) {

                $this->zip_code_class = new Triage_Trak_Zip_Codes_List();

                $zip_code = sanitize_text_field($_POST['doc_zip_code']);

                $zip_codes = $this->zip_code_class->get_sorting_zip_codes($zip_code, 'zip_code');

                $doctors_zipcodes = $this->zip_code_class->get_doctors_by_zipcodes_radius($zip_codes);

                if (!empty($doctors_zipcodes)) {
                    $args['post__in'] = $doctors_zipcodes;
                } else {
                    $args['meta_query'][] = array(
                        'key' => 'doc_zip_codes',
                        'value' => $zip_code,
                        'compare' => 'LIKE'
                    );
                }

            }

            if (check_param_var($_POST['new_patients']) && $_POST['new_patients'] == 'on') {
                $args['meta_query'][] = array(
                    'key' => 'accept_new_patients',
                    'value' => '1',
                );
            }
            if (check_param_var($_POST['letters'])) {

                $letterVal = '^' . sanitize_text_field($_POST['letters']);

                $args['meta_query'][] = array(
                    'key'       => 'last_name',
                    'value'     => $letterVal,
                    'compare'   => 'REGEXP',
                );
            }
            ob_start();

            echo tt_get_api_template_part(get_shortcode_template_path() . 'doctors-list/templates/doctors-content-template', $params, $args);

            $data = ob_get_clean();

            $output = array(
                'success' => true,
                'data' => $data,
                'zip_codes' => $doctors_zipcodes,
                'args' => $args
            );

            wp_send_json($output);

        }

    }
}
