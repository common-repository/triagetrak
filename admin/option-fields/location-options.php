<?php

if (!function_exists('tt_get_location_options')) {
    /**
     * Function that return location options
     * @return array
     *
     * @version 2.4.0
     */
    function tt_get_location_options()
    {
        $text_domain = TRIAGE_TRAK_TEXT_DOMAIN;

        return array(
            'name' => 'location',
            'title' => esc_html__('Location Page', $text_domain),
            'icon' => 'fa fa-map-marker',
            'fields' => array(
                array(
                    'id' => 'tt_schedule',
                    'type' => 'text',
                    'title' => esc_html__('Schedule link', $text_domain),
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'loc_photo',
                    'title' => esc_html__('Location Photo', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'type' => 'number',
                            'id' => 'border_radius',
                            'title' => esc_html__('Border Radius', $text_domain),
                            'prepend' => 'fa fa-arrows-alt',
                            'append' => '%',
                            'default' => '0',
                            'min' => '0',
                            'max' => '50',
                            'step' => '1',
                        ),
                    )
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'loc_photo_border',
                    'title' => esc_html__('Location Photo Border', $text_domain),
                    'description' => esc_html__('E.g.: use for border, but can be used for many things, link dimensions or spacing, etc...', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'id' => 'photo_top',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top', $text_domain),
                            ),
                            'default' => 1,
                        ),

                        array(
                            'id' => 'photo_bottom',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom', $text_domain),
                            ),
                            'default' => 1,
                        ),

                        array(
                            'id' => 'photo_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('left', $text_domain),
                            ),
                            'default' => 1,
                        ),

                        array(
                            'id' => 'photo_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('right', $text_domain),
                            ),
                            'default' => 1,
                        ),

                        array(
                            'id' => 'photo_border_style',
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
                            'default' => 'solid',
                            'class' => 'chosen width-150',
                        ),

                        array(
                            'id' => 'photo_border_color',
                            'type' => 'color',
                            'rgba' => true,
                            'default' => '#dedede',
                        ),
                    ),
                ),
                array(
                    'id' => 'loc_main_title',
                    'type' => 'typography',
                    'title' => esc_html__('Location Main Title', $text_domain),
                    'default' => array(
                        'size' => 29,
                        'height' => 50,
                        'color' => '#0071bc',
                    )
                ),
                array(
                    'id' => 'loc_block_title',
                    'type' => 'typography',
                    'title' => esc_html__('Location Title Section', $text_domain),
                    'default' => array(
                        'size' => 24,
                        'height' => 32,
                        'color' => '#0071bc',
                    )
                ),
                array(
                    'id' => 'loc_block_text',
                    'type' => 'typography',
                    'title' => esc_html__('Location Content Section', $text_domain),
                    'default' => array(
                        'size' => 18,
                        'height' => 27,
                        'color' => '#000000',
                    )
                ),
                array(
                    'id' => 'loc_card_info_back_color',
                    'type' => 'color',
                    'title' => esc_html__('Location Card Info Background Color', $text_domain),
                    'rgba' => true,
                    'default' => '#f8f8f8',
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'loc_card_info_border',
                    'title' => esc_html__('Location Card Info Border', $text_domain),
                    'description' => esc_html__('E.g.: use for border, but can be used for many things, link dimensions or spacing, etc...', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'id' => 'card_top',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'card_bottom',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'card_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('left', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'card_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('right', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'card_border_style',
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
                            'default' => 'solid',
                            'class' => 'chosen width-150',
                        ),

                        array(
                            'id' => 'card_border_color',
                            'type' => 'color',
                            'rgba' => true,
                            'default' => '#efefef',
                        ),
                    ),
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'loc_card_info_border_radius',
                    'title' => esc_html__('Location Card Info Border Radius', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'id' => 'radius_top_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top-left ', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'radius_top_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top-right ', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'radius_bottom_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom-left', $text_domain),
                            ),
                            'default' => 0,
                        ),

                        array(
                            'id' => 'radius_bottom_right',
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
