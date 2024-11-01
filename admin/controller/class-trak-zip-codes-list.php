<?php

class Triage_Trak_Zip_Codes_List
{
    /**
     * Get all zip codes within a given radius of a zip code.
     * @param string $zip_code
     * @return array
     */
    private function get_zip_codes_by_radius(string $zip_code):array
    {
        $api_key = 'cMxDKuxhvbAM0tj0h2FprLrhyKgRuPhLpm6G718cMKVO17bWhhM0wBS9hdY6xzH7';
       // $api_key = 'cMxDKuxhvbAM0tj0h2FprLrhyKgRuPhLpm6G718cMKVO17bWhhM0wBS9hdY6xzH7';
        $url = "http://www.zipcodeapi.com/rest/$api_key/radius.json/$zip_code/50/mile";

        $request = wp_remote_get($url);
        $zip_codes = [];

        if (is_wp_error($request) || wp_remote_retrieve_response_code($request) != 200) {

            $zip_codes[] = $zip_code;

            return $zip_codes;

        } else {
            $body = json_decode(wp_remote_retrieve_body($request), true);

            foreach ($body as $zipcodes) {
                foreach ($zipcodes as $zipcode){
                    $zip_codes[strval($zipcode['distance'])] = $zipcode['zip_code'];
                }
            }
            natsort($zip_codes);

            return $zip_codes;
        }

    }

    /**
     * Get all zip codes from database
     * @param string $meta_key
     * @return array
     */
    private function get_current_zip_codes(string $meta_key):array
    {
        global $wpdb;

        $data = $wpdb->get_results($wpdb->prepare( "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key) , ARRAY_N  );

        $result = [];

        if (!empty($data)){
            foreach($data as $array){
                $result[] = $array[0];
            }
        }

        return $result;
    }

    /**
     * Get all doctors by zipcodes radius
     * @param array $zipcodes
     * @return array
     */
    public function get_doctors_by_zipcodes_radius(array $zipcodes):array
    {
        global $wpdb;

        $data = $wpdb->get_results($wpdb->prepare( "SELECT DISTINCT meta_value,post_id FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value <> ''", 'doc_zip_codes' ) , ARRAY_N  );

        $doctor_zipcodes = [];
        $post_ids = [];

        if (!empty($data)){
            foreach($data as $array){
                $doctor_zipcodes[$array[1]] = unserialize(unserialize( $array[0]));
            }
        }
        if(!empty($doctor_zipcodes)){
            foreach ($doctor_zipcodes as $key => $value) {
                if(count(array_intersect($zipcodes, $value)) > 0){
                    $post_ids[] = $key;
                }
            }
        }

        return $post_ids;
    }

    /**
     * Get all sorting zip codes
     * @param string $zip_code
     * @param string $metakey
     * @return array
     */
    public  function get_sorting_zip_codes( string $zip_code, string $metakey):array
    {
        $all_zip_codes = $this->get_zip_codes_by_radius($zip_code);

        $current_zip_codes = $this->get_current_zip_codes($metakey);

        $intersect_zip_codes = array_intersect( $all_zip_codes, $current_zip_codes);

        $sorted_zip_codes = array_flip($intersect_zip_codes);

        asort($sorted_zip_codes);

        return  array_keys ($sorted_zip_codes);

    }

    /**
     * Custom db order by  zip codes
     * @param $orderby
     * @param $query
     * @return mixed|string
     */
    public function locations_orderby_zipcodes_list($orderby, $query)
    {
        $key = 'zip_codes_list';
        if ($key === $query->get('orderby') &&
            ($list = $query->get($key))) {
            global $wpdb;
            $list = "'" . implode(wp_parse_list($list), "', '") . "'";
            return "FIELD( $wpdb->postmeta.meta_value, $list )";
        }

        return $orderby;
    }
}