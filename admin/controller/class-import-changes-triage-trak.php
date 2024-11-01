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

require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-doctors-triage-trak.php';
require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-auth-triage-trak.php';

if (!class_exists('Triage_Trak_Import_Changes')) {

    class Triage_Trak_Import_Changes extends Triage_Trak_Auth
    {
        public $doctors_class;
        public $locations_class;
        public $parser_class;
        private $data_changes_array;

        public function __construct()
        {
            $this->doctors_class = new Triage_Trak_Doctors();
            $this->locations_class = new Triage_Trak_Locations();
            $this->parser_class = new Triage_Trak_Parse_Data();

            parent::__construct();

            if (tt_is_auth_success()) {
                add_filter('cron_schedules', array($this, 'check_changes_every_thirty_minutes'));
                add_action('check_changes_every_thirty_minutes', array($this, 'tt_changes_request_multiple'));
                // Schedule an action if it's not already scheduled
                if (!wp_next_scheduled('check_changes_every_thirty_minutes') && tt_is_auth_success()) {
                    wp_schedule_event(time(), 'tt_pull_changes', 'check_changes_every_thirty_minutes');
                }
            }
        }

        /**
         * Add a new interval of 30 minutes
         *
         * @param $schedules
         * @return mixed
         */
        function check_changes_every_thirty_minutes($schedules)
        {
            $schedules['tt_pull_changes'] = array(
                'interval' => 600,
                'display' => __('Every 30 Minutes', TRIAGE_TRAK_TEXT_DOMAIN)
            );

            return $schedules;
        }

        /**
         * @param $tt_access_token
         * @return array[]
         */
        function tt_changes_multi_req_scope($tt_access_token)
        {
            $current_date = date("Y-m-d");
//            $current_date = '2020-02-02';

            $doctors_changes_url = $this->get_route($this->router_class->get_doctors_changes_route() . $current_date);
            $locations_changes_url = $this->get_route($this->router_class->get_locations_changes_route() . $current_date);

            $req_header = array(
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('Bearer %s', $tt_access_token)
            );

            $req_doctors_changes = [
                'url' => $doctors_changes_url,
                'type' => 'GET',
                'headers' => $req_header,
            ];
            $req_locations_changes = [
                'url' => $locations_changes_url,
                'type' => 'GET',
                'headers' => $req_header,
            ];

            return [$req_doctors_changes, $req_locations_changes];
        }

        function tt_changes_request_multiple()
        {
            $responses = Requests::request_multiple($this->tt_changes_multi_req_scope(get_option('tt_access_token')));

            if (tt_is_auth_success() && $responses[0]->status_code == 401) {
                $responses = Requests::request_multiple($this->tt_changes_multi_req_scope($this->refresh_token_handler()));
            }

            /** @var Requests_Response $response */
            if ($responses && is_array($responses)) {
                $data = [];

                foreach ($responses as $response) {
                    if (is_a($response, 'Requests_Response')) {
                        $data[] = json_decode($response->body);
                    }
                }

                $this->data_changes_array = $data;
            }

            foreach ($this->data_changes_array as $change) {
                if ($change->hasUpdates > 0) {
                    $data = $this->parser_class->tt_parse_data();
                    $this->doctors_class->tt_insert_doctors_to_db($data);
                    $this->locations_class->tt_insert_locations_to_db($data);
                    return;
                }
            }
        }
    }
}
