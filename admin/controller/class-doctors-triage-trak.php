<?php

/**
 * The file that defines the core doctors class
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

if (!class_exists('Triage_Trak_Doctors')) {

    class Triage_Trak_Doctors extends Triage_Trak_Parse_Data
    {
        public $pages;
        public $doctors_input = [];
        public $files = [];

        /**
         * Get doctor avatar
         *
         * @param $doctor
         * @return string $avatar link
         */
        function get_doctor_thumbnail($doctor):string
        {
            $avatar = TRIAGE_TRAK_BASE_URL . 'admin/img/no_avatar.png';
            $tenant_id = isset($doctor['tenant_id']) ? $doctor['tenant_id'] . '/' : 'null/';

            if (!empty($doctor["files"])) {
                foreach ($doctor["files"] as $file) {

                    if ($file['type'] == 'avatar' && $tenant_id == $file['tenant_id']) {
                        $avatar = $this->router_class->get_bucket_url() . $tenant_id . 'users/' . $file['user_id'] . '/' . $file['name'];
                    }
                }
            }

            return $avatar;
        }

        /**
         * Get file depending on its type
         *
         * @param $doctor_id
         * @param $type
         * @param $files
         * @return array $result with mame,type and file url
         */
        public function get_doctor_files($doctor_id, $type, $files):array
        {
            $result = [];

            if (!empty($files)) {
                foreach ($files['files'] as $file) {
                    if ($file['type'] == $type && $file['related_model_id']  == $doctor_id ) {
                        $result[] = [
                            'name' => $file['name'],
                            'type' => $file['mimetype'],
                            'dnd_order' => $file['dnd_order'],
                            'url' => $this->router_class->get_bucket_url() . $file['tenant_id'] . '/doctor/' . $file['related_model_id'] . '/' . $file['name'],
                        ];
                    }
                }
            }

            return $result;
        }

        /**
         * Get doctors patient_ages
         * @param $min_age
         * @param $max_age
         * @return string
         */
        public function doctor_patient_ages($min_age, $max_age):string
        {
            $patient_ages = '';

            if($min_age >= 1 && $max_age <= 4){
                $patient_ages = '0-4';
            }
            if($min_age >= 5 && $max_age <= 8){
                $patient_ages = '5-8';
            }
            if($min_age >= 9 && $max_age <= 12){
                $patient_ages = '9-12';
            }

            if($min_age >= 13 && $max_age <= 17){
                $patient_ages = '13-17';
            }

            if($min_age >= 18 && $max_age <= 100){
                $patient_ages = '18';
            }
            return $patient_ages;
        }

        /**
         * Get doctors params
         * @param $data
         * @return array
         */
        public function tt_get_doctor_params( $data ):array
        {
            $doctors = $this->tt_get_data_by_name(['doctors'], $data);
            $this->files = $this->tt_get_data_by_name(['files'], $data);

            if (!empty($doctors)) {
                foreach ($doctors as $doctor) {                  
                    
                    array_map(function ($doc) {
                        $this->doctors_input[] = [
                            'title' => $doc["first_name"] . ' ' . $doc["last_name"],
                            'content' => $doc["written_bio"],
                            'meta_input' => [
                                'doctor_id' => $doc['id'],
                                'avatar' => $this->get_doctor_thumbnail($doc['user']),
                                'phone_number' => $this->phone_space($doc['phone_number']),
                                'phone_extension' => $this->phone_space($doc['phone_extension']),
                                'credentials' => maybe_serialize(array_column($doc["dictCredentials"], 'name')),
                                'dnd_order' => $doc['dnd_order'],
                                'accept_new_patients' => $doc['accept_new_patients'],
                                'min_age_treated' => $doc['min_age_treated'],
                                'max_age_treated' => $doc['max_age_treated'],
                                'patient_ages' => $this->doctor_patient_ages($doc['min_age_treated'], $doc['max_age_treated']),
                                'location_ids' => maybe_serialize(array_column($doc['locations'], 'id')),
                                'doc_zip_codes' =>(!empty(array_column($doc['locations'], 'zip_code'))) ? serialize(array_column($doc['locations'], 'zip_code')) : '',
                                'doctors_locations_hours' => maybe_serialize(array_column($doc['locations'], 'doctors_locations_hours')),
                                'doc_document' => maybe_serialize($this->get_doctor_files($doc['id'], 'document',$this->files)),
                                'doc_award' => maybe_serialize($this->get_doctor_files($doc['id'], 'award', $this->files)),
                                'bio_video_link' => $doc["bio_video_link"],
                                'zoc_doc_link' => $doc["zoc_doc_link"],
                                'board_certifications' => maybe_serialize(array_column($doc['board_certifications'], 'name')),
                                'residencies' => maybe_serialize($doc["residencies"]),
                                'publications' => $doc['publications'],
                                'fellowships' => maybe_serialize($doc["fellowships"]),
                                'internships' => maybe_serialize($doc["internships"]),
                                'educations' => maybe_serialize($doc["educations"]),
                                'insurance_companies' => maybe_serialize(array_column($doc['insurance_companies'], 'name')),
                                'hospital_affiliations' => maybe_serialize($doc["hospital_affiliations"]),
                                'practice' => maybe_serialize($doc["practice"]),
                                'procedures_url' => maybe_serialize($doc["procedures"]),
                                'conditions_url' => maybe_serialize($doc["conditions"]),
                                'last_name' => trim($doc["last_name"]),
                                'review_buttons' => maybe_serialize($doc["review_buttons"]),
                                'assistant_contact_info' => $doc["assistant_contact_info"]
                            ],

                            'tax_input' => [
                                'languages' => array_column($doc["dictLanguages"], 'name'),
                                'departments' => array_column($doc["departments"], 'name'),
                                'body_parts' => array_column($doc["body_parts"], 'name'),
                                'sub_specialties' => array_column($doc["sub_specialties"], 'name'),
                                'conditions' => array_column($doc["conditions"], 'name'),
                                'procedures' => array_column($doc["procedures"], 'name'),
                                'insurances' => array_column($doc["insurances"], 'name'),
                                'injury_types' => array_column($doc["dictInjuryTypes"], 'name'),
                                'hospital_affiliations_tax' => array_column($doc["hospital_affiliations"], 'name'),
                            ]
                        ];
                    }, $doctor);

                }
            }

            return $this->doctors_input;
        }

        /**
         * Insert all doctors from data to database
         * @param $data
         */
        public function tt_insert_doctors_to_db($data)
        {
            $doctors = $this->tt_get_doctor_params($data);
            $this->tt_delete_post_before_update(T_T_DOCTOR_POST_TYPE);

            foreach ($doctors as $doctor) {
                $this->tt_create_new_post(
                    T_T_DOCTOR_POST_TYPE,
                    $doctor['title'],
                    $doctor['content'] ?? '',
                    $doctor['tax_input'] ?? [],
                    $doctor['meta_input'] ?? []
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
         * Get locations by id for doctor
         *
         * @param $ids
         * @return array
         */
        function get_locations_by_ids($ids):array
        {
            $locations = [];

            if (!empty($ids)) {
                foreach ($ids as $id) {
                    $locations[] = get_posts(array(
                        'meta_key' => 'location_id',
                        'meta_value' => $id,
                        'post_type' => T_T_LOCATION_POST_TYPE,
                        'post_status' => 'publish',
                    ));
                }
            }

            return $locations;
        }

        /**
         * Ajax infinity scroll for doctors page
         */
        public function doctor_paginate_handler()
        {
            $params = [];

            $args = array(
                'post_type' => T_T_DOCTOR_POST_TYPE,
                'post_status' => 'publish',
                'meta_key' => 'dnd_order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC'
            );

            if (check_param_var($_POST['params'])) {
                $params = json_decode(stripslashes($_POST['params']), true);
                $args["posts_per_page"] = $params['per_page'];

                if (check_param_var($params['doc_departments']) || check_param_var($params['doc_conditions']) || check_param_var($params['doc_procedures'])) {

                    $args['tax_query'] = array('relation' => 'AND');

                    if (check_param_var($params['doc_departments'])) {

                        $args['tax_query'][] = array(
                            'taxonomy' => 'departments',
                            'field' => 'slug',
                            'terms' => sanitize_array($params['doc_departments']),
                        );
                    }

                    if (check_param_var($params['doc_conditions'])) {

                        $args['tax_query'][] = array(
                            'taxonomy' => 'conditions',
                            'field' => 'slug',
                            'terms' => sanitize_array($params['doc_conditions']),
                        );
                    }

                    if (check_param_var($params['doc_procedures'])) {

                        $args['tax_query'][] = array(
                            'taxonomy' => 'procedures',
                            'field' => 'slug',
                            'terms' => sanitize_array($params['doc_procedures']),
                        );
                    }
                }
            }

            if (check_param_var($_POST['args'])) {

                $values = [];

                parse_str($_POST['args'], $values);

                $args['tax_query'] = array('relation' => 'AND');
              //  $args['meta_query'] = array( 'relation'=>'AND' );

                foreach ($values as $param => $value) {
                    if (!empty($param)) {
                        if ($param == 'doctors' && !empty($value)) {
                            $args['post__in'] = $value;
                        }
                        if ($param == 'languages' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'languages',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'departments' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'departments',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'body_parts' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'body_parts',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'sub_specialties' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'sub_specialties',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'conditions' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'conditions',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'procedures' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'procedures',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'injury_types' && !empty($value)) {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'injury_types',
                                'field' => 'slug',
                                'terms' => $value,
                            );
                        }
                        if ($param == 'patient_ages' && !empty($value)) {
                            $args['meta_query'][] = array(
                                'key' => 'patient_ages',
                                'value' => $value,
                            );
                        }
                        if($param == 'doc_zip_code'&& !empty($value) && empty($_POST['zip_codes'])) {
                            $args['meta_query'][] = array(
                                'key' => 'doc_zip_codes',
                                'value' => $value,
                                'compare' => 'LIKE'
                            );
                        }
                        if ($param == 'new_patients' && !empty($value)) {
                            if ($value == 'on') {
                                $args['meta_query'][] = array(
                                    'key' => 'accept_new_patients',
                                    'value' => '1',
                                );
                            }
                        }
                        if ($param == 'letters' && !empty($value)) {
                            $letterVal = '^' . $value;

                            $args['meta_query'][] = array(
                                'key'       => 'last_name',
                                'value'     => $letterVal,
                                'compare'   => 'REGEXP',
                            );
                        }
                    }

                }

            }

            if (check_param_var($_POST['zip_codes'])) {
                $zip_codes = $_POST['zip_codes'];
                $args['post__in'] = $zip_codes;
            }

            $args['paged'] = sanitize_text_field($_POST['page']) + 1;
            $query = new WP_Query($args);
            $max_pages = $query->max_num_pages;

            ob_start();

            echo tt_get_api_template_part(get_shortcode_template_path() . 'doctors-list/templates/doctors-content-template', $params, $args);

            $data = ob_get_clean();

            $output = array(
                'success' => true,
                'data' => $data,
                'max_pages' => $max_pages,
                'args' => $args,

            );

            wp_send_json($output);

        }

        /**
         *  Add main fonts for plugin
         */
        public function google_fonts()
        {
            $settings = get_tt_main_settings();

            if ($settings && !empty($settings['general_font']['family'])) {
                /**
                 * load google fonts
                 */
                $main_font = implode(":", $settings['general_font']);
                $query_args = array(
                    'family' => $main_font
                );
                wp_enqueue_style('tt_google_fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"), array(), null);
            }
        }

    }
}