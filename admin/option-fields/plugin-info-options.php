<?php

if (!function_exists('tt_get_plugin_info_options')) {
    /**
     * Function that return plugin info options
     * @return array
     *
     * @version 2.4.0
     */
    function tt_get_plugin_info_options()
    {
        $text_domain = TRIAGE_TRAK_TEXT_DOMAIN;

        return array(
            'name' => 'plugin_info',
            'title' => esc_html__('Plugin Information', $text_domain),
            'icon' => 'fa fa-external-link',
            'fields' => array(

                array(
                    'type' => 'content',
                    'content' => require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/admin/triage-trak-info-display.php',
                ),
            )
        );
    }
}
