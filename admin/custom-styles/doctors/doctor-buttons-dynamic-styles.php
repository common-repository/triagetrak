<?php

if (!function_exists('tt_doctor_buttons_dynamic_style')) {
    /**
     * Function that return dynamic styles for doctor buttons
     * @return string
     *
     * @version 2.4.0
     */
    function tt_doctor_buttons_dynamic_style()
    {
        // doctor typography
        $general_font = get_tt_main_settings()['general_font'];

        // doctor button
        $typography_doctors_btn = get_tt_main_settings()['typography_doctors_btn'];
        $doc_main_bg = get_tt_main_settings()['doctors_btn_bg'];
        $doc_second_bg = get_tt_main_settings()['doctors_btn_bs'];

        // doctor button border radius
        $doc_btn_radius = get_tt_main_settings()['doc_btn_radius'];
        $doc_btn_radius_top_left = $doc_btn_radius['btn_radius_top_left'];
        $doc_btn_radius_top_right = $doc_btn_radius['btn_radius_top_right'];
        $doc_btn_radius_bottom_left = $doc_btn_radius['btn_radius_bottom_left'];
        $doc_btn_radius_bottom_right = $doc_btn_radius['btn_radius_bottom_right'];

        // doctor button border
        $doc_btn_border = get_tt_main_settings()['doc_btn_border'];
        $doc_btn_top = $doc_btn_border['doc_btn_top'];
        $doc_btn_bottom = $doc_btn_border['doc_btn_bottom'];
        $doc_btn_left = $doc_btn_border['doc_btn_left'];
        $doc_btn_right = $doc_btn_border['doc_btn_right'];
        $doc_btn_border_style = $doc_btn_border['doc_btn_border_style'];
        $doc_btn_border_color = $doc_btn_border['doc_btn_border_color'];

        // doctors filter button
        $typography_filter_btn = get_tt_main_settings()['typography_filter_btn'];
        $filter_btn_bg = get_tt_main_settings()['filter_btn_bg'];
        $filter_btn_box_shadow = get_tt_main_settings()['filter_btn_bs'];

        // doctors filter button border radius
        $filter_btn_radius = get_tt_main_settings()['doc_filter_btn_radius'];
        $filter_btn_radius_top_left = $filter_btn_radius['btn_radius_top_left'];
        $filter_btn_radius_top_right = $filter_btn_radius['btn_radius_top_right'];
        $filter_btn_radius_bottom_left = $filter_btn_radius['btn_radius_bottom_left'];
        $filter_btn_radius_bottom_right = $filter_btn_radius['btn_radius_bottom_right'];

        // doctors filter button border
        $filter_btn_border = get_tt_main_settings()['doc_filter_btn_border'];
        $filter_btn_top = $filter_btn_border['doc_filter_btn_top'];
        $filter_btn_bottom = $filter_btn_border['doc_filter_btn_bottom'];
        $filter_btn_left = $filter_btn_border['doc_filter_btn_left'];
        $filter_btn_right = $filter_btn_border['doc_filter_btn_right'];
        $filter_btn_border_style = $filter_btn_border['doc_filter_btn_border_style'];
        $filter_btn_border_color = $filter_btn_border['doc_filter_btn_border_color'];

        return '
         body .tt_main_page .tt_location_page_class .tt_doctor_block .tt_doctor_link a,
         body .tt_main_page .tt_doctors_page_class .tt_doctor_block .tt_doctor_link a {
            font-family: ' . $general_font['family'] . '!important;
            font-size: ' . $typography_doctors_btn['size'] . 'px !important;
            line-height: ' . $typography_doctors_btn['height'] . 'px !important;
            color: ' . $typography_doctors_btn['color'] . '!important;
            background: ' . $doc_main_bg . '!important;
            box-shadow: inset 0px 34px 0px -15px ' . $doc_second_bg . ';
            border-color: ' . $doc_btn_border_color . '!important;
            border-top-width: ' . $doc_btn_top . 'px !important;
            border-bottom-width: ' . $doc_btn_bottom . 'px !important;
            border-left-width: ' . $doc_btn_left . 'px !important;
            border-right-width: ' . $doc_btn_right . 'px !important;
            border-style: ' . $doc_btn_border_style . '!important;
            border-top-right-radius: ' . $doc_btn_radius_top_right . 'px;
            border-top-left-radius: ' . $doc_btn_radius_top_left . 'px;
            border-bottom-right-radius: ' . $doc_btn_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $doc_btn_radius_bottom_left . 'px;
        }
        body .tt_main_page .tt_location_page_class .tt_doctor_block .tt_doctor_link a:hover,
        body .tt_main_page .tt_doctors_page_class .tt_doctor_block .tt_doctor_link a:hover {
            box-shadow: none;
            color: ' . $doc_main_bg . '!important;
            background: ' . $typography_doctors_btn['color'] . '!important;
            border-color: ' . $doc_main_bg . '!important;
            border-top-width: ' . $doc_btn_top . 'px !important;
            border-bottom-width: ' . $doc_btn_bottom . 'px !important;
            border-left-width: ' . $doc_btn_left . 'px !important;
            border-right-width: ' . $doc_btn_right . 'px !important;
            border-style: ' . $doc_btn_border_style . '!important;
        }
        body .tt_main_page .tt_doc_filter_block button {
            background: ' . $filter_btn_bg . ';
            border-color: ' . $filter_btn_border_color . '!important;
            border-top-width: ' . $filter_btn_top . 'px !important;
            border-bottom-width: ' . $filter_btn_bottom . 'px !important;
            border-left-width: ' . $filter_btn_left . 'px !important;
            border-right-width: ' . $filter_btn_right . 'px !important;
            border-style: ' . $filter_btn_border_style . '!important;
            border-top-right-radius: ' . $filter_btn_radius_top_right . 'px;
            border-top-left-radius: ' . $filter_btn_radius_top_left . 'px;
            border-bottom-right-radius: ' . $filter_btn_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $filter_btn_radius_bottom_left . 'px;
            font-family: ' . $general_font['family'] . '!important;
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
            font-size:' . $typography_filter_btn['size'] . 'px!important;
            line-height: ' . $typography_filter_btn['height'] . 'px!important;
            color: ' . $typography_filter_btn['color'] . ';
        }
        body .tt_main_page .tt_doc_filter_block button:hover {
            box-shadow: none;
            color: ' . $filter_btn_bg . ';
            background: ' . $typography_filter_btn['color'] . ';
            border-color: ' . $filter_btn_border_color . '!important;
            border-top-width: ' . $filter_btn_top . 'px !important;
            border-bottom-width: ' . $filter_btn_bottom . 'px !important;
            border-left-width: ' . $filter_btn_left . 'px !important;
            border-right-width: ' . $filter_btn_right . 'px !important;
            border-style: ' . $filter_btn_border_style . '!important;
            border-top-right-radius: ' . $filter_btn_radius_top_right . 'px;
            border-top-left-radius: ' . $filter_btn_radius_top_left . 'px;
            border-bottom-right-radius: ' . $filter_btn_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $filter_btn_radius_bottom_left . 'px;
        }
        body .tt_main_page .tt_doc_filter_block button.tt_clear_btn {
            box-shadow: none;
            background: ' . $typography_filter_btn['color'] . ';
            border: 1px solid' . $filter_btn_bg . '; 
            color: ' . $filter_btn_bg . '!important;
        }
         body .tt_main_page .tt_doc_filter_block button.tt_clear_btn:hover {
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
            color: ' . $typography_filter_btn['color'] . '!important;
            border: 1px solid' . $filter_btn_bg . '; 
            background: ' . $filter_btn_bg . '!important;
        }
        body .tt_main_page .tt_doc_filter_block .checkbox:checked + .checkbox_label::before {
            background: ' . $filter_btn_bg . ';
            border: 1px solid' . $filter_btn_bg . '; 
         }
        body .tt_main_page .tt_doc_filter_block .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
          color: ' . $typography_filter_btn['color'] . '!important;
         }
        body .tt_main_page .tt_doc_filter_block .select2-selection__choice,
        body .tt_main_page .tt_doc_filter_block .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: ' . $filter_btn_bg . '!important;
            border: 1px solid ' . $filter_btn_bg . '!important;
            color: ' . $typography_filter_btn['color'] . '!important;
        }
        body .tt_main_page .tt_doc_filter_block #alphabet-menu li.active {
          background: ' . $filter_btn_bg . '!important;;
        }
        body .tt_main_page .tt_doc_filter_block .select2-selection--single:after, 
        body .tt_main_page .tt_doc_filter_block .select2-container--default .select2-selection--multiple:after {
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
            background: ' . $filter_btn_bg . '!important;
        }
        body .tt_main_page .tt_doctors_page_class .tt_schedule_link,
        body .tt_main_page .tt_doctors_page_class .tt_single_doctor .tt_accordion li .tt_location_link a {
            color: ' . $typography_doctors_btn['color'] . '!important;
            background: ' . $doc_main_bg . '!important;
            box-shadow: inset 0px 34px 0px -15px ' . $doc_second_bg . ';
            border-color: ' . $doc_main_bg . '!important;
            border-top-width: ' . $doc_btn_top . 'px !important;
            border-bottom-width: ' . $doc_btn_bottom . 'px !important;
            border-left-width: ' . $doc_btn_left . 'px !important;
            border-right-width: ' . $doc_btn_right . 'px !important;
            border-style: ' . $doc_btn_border_style . '!important;
            border-top-right-radius: ' . $doc_btn_radius_top_right . 'px;
            border-top-left-radius: ' . $doc_btn_radius_top_left . 'px;
            border-bottom-right-radius: ' . $doc_btn_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $doc_btn_radius_bottom_left . 'px;
        }
        body .tt_main_page .tt_doctors_page_class .tt_schedule_link:hover,
        body .tt_main_page .tt_doctors_page_class .tt_single_doctor .tt_accordion li .tt_location_link a:hover {
            box-shadow: none;
            color: ' . $doc_main_bg . '!important;
            background: ' . $typography_doctors_btn['color'] . '!important;
            border-color: ' . $doc_main_bg . '!important;
            border-top-width: ' . $doc_btn_top . 'px !important;
            border-bottom-width: ' . $doc_btn_bottom . 'px !important;
            border-left-width: ' . $doc_btn_left . 'px !important;
            border-right-width: ' . $doc_btn_right . 'px !important;
            border-style: ' . $doc_btn_border_style . '!important;
            border-top-right-radius: ' . $doc_btn_radius_top_right . 'px;
            border-top-left-radius: ' . $doc_btn_radius_top_left . 'px;
            border-bottom-right-radius: ' . $doc_btn_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $doc_btn_radius_bottom_left . 'px;
        }';
    }
}