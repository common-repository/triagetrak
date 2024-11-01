<?php

namespace TriageTrak\Modules\LocationsList;

use TriageTrak\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Adds new shortcode "LocationsList" and registers it to
 * the WPBakery Visual Composer plugin
 *
 * @since      2.4.0
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */
class LocationsList implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct()
    {
        $this->base = 'tt_locations_list';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        vc_map(array(
            'name' => esc_html__('Locations List', TRIAGE_TRAK_TEXT_DOMAIN),
            'description' => esc_html__('Place WebSitter Pro locations list', TRIAGE_TRAK_TEXT_DOMAIN),
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
                        esc_html__('Locations list with photo', TRIAGE_TRAK_TEXT_DOMAIN) => 'loc_list_photo',
                        esc_html__('Locations list with photo (small)', TRIAGE_TRAK_TEXT_DOMAIN) => 'loc_list_photo_small',
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
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', TRIAGE_TRAK_TEXT_DOMAIN),
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Map', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_map',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'admin_label' => true,
                    'save_always' => true,
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
                    'admin_label' => true,
                    'save_always' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                    'dependency' => array('element' => 'show_paginate', 'value' => '1')
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Address', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_address',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'admin_label' => true,
                    'save_always' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Limit Address', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'limit_address',
                    'value' => array(esc_html__('Yes', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'description' => 'Show address in one line if there are so long',
                    'admin_label' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                    'dependency' => array('element' => 'show_address', 'value' => '1')
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Phone', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_phone',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'admin_label' => true,
                    'save_always' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Link Button', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'show_link_button',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'save_always' => true,
                    'admin_label' => true,
                    'group' => esc_html__('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN),
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
            'el_class' => '',
            'list_type' => 'loc_list_photo',
            'per_page' => '8',
            'grid_columns' => '',
            'show_map' => '',
            'show_paginate'=>'',
            'show_filter' => '',
            'show_address' => '',
            'limit_address' => '',
            'show_phone' => '',
            'show_link_button' => '',
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $args = array(
            'post_type' => T_T_LOCATION_POST_TYPE,
            'post_status' => 'publish',
            'posts_per_page' => $params['per_page'],
        );

        $list_class = $this->get_list_classes($params);
        $params['list_class'] = $list_class;

        return tt_get_api_template_part(get_shortcode_template_path() . 'locations-list/templates/locations-list-template', $params, $args);
    }

    /**
     * Generates list classes
     *
     * @param $params
     *
     * @return string
     */
    function get_list_classes($params)
    {
        $list_class = '';
        $list_type = $params['list_type'];
        switch ($list_type) {
            case 'loc_list_photo':
                $list_class .= 'loc_list_photo';
                break;
            case 'loc_list_photo_small':
                $list_class .= 'loc_list_photo_small';
                break;
            default:
                $list_class .= 'loc_list_photo';
        }

        $add_class = $params['el_class'];
        if ($add_class !== '') {
            $list_class .= ' ' . $add_class;
        }

        return $list_class;
    }
}