<?php
/**
 * The file that defines the force pull data class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      3.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/controller
 */

if (!class_exists('Triage_Trak_Pull_Data')) {

    class Triage_Trak_Pull_Data
    {
        private $doctor_class;
        private $location_class;
        private $parser_class;

        public function __construct()
        {
            $this->doctor_class = new Triage_Trak_Doctors;
            $this->location_class = new Triage_Trak_Locations;
            $this->parser_class = new Triage_Trak_Parse_Data;
        }

        public function force_pull()
        {
            if (isset($_POST['hidden_field']) && tt_is_auth_success()) {
               
                try {                   
                    $data = $this->parser_class->tt_parse_data();
                    $doctors = $this->doctor_class->tt_get_doctor_params($data);
                    $locations = $this->location_class->tt_get_location_params($data);
                    
                   
                    
                    if(!empty($doctors ) || !empty($locations)){

                        $this->parser_class->tt_delete_post_before_update(T_T_DOCTOR_POST_TYPE);
                        $this->parser_class->tt_delete_post_before_update(T_T_LOCATION_POST_TYPE);

                        $output = array(
                            'success' => true,
                            'data' => ['doctors' => $doctors, 'locations'=>$locations],
                            'total_doctors' => count($doctors),
                            'total_locations' => count($locations),
                        );
                        
                    }else{
                        $output = array(
                            'error' => __('No data found', TRIAGE_TRAK_TEXT_DOMAIN)
                        );
                    }

                } catch (Exception $e) {
                  
                    $output = array(
                        'error' => $e
                    );
                }
            } else {
                $output = array(
                    'error' => __('Please login to WebSitter Pro', TRIAGE_TRAK_TEXT_DOMAIN)
                );
            }
           
            wp_send_json($output);
        }

        public function import_data()
        {
            
            if (isset($_POST['args'])) {
                $args = json_decode(stripslashes($_POST['args']), true);
                
              if (!empty($args) && !empty($args['doctors'])) {
                    foreach ($args['doctors'] as $doctor) {;
                        $this->parser_class->tt_create_new_post(
                            T_T_DOCTOR_POST_TYPE,
                            $doctor['title'],
                            $doctor['content'] ?? '',
                            $doctor['tax_input'] ?? [],
                            $doctor['meta_input'] ?? []
                        );
                        usleep( 500000 );
                    }
                }
               if (!empty($args) && !empty($args['locations'])) {
                    foreach ($args['locations'] as $location) {
                        $this->parser_class->tt_create_new_post(
                            T_T_LOCATION_POST_TYPE,
                            $location['title'],
                            '',
                            $location['tax_input'] ?? [],
                            $location['meta_input'] ?? [],
                            $location['departments_url'] ?? []
                        );
                        usleep( 500000 );
                    }
                }
            }

            wp_die();
        }

        public function get_import_data()
        {
            $locations_posts = wp_count_posts(T_T_LOCATION_POST_TYPE)->publish;
            $doctors_posts = wp_count_posts(T_T_DOCTOR_POST_TYPE)->publish;
            echo $doctors_posts + $locations_posts;

            wp_die();
        }
    }
}