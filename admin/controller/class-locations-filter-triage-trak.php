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

require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-locations-triage-trak.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-trak-zip-codes-list.php';

if (!class_exists('Triage_Trak_Locations_Filter')) {

    class Triage_Trak_Locations_Filter extends Triage_Trak_Locations
    {
        public $zip_code_class;

        /**
         * Show filter select by options
         *
         * @param $select_name
         * @return string generated HTML select with options
         */
        public function show_select($select_name)
        {
            $select = '';
            $label_name = ucwords(str_replace('_', ' ', $select_name));
            if ($select_name) {
                $base_select = '<select id="tt_' . esc_attr($select_name) . '" name="' . esc_attr($select_name) . '[]" class="select_picker ' . esc_attr($select_name) . '" data-placeholder="' . esc_html__($label_name, TRIAGE_TRAK_TEXT_DOMAIN) . '" multiple="multiple">';

                if($select_name == 'departments'){
                    $options = get_terms('loc_departments');
                }else{
                    $options = get_terms($select_name);
                }

                foreach ($options as $option) {
                    $base_select .= '<option value="' . $option->slug . '">' . $option->name . '</option>';
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
        public function locations_filter_function()
        {
            $params = [];
            $zip_codes = [];

            $args = array(
                'post_type' => T_T_LOCATION_POST_TYPE,
                'post_status' => 'publish',
            );

            if (check_param_var($_POST['departments'])) {

                $args['tax_query'][] = array(
                    'taxonomy' => 'loc_departments',
                    'field' => 'slug',
                    'terms' => sanitize_array($_POST['departments']),
                );

            }
            if( check_param_var($_POST['zip_code']) || check_param_var($_POST['loc_letters'])){
                $args['meta_query'] = array( 'relation'=>'AND' );
            }

            if(check_param_var($_POST['zip_code'])){

                $this->zip_code_class = new Triage_Trak_Zip_Codes_List();

                $zip_code = sanitize_text_field($_POST['zip_code']);

                $zip_codes = $this->zip_code_class->get_sorting_zip_codes($zip_code,'zip_code');

                $args['meta_key'] = 'zip_code';
                $args['orderby'] = 'zip_codes_list';
                $args['zip_codes_list'] = $zip_codes;
                $args['suppress_filters'] = false;

                $args['meta_query'][] = array(
                    'key' => 'zip_code',
                    'value' => $zip_codes,
                    'compare' => 'IN'
                );

            }
            if (check_param_var($_POST['loc_letters'])) {

                $letterVal = '^' . sanitize_text_field($_POST['loc_letters']);

                $args['meta_query'][] = array(
                    'key'       => 'loc_name',
                    'value'     => $letterVal,
                    'compare'   => 'REGEXP',
                );
            }
            if (check_param_var($_POST['params'])) {
                $params = $_POST['params'];
                $args["posts_per_page"] = sanitize_text_field($params['per_page']);
            }

            ob_start();

            echo tt_get_api_template_part(get_shortcode_template_path() . 'locations-list/templates/locations-content-template', $params, $args);

            $data = ob_get_clean();

            $output = array(
                'success' => true,
                'data' => $data,
                'zip_codes' => $zip_codes,
                'args' => $args
            );

            wp_send_json($output);

        }
    }
}
