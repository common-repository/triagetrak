<?php

namespace TriageTrak\Modules\DoctorsList;

use TriageTrak\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Adds new shortcode "DoctorsList" and registers it to
 * the WPBakery Visual Composer plugin
 *
 * @since      2.4.0
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */
class DoctorsList implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct()
    {
        $this->base = 'tt_doctors_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        vc_map(array(
            'name' => esc_html__('Doctors List', TRIAGE_TRAK_TEXT_DOMAIN),
            'description' => esc_html__('Place WebSitter Pro doctors list', TRIAGE_TRAK_TEXT_DOMAIN),
            'base' => $this->getBase(),
            'category' => __('by WebSitter Pro', TRIAGE_TRAK_TEXT_DOMAIN),
            'icon' => 'vc_tt_shortcode_icon',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => esc_html__('List Type', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'list_type',
                    'value' => array(
                        esc_html__('Doctors list with photo', TRIAGE_TRAK_TEXT_DOMAIN) => 'doc_list_photo',
                        esc_html__('Doctors list with photo (small)', TRIAGE_TRAK_TEXT_DOMAIN) => 'doc_list_photo_small',
                    ),
                    'save_always' => true,
                    'description' => '',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => esc_html__('Number of Cards Per Page', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'per_page',
                    'description' => '',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => esc_html__('Number of Grid Columns', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'grid_columns',
                    'value' => array(
                        esc_html__('Four columns', TRIAGE_TRAK_TEXT_DOMAIN) => 'four',
                        esc_html__('Three columns', TRIAGE_TRAK_TEXT_DOMAIN) => 'three',
                        esc_html__('Two columns', TRIAGE_TRAK_TEXT_DOMAIN) => 'two',
                        esc_html__('One column', TRIAGE_TRAK_TEXT_DOMAIN) => 'one',
                    ),
                    'save_always' => true,
                    'description' => '',
                    'admin_label' => true,
                ),

                // Section Settings
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Choose departments to filter the list", TRIAGE_TRAK_TEXT_DOMAIN),
                    "param_name" => "doc_departments",
                    "value" => $this->get_departments_list(),
                    'description' => '',
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Choose conditions to filter the list", TRIAGE_TRAK_TEXT_DOMAIN),
                    "param_name" => "doc_conditions",
                    "value" => $this->get_conditions_list(),
                    'description' => '',
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Choose procedures to filter the list", TRIAGE_TRAK_TEXT_DOMAIN),
                    "param_name" => "doc_procedures",
                    "value" => $this->get_procedures_list(),
                    'description' => '',
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Paginate', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_paginate',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'description' => ' to add a filter, you have to choose show paginate',
                    'admin_label' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Filter', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_filter',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'admin_label' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                    'dependency' => array('element' => 'show_paginate', 'value' => '1'),
                ),

                // Card Settings
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', TRIAGE_TRAK_TEXT_DOMAIN),
                    'group' => esc_html__('Card Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Link Button', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_link_button',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'admin_label' => true,
                    'group' => esc_html__('Card Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Doctor Conditions', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_doc_conditions',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'admin_label' => true,
                    'group' => esc_html__('Card Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Limit Conditions', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'limit_conditions',
                    'value' => array(esc_html__('Yes', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'description' => 'Show conditions in one line if there are many',
                    'admin_label' => true,
                    'group' => esc_html__('Card Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                    'dependency' => array('element' => 'show_doc_conditions', 'value' => '1'),
                ),
            ),
        ));
    }

    /**
     * Shortcode output
     * @param $atts
     * @param null $content
     * @return string
     */
    public function render($atts, $content = null)
    {
        $default_atts = array(
            'doc_departments' => '',
            'doc_conditions' => '',
            'doc_procedures' => '',
            'el_class' => '',
            'list_type' => 'doc_list_photo',
            'per_page' => '8',
            'grid_columns' => '',
            'show_paginate' => '',
            'show_filter' => '',
            'show_link_button' => '',
            'show_doc_conditions' => '',
            'limit_conditions' => '',
            'hospital_affiliations' => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $args = array(
            'post_type' => T_T_DOCTOR_POST_TYPE,
            'post_status' => 'publish',
            'posts_per_page' => $params['per_page'],
            'meta_key' => 'dnd_order',
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );

        $list_class = $this->get_list_classes($params);
        $params['list_class'] = $list_class;

        if ( !empty($params['doc_departments']) || !empty($params['doc_conditions']) || !empty($params['doc_procedures']) || !empty($params['hospital_affiliations'])) {

            $args['tax_query'] = array('relation' => 'AND');

            if (!empty($params['doc_departments'])) {

                $args['tax_query'][] = array(
                    'taxonomy' => 'departments',
                    'field' => 'slug',
                    'terms' => $params['doc_departments'],
                );
            }

            if (!empty($params['doc_conditions'])) {

                $args['tax_query'][] = array(
                    'taxonomy' => 'conditions',
                    'field' => 'slug',
                    'terms' => $params['doc_conditions'],
                );
            }

            if (!empty($params['doc_procedures'])) {

                $args['tax_query'][] = array(
                    'taxonomy' => 'procedures',
                    'field' => 'slug',
                    'terms' => $params['doc_procedures'],
                );
            }


            if (!empty($params['hospital_affiliations'])) {

                $args['tax_query'][] = array(
                    'taxonomy' => 'hospital_affiliations_tax',
                    'field' => 'name',
                    'terms' => $params['hospital_affiliations']
                );
            }

        }
        return tt_get_api_template_part(get_shortcode_template_path() . 'doctors-list/templates/doctors-list-template', $params, $args);
    }

    /**
     * Generates list classes
     *
     * @param $params
     *
     * @return string
     */
    private function get_list_classes($params)
    {
        $list_class = '';
        $list_type = $params['list_type'];
        switch ($list_type) {
            case 'doc_list_photo':
                $list_class .= 'doc_list_photo';
                break;
            case 'doc_list_photo_small':
                $list_class .= 'doc_list_photo_small';
                break;
            default:
                $list_class .= 'doc_list_photo';
        }

        $add_class = $params['el_class'];
        if ($add_class !== '') {
            $list_class .= ' ' . $add_class;
        }

        return $list_class;
    }

    private function get_departments_list()
    {
        return tt_get_filter_options(get_terms(array('taxonomy' => 'departments', 'hide_empty' => false)));
    }

    private function get_conditions_list()
    {
        return tt_get_filter_options(get_terms(array('taxonomy' => 'conditions', 'hide_empty' => false)));
    }

    private function get_procedures_list()
    {
        return tt_get_filter_options(get_terms(array('taxonomy' => 'procedures', 'hide_empty' => false)));
    }
}
