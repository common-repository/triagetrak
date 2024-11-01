<?php

/**
 * The file that defines the core locations class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-parser-triage-trak.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/template-functions.php';

if (!class_exists('Triage_Trak_Locations')) {

    class Triage_Trak_Locations extends Triage_Trak_Parse_Data
    {
        const GOOGLE_API_KEY = 'AIzaSyDHq3de8PiTpufjQzAigZSkUWm21xjrnY8';

        public $pages;
        public $locations_input = [];
        public $locations_terms = [];

        public static function get_google_api_key()
        {
            return self::GOOGLE_API_KEY;
        }

        /**
         * Get location photo
         * default image if empty photo
         *
         * @param $location
         * @return string $photo link
         */
        function get_location_thumbnail($location):string
        {
            $photo = TRIAGE_TRAK_BASE_URL . 'admin/img/no_location_photo.png';
            $tenant_id = isset($location['tenant_id']) ? $location['tenant_id'] . '/' : 'null/';

            if (!empty($location['files'])) {

                foreach ($location['files'] as $file) {

                    if ($tenant_id == $file['tenant_id']) {
                        $photo = $this->router_class->get_bucket_url() . $tenant_id . 'location/' . $location['id'] . '/' . $file['name'];
                    }
                }
            }
            return $photo;
        }

        /**
         * Get doctors params
         * @param $data
         * @return array
         */
        public function tt_get_location_params($data):array
        {
            $locations = $this->tt_get_data_by_name(['locations'], $data);

            foreach ($locations as $location) {

                array_map(function ($loc) {

                    $address2 = !empty($loc['address2']) ? $loc['address2'] . '<br/>' : '';
                    $address = $loc['address'] . '<br/> '. $address2 . $loc['city'] . ', ' .$loc["state"]['abbreviation'] . ' ' .$loc['zip_code'];

                    $this->locations_input[] = [
                        'title' => $loc["name"],
                        'meta_input' => [
                            'location_id' => $loc['id'],
                            'photo' => $this->get_location_thumbnail($loc),
                            'phone_number' => $this->phone_space($loc['phone_number']),
                            'phone_extension' => $this->phone_space($loc['phone_extension']),
                            'phone_numbers' => maybe_serialize($loc['phone_numbers']),
                            'zip_code' => $loc['zip_code'],
                            'address' => $address,
                            'address2' => $loc['address2'],
                            'address_details' => $loc['additional_info'],
                            'location_type' => $loc['location_type'],
                            'state' => $loc["state"]['name'],
                            'doctor_ids' => array_column($loc['Doctors'], 'id'),
                            'hours' => maybe_serialize($loc['hours']),
                            'loc_name' => trim($loc["name"]),
                            'gmb_listing_link' => $loc['gmb_listing_link']
                        ],
                        'departments_url' => array_combine(array_column($loc["departmentsLocations"], 'name') , array_column($loc["departmentsLocations"], 'page_url') ),
                        'tax_input' => [
                            'loc_departments' => array_column($loc["departmentsLocations"], 'name'),
                        ]

                    ];

                }, $location);

            }

            return $this->locations_input;
        }

        /**
         * Insert all locations from data to database
         * @param $data
         */
        public function tt_insert_locations_to_db($data)
        {
            $locations = $this->tt_get_location_params($data);

            $this->tt_delete_post_before_update(T_T_LOCATION_POST_TYPE);

            foreach ($locations as $location) {
                $this->tt_create_new_post(
                    T_T_LOCATION_POST_TYPE,
                    $location['title'],
                    '',
                    $location['tax_input'] ?? [],
                    $location['meta_input'] ?? []
                );
            }
        }

        /**
         * Add space for phone number
         * @param $phone
         * @return string
         */
        public function phone_space($phone)
        {
            if (strpos($phone, ')') !== false) {
                return trim(substr_replace($phone, " ", 5, -strlen($phone)));
            } else {
                return $phone;
            }
        }

        /**
         * Convert date/time from 24-hour format to 12-hour AM/PM
         * @param $date
         * @return false|string
         */
        public function get_date_format($date)
        {
            return date('h:i A', strtotime($date));
        }

        /**
         * @param $arrays
         * @return array
         */
        function combine_arrays($arrays):array
        {
            $result_array = [];
            foreach ($arrays as $array) {

                if (!is_array($array)) {
                    $result_array[] = $array;
                } else {
                    foreach ($array as $arr) {
                        $result_array[] = $arr;
                    }
                }
            }

            $result_array = array_intersect_key($result_array, array_unique(array_column($result_array, 'name')));

            return $result_array;
        }

        /**
         * Get doctors by id for location
         *
         * @param $ids
         * @return array
         */
        function get_doctors_by_ids($ids)
        {
            $doctors = [];

            if (!empty($ids)) {
                foreach ($ids as $id) {
                    $doctors[] = get_posts(array(
                        'meta_key' => 'doctor_id',
                        'meta_value' => $id,
                        'post_type' => T_T_DOCTOR_POST_TYPE,
                        'post_status' => 'publish',
                    ));
                }
            }

            return $doctors;
        }

        /**
         * Get and combine doctor terms
         *
         * @param $doctors
         * @param $term_name
         * @return array
         */
        function get_doctor_terms($doctors, $term_name):array
        {
            $terms_list = [];

            if (!empty($doctors)) {
                foreach ($doctors as $doctor) {
                    if (!empty(get_the_terms($doctor[0]->ID, $term_name)))
                        $terms_list = get_the_terms($doctor[0]->ID, $term_name);
                }
            }

            return $this->combine_arrays($terms_list);
        }

        /**
         * Ajax infinity scroll for locations page
         */
        public function location_paginate_handler()
        {
            $params = [];

            $args = array(
                'post_type' => T_T_LOCATION_POST_TYPE,
                'post_status' => 'publish',
            );

            if (check_param_var($_POST['args'])) {

                $values = [];

                parse_str($_POST['args'], $values);

                foreach ($values as $param => $value) {
                    if (!empty($param)) {
                        if ( $param == 'departments'&& !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'loc_departments',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }

                        if ( $param == 'loc_letters'&& !empty($value)) {
                            $letterVal = '^' . $value;

                            $args['meta_query'][] = array(
                                'key' => 'loc_name',
                                'value' => $letterVal,
                                'compare' => 'REGEXP',
                            );

                        }
                    }
                }
            }
            if (check_param_var($_POST['zip_codes'])) {

                $zip_codes = sanitize_array($_POST['zip_codes']);
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
            if (check_param_var($_POST['params'])) {
                $params = json_decode(stripslashes($_POST['params']), true);
                $args["posts_per_page"] = $params['per_page'];

            }

            $args['paged'] = sanitize_text_field($_POST['page']) + 1;
            $query = new WP_Query($args);
            $max_pages = $query->max_num_pages;

            ob_start();

            echo tt_get_api_template_part(get_shortcode_template_path() . 'locations-list/templates/locations-content-template', $params, $args);

            $data = ob_get_clean();


            $output = array(
                'success' => true,
                'data' => $data,
                'max_pages' => $max_pages,
            );

            wp_send_json($output);

        }
    }
}