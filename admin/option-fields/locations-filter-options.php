<?php

if (!function_exists('tt_get_locations_filter_options')) {
    /**
     * Function that return locations filter options
     * @return array
     *
     * @version 2.4.0
     */
    function tt_get_locations_filter_options()
    {
        $text_domain = TRIAGE_TRAK_TEXT_DOMAIN;

        return array(
            'name' => 'filter_locations',
            'title' => esc_html__('Locations Filter', $text_domain),
            'icon' => 'fa fa-filter',
            'fields' => array(

                array(
                    'id' => 'loc_filter_options',
                    'type' => 'tap_list',
                    'title' => esc_html__('Choose Options for Filter', $text_domain),
                    'options' => array(
                        'alphabet' => esc_html__('Alphabet', $text_domain),
                        'departments' => esc_html__('Departments', $text_domain),
                        'zip_code' => esc_html__('Zip Code', $text_domain),
                    ),
                    'default' => array(
                        'departments',
                        'zip_code'
                    ),
                ),
                array(
                    'id' => 'loc_typography_filter',
                    'type' => 'typography',
                    'title' => esc_html__('Filter Typography', $text_domain),
                    'default' => array(
                        'size' => 18,
                        'height' => 20,
                        'color' => '#666666',
                    )
                ),
                array(
                    'id' => 'loc_typography_filter_btn',
                    'type' => 'typography',
                    'title' => esc_html__('Button Typography', $text_domain),
                    'default' => array(
                        'size' => 24,
                        'height' => 24,
                        'color' => '#ffffff',
                    )
                ),
                array(
                    'id' => 'loc_filter_btn_bg',
                    'type' => 'color',
                    'title' => esc_html__('Button Background', $text_domain),
                    'rgba' => true,
                    'default' => '#0071bc',
                ),
                array(
                    'id' => 'loc_filter_btn_bs',
                    'type' => 'color',
                    'title' => esc_html__('Button Second Background', $text_domain),
                    'rgba' => true,
                    'default' => '#3b92cb',
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'loc_filter_btn_border',
                    'title' => esc_html__('Button Border', $text_domain),
                    'description' => esc_html__('E.g.: use for border, but can be used for many things, link dimensions or spacing, etc...', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'id' => 'loc_filter_btn_top',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'loc_filter_btn_bottom',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'loc_filter_btn_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('left', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'loc_filter_btn_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('right', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'loc_filter_btn_border_style',
                            'type' => 'select',
                            'options' => array(
                                'none' => esc_html__('None', $text_domain),
                                'solid' => esc_html__('Solid', $text_domain),
                                'dashed' => esc_html__('Dashed', $text_domain),
                                'dotted' => esc_html__('Dotted', $text_domain),
                                'double' => esc_html__('Double', $text_domain),
                                'inset' => esc_html__('Inset', $text_domain),
                                'outset' => esc_html__('Outset', $text_domain),
                                'groove' => esc_html__('Groove', $text_domain),
                                'ridge' => esc_html__('ridge', $text_domain),
                            ),
                            'default' => 'none',
                            'class' => 'chosen width-150',
                        ),
                        array(
                            'id' => 'loc_filter_btn_border_color',
                            'type' => 'color',
                            'rgba' => true,
                            'default' => '#ffffff',
                        ),
                    ),
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'loc_filter_btn_radius',
                    'title' => esc_html__('Button Border Radius', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(

                        array(
                            'id' => 'btn_radius_top_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top-left ', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'btn_radius_top_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top-right ', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'btn_radius_bottom_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom-left', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'btn_radius_bottom_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom-right', $text_domain),
                            ),
                            'default' => 0,
                        ),

                    ),
                ),
            )
        );
    }
}
