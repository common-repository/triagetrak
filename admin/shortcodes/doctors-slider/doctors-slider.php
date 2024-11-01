<?php

namespace TriageTrak\Modules\DoctorsSlider;

use TriageTrak\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Adds new shortcode "DoctorsSlider" and registers it to
 * the WPBakery Visual Composer plugin
 *
 * @since      2.4.0
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */
class DoctorsSlider implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct()
    {
        $this->base = 'tt_doctors_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        vc_map(array(
            'name' => esc_html__('Doctors List Carousel', TRIAGE_TRAK_TEXT_DOMAIN),
            'description' => esc_html__('WebSitter Pro doctors list in carousel', TRIAGE_TRAK_TEXT_DOMAIN),
            'base' => $this->getBase(),
            'category' => __('by WebSitter Pro', TRIAGE_TRAK_TEXT_DOMAIN),
            'icon' => 'vc_tt_shortcode_icon',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => esc_html__('Number of Slides', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'number_of_doctors',
                    'description' => '',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => esc_html__('Number of Columns', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'doctors_columns',
                    'value' => array(
                        esc_html__('Four columns', TRIAGE_TRAK_TEXT_DOMAIN) => 4,
                        esc_html__('Three columns', TRIAGE_TRAK_TEXT_DOMAIN) => 3,
                        esc_html__('Two columns', TRIAGE_TRAK_TEXT_DOMAIN) => 2,
                    ),
                    'save_always' => true,
                    'description' => '',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__('Order By', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'order_by',
                    'value' => array(
                        esc_html__('Title', TRIAGE_TRAK_TEXT_DOMAIN) => 'title',
                        esc_html__('Date', TRIAGE_TRAK_TEXT_DOMAIN) => 'date'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__('Order', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'order',
                    'value' => array(
                        esc_html__('ASC', TRIAGE_TRAK_TEXT_DOMAIN) => 'ASC',
                        esc_html__('DESC', TRIAGE_TRAK_TEXT_DOMAIN) => 'DESC'
                    ),
                    'save_always' => true,
                    'description' => ''
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
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Space Between Cards (px)', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'separation',
                    'admin_label' => true,
                    'value' => '',
                    'save_always' => true,
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Slide Duration (ms)', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'duration',
                    'admin_label' => true,
                    'value' => '',
                    'save_always' => true,
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Autoplay', 'tt-press'),
                    'param_name' => 'autoplay',
                    'value' => array(esc_html__('Autoplay', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Dots', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'dots',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Show Navs', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'navs',
                    'value' => array(esc_html__('Show', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'heading' => esc_html__('Infinity loop', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'loop',
                    'value' => array(esc_html__('Loop', TRIAGE_TRAK_TEXT_DOMAIN) => 1),
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => esc_html__('Animation speed', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'animation_speed',
                    'value' => '',
                    'description' => esc_html__('Speed of slide animation in milliseconds', TRIAGE_TRAK_TEXT_DOMAIN),
                    'group' => esc_html__('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN),
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
            'number_of_doctors' => '-1',
            'doctors_columns' => '3',
            'order_by' => '',
            'order' => '',
            'show_link_button' => '',
            'show_doc_conditions' => '',
            'limit_conditions' => '',
            'section_padding' => '',
            'separation' => '',
            'duration' => '',
            'autoplay' => '',
            'dots' => '',
            'navs' => '',
            'loop' => '',
            'animation_speed' => '',
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $args = array(
            'post_type' => T_T_DOCTOR_POST_TYPE,
            'post_status' => 'publish',
            'orderby' => $params['order_by'],
            'order' => $params['order'],
            'posts_per_page' => $params['number_of_doctors'],
        );


        return tt_get_api_template_part(get_shortcode_template_path() . 'doctors-slider/templates/doctors-slider-template', $params, $args);
    }

}
