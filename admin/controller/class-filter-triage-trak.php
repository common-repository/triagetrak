<?php

/**
 * The file that defines the core filter class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

if (!class_exists('Triage_Trak_Filter')) {

    class Triage_Trak_Filter
    {
        private $auth_class;

        public function __construct()
        {
            $this->auth_class = new Triage_Trak_Auth();
        }

        /**
         * Doctor filter return filter option
         *
         * @param $route
         * @param string $per_page
         * @return bool|mixed
         */
        public function filter_api_call($route, $per_page)
        {
            $route = $this->auth_class->route_param_handler($route);
            $per_page = "per_page=$per_page";

            $options = $this->auth_class->api_call('GET', $this->auth_class->get_route($route . $per_page), get_option('tt_access_token'));

            if (tt_is_auth_success() && $options->http_code == 401) {
                $options = $this->auth_class->api_call('GET', $this->auth_class->get_route($route . $per_page), $this->auth_class->refresh_token_handler());
            }

            return $options;
        }

        /**
         * Get filter scope by options
         *
         * @param $filter_option
         * @param $option_name
         * @return string
         */
        public function get_filter_scope($filter_option, $option_name)
        {
            $scope = '';

            $options = $this->sanitize_select($filter_option);
            foreach ($options as $option) {
                $scope .= $option_name . '[]=' . $option . '&';
            }

            return $scope;
        }

        /**
         *  Sanitizing the data from select
         * @param $values
         * @return array
         */
        function sanitize_select($values)
        {
            $multi_values = !is_array($values) ? explode(',', $values) : $values;

            return !empty($multi_values) ? array_map('sanitize_text_field', $multi_values) : array();
        }
    }
}