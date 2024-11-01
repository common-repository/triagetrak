<?php

/**
 * The file that defines the core auth class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      2.1.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

if (!class_exists('Triage_Trak_Auth')) {

    class Triage_Trak_Auth
    {
        public $errors;
        public $router_class;

        public function __construct()
        {
            $this->router_class = new Triage_Trak_Router();
        }

        /**
         * @param $message
         * @return mixed
         */
        private function show_error_msg($message)
        {
            return $message;
        }

        /**
         * Get route for api connection
         *
         * @param $route
         * @return string
         */
        public function get_route($route)
        {
            return $this->router_class->get_api_url() . $route;
        }

        private function get_user_login()
        {
            $login = get_option('tt_user_login');
            if (empty($_POST['tt_user_login'])) {
                $this->show_error_msg('Missing login!');
            } else {
                $login = sanitize_email(trim($_POST['tt_user_login']));
                update_option('tt_user_login', $login);
            }
            return $login;
        }

        private function get_user_pass()
        {
            $password = get_option('tt_user_password');
            if (empty($_POST['tt_user_password'])) {
                $this->show_error_msg('Missing password!');
            } else {
                $password = sanitize_text_field(trim($_POST['tt_user_password']));
                update_option('tt_user_password', password_hash($password, PASSWORD_DEFAULT));
            }
            return $password;
        }

        /**
         * Method: POST, PUT, GET etc
         *
         * @param $method
         * @param $url
         * @param array $options
         * @param array $cookies
         * @return bool|mixed
         */
        function api_call($method, $url, $options = array(), $cookies = array())
        {
            $request_url = $url;
            $args = array('method' => $method);

            if ($method == 'GET' && $options) {
                $request_url = sprintf("%s?%s", $url, http_build_query($options));
            } else if ($method == 'GET') {
                $request_url = $url;
            }

            if (($method == 'POST' || $method == 'PUT') && $options) {
                $args['body'] = $options;
            }

            if ($cookies) {
                $args['cookies'] = $cookies;
            }

            $result = wp_remote_request($request_url, $args);

            // Verify that the JSON feed returned something useful
            if ($result && is_array($result)) {
                return $result; // wp_remote_get get full response info
            } else return false;
        }

        /**
         * Return refresh token value - in case of get full response info
         *
         * @param $response
         * @return string
         */
        private function get_refresh_token($response)
        {
            $refresh_token = '';
            foreach ($response['cookies'] as $token) {
                if ($token->name === 'refresh_token') {
                    $refresh_token = $token->value;
                }
            }

            return $refresh_token;
        }

        // handler for update tokens
        public function tokens_handler()
        {
            if (isset($_POST['submit_api'])) {
                $data = 'login=' . $this->get_user_login() . '&password=' . $this->get_user_pass();
                $login_response = $this->api_call('POST', $this->get_route($this->router_class->get_login_route()), $data, false);

                $response_body = json_decode($login_response['body']);

                if (!empty($response_body->data) && !empty($response_body->data->access_token) && !empty($this->get_refresh_token($login_response))) {
                    update_option('tt_access_token', $response_body->data->access_token);
                    update_option('tt_refresh_token', rawurlencode($this->get_refresh_token($login_response))); // encode token value
                    update_option('tt_auth_success', true);
                } else {
                    update_option('tt_auth_success', false);
                    update_option('tt_user_password', false);
                    $this->errors = $response_body->message;
                }
            }
        }

        // logout button handler
        public function api_logout()
        {
            if (isset($_POST['logout_api'])) {
                delete_option('tt_user_password');
                delete_option('tt_access_token');
                delete_option('tt_refresh_token');
                delete_option('tt_auth_success');
            }
        }

        // refresh token handler, return access
        function refresh_token_handler()
        {
            $cookies[] = new WP_Http_Cookie(
                array(
                    'name' => 'refresh_token',
                    'value' => get_option('tt_refresh_token')
                )
            );

            $refresh_token_res = $this->api_call('GET', $this->get_route($this->router_class->get_refresh_token_route()), false, $cookies);

            $decoded_body = json_decode($refresh_token_res['body']);

            if (!empty($decoded_body) && !empty($decoded_body->data)) {
                update_option('tt_access_token', $decoded_body->data->access_token);
                update_option('tt_refresh_token', rawurlencode($this->get_refresh_token($refresh_token_res)));

                return $decoded_body->data->access_token;
            } else return false;
        }

        public function get_error()
        {
            return $this->errors;
        }

        /**
         * IE labels instead of placeholders
         *
         * @param $label_name
         * @return string
         */
        public function ie_labels($label_name)
        {
            global $is_IE;
            if ($is_IE)
                return '<label class="ie_label">' . $label_name . '</label>';
            else return '';
        }
    }
}
