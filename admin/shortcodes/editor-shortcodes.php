<?php

if (!function_exists('wc_shortcodes_scripts')) {
    /**
     * Function that initialize styles for shortcode part
     * @return void
     *
     * @version 2.4.0
     */
    function wc_shortcodes_scripts()
    {
        wp_enqueue_style('vc_shortcodes_stylesheet', TRIAGE_TRAK_BASE_URL . 'admin/shortcodes/assets/vc-shortcodes.css');
    }

    add_action('admin_enqueue_scripts', 'wc_shortcodes_scripts');
}

if (!function_exists('tt_dropdown_multi_settings_field')) {
// Create multi dropdown param type

    function tt_dropdown_multi_settings_field($param, $value)
    {
        $param_line = '';
        $param_line .= '<select  multiple name="' . esc_attr($param['param_name']) . '" class="wpb_vc_param_value wpb-input wpb-select selectpicker ' . esc_attr($param['param_name']) . ' ' . esc_attr($param['type']) . '">';
        foreach ($param['value'] as $text_val => $val) {
            if (is_numeric($text_val) && (is_string($val) || is_numeric($val))) {
                $text_val = $val;
            }
            $text_val = __($text_val, "js_composer");
            $selected = '';

            if (!is_array($value)) {
                $param_value_arr = explode(',', $value);
            } else {
                $param_value_arr = $value;
            }

            if ($value !== '' && in_array($val, $param_value_arr)) {
                $selected = ' selected="selected"';
            }
            $param_line .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . $text_val . '</option>';
        }
        $param_line .= '</select>';

        return $param_line;
    }

    if (tt_visual_composer_installed()) {
        vc_add_shortcode_param('dropdown_multi', 'tt_dropdown_multi_settings_field');
    }
}

if (!function_exists('tt_get_inline_attr')) {
    /**
     * @param $value
     * @param $attr
     * @param string $glue
     * @return string
     */
    function tt_get_inline_attr($value, $attr, $glue = '')
    {
        $properties = '';

        if (!empty($value)) {

            if (is_array($value) && count($value)) {
                $properties = implode($glue, $value);
            } elseif ($value !== '') {
                $properties = $value;
            }

            return $attr . '="' . esc_attr($properties) . '"';
        }

        return '';
    }
}
