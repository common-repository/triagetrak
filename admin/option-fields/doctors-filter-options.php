<?php

if (!function_exists('tt_get_doctors_filter_options')) {
    /**
     * Function that return doctors filter options
     * @return array
     *
     * @version 2.4.0
     */
    function tt_get_doctors_filter_options()
    {
        $text_domain = TRIAGE_TRAK_TEXT_DOMAIN;

        return array(
            'name' => 'filter',
            'title' => esc_html__('Doctors Filter', $text_domain),
            'icon' => 'fa fa-filter',
            'fields' => array(

                array(
                    'id' => 'filter_options',
                    'type' => 'tap_list',
                    'title' => esc_html__('Choose Options for Filter', $text_domain),
                    'options' => array(
                        'alphabet' => esc_html__('Alphabet', $text_domain),
                        'doctors' => esc_html__('Doctors', $text_domain),
                        'languages' => esc_html__('Languages', $text_domain),
                        'body_parts' => esc_html__('Body Parts', $text_domain),
                        'departments' => esc_html__('Departments', $text_domain),
                        'sub_specialties' => esc_html__('Sub Specialty', $text_domain),
                        'conditions' => esc_html__('Conditions', $text_domain),
                        'procedures' => esc_html__('Procedures', $text_domain),
                        'insurances' => esc_html__('Insurances', $text_domain),
                        'injury_types' => esc_html__('Injury Types', $text_domain),
                        'patient_ages' => esc_html__('Patient Ages', $text_domain),
                        'zip_code' => esc_html__('Zip Code', $text_domain),
                        'accept_new_patients' => esc_html__('Accepting New Patients', $text_domain),
                    ),
                    'default' => array(
                        'doctors',
                        'languages',
                        'body_parts'
                    ),
                ),
                array(
                    'id' => 'typography_filter',
                    'type' => 'typography',
                    'title' => esc_html__('Filter Typography', $text_domain),
                    'default' => array(
                        'size' => 18,
                        'height' => 20,
                        'color' => '#666666',
                    )
                ),
                array(
                    'id' => 'filter_btn_bg',
                    'type' => 'color',
                    'title' => esc_html__('Button Background', $text_domain),
                    'rgba' => true,
                    'default' => '#0071bc',
                ),
                array(
                    'id' => 'filter_btn_bs',
                    'type' => 'color',
                    'title' => esc_html__('Button Second Background', $text_domain),
                    'rgba' => true,
                    'default' => '#3b92cb',
                ),
                array(
                    'id' => 'typography_filter_btn',
                    'type' => 'typography',
                    'title' => esc_html__('Button Typography', $text_domain),
                    'default' => array(
                        'size' => 24,
                        'height' => 24,
                        'color' => '#ffffff',
                    )
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'doc_filter_btn_border',
                    'title' => esc_html__('Button Border', $text_domain),
                    'description' => esc_html__('E.g.: use for border, but can be used for many things, link dimensions or spacing, etc...', $text_domain),
                    'options' => array(
                        'cols' => 2,
                    ),
                    'fields' => array(
                        array(
                            'id' => 'doc_filter_btn_top',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-up',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('top', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_filter_btn_bottom',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-down',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('bottom', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_filter_btn_left',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-left',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('left', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_filter_btn_right',
                            'type' => 'text',
                            'prepend' => 'fa fa-long-arrow-right',
                            'append' => 'px',
                            'attributes' => array(
                                'placeholder' => esc_html__('right', $text_domain),
                            ),
                            'default' => 0,
                        ),
                        array(
                            'id' => 'doc_filter_btn_border_style',
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
                            'id' => 'doc_filter_btn_border_color',
                            'type' => 'color',
                            'rgba' => true,
                            'default' => '#ffffff',
                        ),
                    ),
                ),
                array(
                    'type' => 'fieldset',
                    'id' => 'doc_filter_btn_radius',
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
