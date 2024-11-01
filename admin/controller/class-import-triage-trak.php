<?php

/**
 * The file that defines the import data class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      3.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/controller
 */

require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-auth-triage-trak.php';

if (!class_exists('Triage_Trak_Import')) {

    class Triage_Trak_Import extends Triage_Trak_Auth
    {
        private $data_array;

        public function __construct()
        {
            parent::__construct();
        }

        /**
         * @return mixed
         */
        public function get_data_array()
        {
            return $this->data_array;
        }

        function tt_get_pages($tt_access_token, $doctors_url) {     
            
            $req_header = array(
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $tt_access_token)
            );
            $options = array('timeout' => 120);

            $response = Requests::request($doctors_url . '?per_page=5', $req_header, null, 'GET', $options);

            if (tt_is_auth_success() && $responses[0]->status_code == 401) {

                $req_header = array(
                    'Content-Type' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->refresh_token_handler())
                );                 
                $response = Requests::request($doctors_url . '?per_page=5', $req_header, null, 'GET', $options);

            }

            if ($responses[0]->status_code == 500) {
                $response = Requests::request($doctors_url . '?per_page=5', $req_header, null, 'GET', $options);
            }

            

            $data[] = json_decode($response->body);
            $count = $data[0]->data->count;
            $per_page = $data[0]->data->per_page;      
            
           
           
            if ($count > $per_page) {
                $pages = ceil($count/$per_page);
            } else {
                $pages = 1;
            }            

          
            return $pages;

        }

        function tt_multi_req_scope($tt_access_token)
        {            

  
            $doctors_url = $this->get_route($this->router_class->get_doctors_route());
            $locations_url = $this->get_route($this->router_class->get_locations_route());
            $images_url = $this->get_route($this->router_class->get_images_route());

            $req_header = array(
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $tt_access_token)
            );           

            $pages = $this->tt_get_pages($tt_access_token, $doctors_url);                  
           
            if ($pages > 1) {            
               
                for ($i = 2; $i <= $pages; $i++) {
                    if ($i >= 2) {
                        $doctors_url_new = $doctors_url . '?page=' . $i;

                        $new_req = [
                            'url' => $doctors_url_new,
                            'type' => 'GET',
                            'headers' => $req_header,
                        ];
                    } 
                    $req_doctors_arr[] = $new_req;
                }
              
            }            

            $req_doctors = [
                'url' => $doctors_url . '?page=1',
                'type' => 'GET',
                'headers' => $req_header,
            ];

            $req_locations = [
                'url' => $locations_url,
                'type' => 'GET',
                'headers' => $req_header,
            ];

            $req_images = [
                'url' => $images_url,
                'type' => 'GET',
                'headers' => $req_header,
            ]; 

            if ($pages > 1) {
                $req_docs = [$req_doctors, $req_locations, $req_images]; 
                $merged_array = array_merge($req_docs, $req_doctors_arr); 

                return $merged_array;
            } else {
                return [$req_doctors, $req_locations, $req_images];
            }

        }

    

        function tt_request_multiple()
        {
            $responses = [];
            $retry = false;

            $options = array('timeout' => 200);

            $request_array = $this->tt_multi_req_scope(get_option('tt_access_token'));   
            $request_count = count($request_array);

            if ( count($request_array) > 6 ) {
                $request_count = 6;
            } else {
                $request_count =  count($request_array);
            }

                       
          
            for ($i = 0; $i < $request_count; $i++) {
                $item = $request_array[$i];
                sleep(2); 
               
                $responses[$i] = Requests::request($item['url'], $item['headers'], null, 'GET', $options);                

                if (tt_is_auth_success() && $responses[$i]->status_code == 401) {
                    $responses = [];
                    $retry = true;
                    break;                    
                }
                
            } 

            if ($retry == true) {
                $request_array = $this->tt_multi_req_scope($this->refresh_token_handler());

                $request_count = count($request_array);
                
                for ($i = 0; $i < $request_count; $i++) {
                    $item = $request_array[$i];   
                    sleep(2);                
                    $responses[$i] = Requests::request($item['url'], $item['headers'], null, 'GET', $options);    
                    
                }

            }

            sleep(5);

            if (count($request_array) > 6) {

                $request_count = count($request_array);
                
                for ($i = 6; $i < $request_count; $i++) {
                    $item = $request_array[$i];
                   
                    if (empty($item)){
                        break;
                    }

                    sleep(2); 
                    $responses[$i] = Requests::request($item['url'], $item['headers'], null, 'GET', $options);                
                  

                    if (tt_is_auth_success() && $responses[$i]->status_code == 401) {
                        $responses = [];
                        $retry = true;
                        break;                    
                    }   

                } 
    
                if ($retry == true) {
                    $request_array = $this->tt_multi_req_scope($this->refresh_token_handler());
    
                    $request_count = count($request_array) - 6;
                    
                    for ($i = 6; $i < $request_count; $i++) {
                        $item = $request_array[$i];   
                        if (empty($item)){
                            break;
                        }
                        sleep(2);                
                        $responses[$i] = Requests::request($item['url'], $item['headers'], null, 'GET', $options);    
                        
                    }
    
                }

            } 

            
            
            /** @var Requests_Response $response */
            if ($responses && is_array($responses)) {
                $data = [];
              
                foreach ($responses as $response) {
                    if (is_a($response, 'Requests_Response')) {
                        $data[] = json_decode($response->body);
                    }
                }
             
                $this->data_array = $data;
            }
             
            
        }

       
    }
}
