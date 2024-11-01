<?php

if (!function_exists('tt_get_general_options')) {
    /**
     * Function that return general options
     * @return array
     *
     * @version 2.4.0
     */
    function tt_get_general_options()
    {
        $text_domain = TRIAGE_TRAK_TEXT_DOMAIN;

        return array(
            'name' => 'general_info',
            'title' => esc_html__('General', $text_domain),
            'icon' => 'dashicons-admin-generic',
            'fields' => array(

                array(
                    'id' => 'btn_doc_list',
                    'type' => 'button',
                    'title' => esc_html__('Generate Doctors List Shortcode', $text_domain),
                    'options' => array(
                        'href' => '#',
                        'target' => '_self',
                        'value' => 'Generate',
                        'btn-class' => 'exopite-sof-btn tt_doc_list_open',
                    ),
                ),
                array(
                    'type' => 'content',
                    'content' => require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/modals/doctors-shortcode-form.php',
                ),
                array(
                    'id' => 'btn_doc_slider',
                    'type' => 'button',
                    'title' => esc_html__('Generate Doctors Carousel Shortcode', $text_domain),
                    'options' => array(
                        'href' => '#',
                        'target' => '_self',
                        'value' => 'Generate',
                        'btn-class' => 'exopite-sof-btn tt_doc_slider_open',
                    ),
                ),
                array(
                    'type' => 'content',
                    'content' => require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/modals/doctors-slider-shortcode-form.php',
                ),
                array(
                    'id' => 'btn_loc_list',
                    'type' => 'button',
                    'title' => esc_html__('Generate Locations List Shortcode', $text_domain),
                    'options' => array(
                        'href' => '#',
                        'target' => '_self',
                        'value' => 'Generate',
                        'btn-class' => 'exopite-sof-btn tt_loc_list_open',
                    ),
                ),
                array(
                    'type' => 'content',
                    'content' => require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/modals/locations-shortcode-form.php',
                ),
                array(
                    'id' => 'btn_dep_list',
                    'type' => 'button',
                    'title' => esc_html__('Generate Departments List Shortcode', $text_domain),
                    'options' => array(
                        'href' => '#',
                        'target' => '_self',
                        'value' => 'Generate',
                        'btn-class' => 'exopite-sof-btn tt_dep_list_open',
                    ),
                ),
                array(
                    'type' => 'content',
                    'content' => require_once TRIAGE_TRAK_BASE_DIR . 'admin/view/modals/departments-shortcode-form.php',
                ),
                array(
                    'type' => 'notice',
                    'class' => 'warning',
                    'content' => __('Please use both shortcodes for <b>Doctors</b> and <b>Locations</b> as they are dependent on each other and have links for redirects', $text_domain),
                ),
                array(
                    'id' => 'general_font',
                    'type' => 'font',
                    'title' => esc_html__('General Fonts', $text_domain),
                    'default' => array(
                        'family' => '',
                        'variant' => '',
                    ),
                )
            )
        );
    }
}
