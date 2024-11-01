<?php

if (!function_exists('tt_get_doctors_list_options')) {
    /**
     * Function that return doctors list options
     * @return array
     *
     * @version 2.4.0
     */
    function tt_get_doctors_list_options()
    {
        $text_domain = TRIAGE_TRAK_TEXT_DOMAIN;

        return array(
            'name' => 'output_info',
            'title' => esc_html__('Our Team', $text_domain),
            'icon' => 'fa fa-users',
            'fields' => array(
                array(
                    'id' => 'typography_doctors',
                    'type' => 'typography',
                    'title' => esc_html__('Doctors Typography', $text_domain),
                    'default' => array(
                        'size' => 24,
                        'height' => 30,
                        'color' => '#0071bc',
                    )
                ),
                array(
                    'id' => 'doctors_sub_title',
                    'type' => 'typography',
                    'title' => esc_html__('Doctors Credential', $text_domain),
                    'default' => array(
                        'size' => 20,
                        'height' => 24,
                        'color' => '#000000',
                    )
                ),
                array(
                    'id' => 'doc_card_back_color',
                    'type' => 'color',
                    'title' => esc_html__('Doctor Card Background Color', $text_domain),
                    'rgba' => true,
                    'default' => '#f2f2f2',
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'card_border',
                    'title' => esc_html__('Doctor Card Border', $text_domain),
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
                            'default' => 1,
                        ),

                        array(
                            'id' => 'card_bottom',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom', $text_domain),
                            ),
                            'default' => 1,
                        ),

                        array(
                            'id' => 'card_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('left', $text_domain),
                            ),
                            'default' => 1,
                        ),

                        array(
                            'id' => 'card_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('right', $text_domain),
                            ),
                            'default' => 1,
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
                            'default' => '#dedede',
                        ),

                    ),
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'card_border_radius',
                    'title' => esc_html__('Doctor Card Border Radius', $text_domain),
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
                array(
                    'id' => 'typography_doctors_btn',
                    'type' => 'typography',
                    'title' => esc_html__('Button Typography', $text_domain),
                    'default' => array(
                        'size' => 18,
                        'height' => 23,
                        'color' => '#ffffff',
                    )
                ),
                array(
                    'id' => 'doctors_btn_bg',
                    'type' => 'color',
                    'title' => esc_html__('Button Background', $text_domain),
                    'rgba' => true,
                    'default' => '#0071bc',
                ),
                array(
                    'id' => 'doctors_btn_bs',
                    'type' => 'color',
                    'title' => esc_html__('Button Second Background', $text_domain),
                    'rgba' => true,
                    'default' => '#3b92cb',
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'doc_btn_border',
                    'title' => esc_html__('Button Border', $text_domain),
                    'description' => esc_html__('E.g.: use for border, but can be used for many things, link dimensions or spacing, etc...', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'id' => 'doc_btn_top',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_btn_bottom',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_btn_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('left', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_btn_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('right', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_btn_border_style',
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
                            'id' => 'doc_btn_border_color',
                            'type' => 'color',
                            'rgba' => true,
                            'default' => '#ffffff',
                        ),
                    ),
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'doc_btn_radius',
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
                array(
                    'id' => 'doctors_css',
                    'type' => 'ace_editor',
                    'title' => esc_html__('Inline Styles', $text_domain),
                    'options' => array(
                        'theme' => 'ace/theme/chrome',
                        'mode' => 'ace/mode/css',
                        'showGutter' => true,
                        'showPrintMargin' => true,
                        'enableBasicAutocompletion' => true,
                        'enableSnippets' => true,
                        'enableLiveAutocompletion' => true,
                    ),
                    'attributes' => array(
                        'style' => 'height: 200px; max-width: 700px;',
                    ),
                ),
            )
        );
    }
}
