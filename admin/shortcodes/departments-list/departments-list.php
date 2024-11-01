<?php

namespace TriageTrak\Modules\DepartmentsList;

use TriageTrak\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Adds new shortcode "DepartmentsList" and registers it to
 * the WPBakery Visual Composer plugin
 *
 * @since      2.4.0
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */
class DepartmentsList implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct()
    {
        $this->base = 'tt_departments_list';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap()
    {
        vc_map(array(
            'name' => esc_html__('Departments List', TRIAGE_TRAK_TEXT_DOMAIN),
            'description' => esc_html__('Place WebSitter Pro departments list', TRIAGE_TRAK_TEXT_DOMAIN),
            'base' => $this->getBase(),
            'category' => __('by WebSitter Pro', TRIAGE_TRAK_TEXT_DOMAIN),
            'icon' => 'vc_tt_shortcode_icon',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'el_class',
                    'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', TRIAGE_TRAK_TEXT_DOMAIN)
                ),
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => esc_html__('Departments count', TRIAGE_TRAK_TEXT_DOMAIN),
                    'param_name' => 'departments_count',
                    'description' => '',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Link Target', 'tt-press'),
                    'param_name' => 'target',
                    'value' => array(
                        esc_html__('Self', TRIAGE_TRAK_TEXT_DOMAIN) => '_self',
                        esc_html__('Blank', TRIAGE_TRAK_TEXT_DOMAIN) => '_blank'
                    ),
                    'save_always' => true,
                    'admin_label' => true
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
            'el_class' =>'',
            'departments_count' => '100',
            'target' => '',

        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

        return tt_get_api_template_part(get_shortcode_template_path() . 'departments-list/templates/departments-list-template', $params);
    }
}
