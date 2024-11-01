<?php

if (!function_exists('tt_location_buttons_dynamic_style')) {
    /**
     * Function that return dynamic styles for location buttons
     * @return string
     *
     * @version 2.4.0
     */
    function tt_location_buttons_dynamic_style()
    {
        // location typography
        $general_font = get_tt_main_settings()['general_font'];

        // location button
        $typography_location_btn = get_tt_main_settings()['typography_location_btn'];
        $location_btn_bg = get_tt_main_settings()['location_btn_bg'];
        $location_btn_box_shadow = get_tt_main_settings()['location_btn_bs'];

        // location button border radius
        $loc_btn_radius = get_tt_main_settings()['loc_btn_radius'];
        $loc_btn_radius_top_left = $loc_btn_radius['btn_radius_top_left'];
        $loc_btn_radius_top_right = $loc_btn_radius['btn_radius_top_right'];
        $loc_btn_radius_bottom_left = $loc_btn_radius['btn_radius_bottom_left'];
        $loc_btn_radius_bottom_right = $loc_btn_radius['btn_radius_bottom_right'];

        // location button border
        $loc_btn_border = get_tt_main_settings()['loc_btn_border'];
        $loc_btn_top = $loc_btn_border['loc_btn_top'];
        $loc_btn_bottom = $loc_btn_border['loc_btn_bottom'];
        $loc_btn_left = $loc_btn_border['loc_btn_left'];
        $loc_btn_right = $loc_btn_border['loc_btn_right'];
        $loc_btn_border_style = $loc_btn_border['loc_btn_border_style'];
        $loc_btn_border_color = $loc_btn_border['loc_btn_border_color'];

        // locations filter button
        $typography_filter_btn = get_tt_main_settings()['loc_typography_filter_btn'];
        $filter_btn_bg = get_tt_main_settings()['loc_filter_btn_bg'];
        $filter_btn_box_shadow = get_tt_main_settings()['loc_filter_btn_bs'];

        // locations filter button border radius
        $filter_btn_radius = get_tt_main_settings()['loc_filter_btn_radius'];
        $filter_btn_radius_top_left = $filter_btn_radius['btn_radius_top_left'];
        $filter_btn_radius_top_right = $filter_btn_radius['btn_radius_top_right'];
        $filter_btn_radius_bottom_left = $filter_btn_radius['btn_radius_bottom_left'];
        $filter_btn_radius_bottom_right = $filter_btn_radius['btn_radius_bottom_right'];

        // locations filter button border
        $filter_btn_border = get_tt_main_settings()['loc_filter_btn_border'];
        $filter_btn_top = $filter_btn_border['loc_filter_btn_top'];
        $filter_btn_bottom = $filter_btn_border['loc_filter_btn_bottom'];
        $filter_btn_left = $filter_btn_border['loc_filter_btn_left'];
        $filter_btn_right = $filter_btn_border['loc_filter_btn_right'];
        $filter_btn_border_style = $filter_btn_border['loc_filter_btn_border_style'];
        $filter_btn_border_color = $filter_btn_border['loc_filter_btn_border_color'];

        return '
        body .tt_main_page .tt_location_page_class .tt_get_directions,
        body .tt_main_page .loc_map_list_container_class .tt_get_directions,
        body .tt_main_page .tt_location_page_class .tt_location_link a {
            font-family: ' . $general_font['family'] . '!important;
            font-size: ' . $typography_location_btn['size'] . 'px !important;
            line-height: ' . $typography_location_btn['height'] . 'px !important;
            color: ' . $typography_location_btn['color'] . '!important;
            border-color: ' . $loc_btn_border_color . '!important;
            border-top-width: ' . $loc_btn_top . 'px !important;
            border-bottom-width: ' . $loc_btn_bottom . 'px !important;
            border-left-width: ' . $loc_btn_left . 'px !important;
            border-right-width: ' . $loc_btn_right . 'px !important;
            border-style: ' . $loc_btn_border_style . '!important;
            border-top-right-radius: ' . $loc_btn_radius_top_right . 'px !important;
            border-top-left-radius: ' . $loc_btn_radius_top_left . 'px !important;
            border-bottom-right-radius: ' . $loc_btn_radius_bottom_right . 'px !important;
            border-bottom-left-radius: ' . $loc_btn_radius_bottom_left . 'px !important;
            background: ' . $location_btn_bg . '!important;
            box-shadow: inset 0px 34px 0px -15px ' . $location_btn_box_shadow . ';
        }
        body .tt_main_page .tt_location_page_class .tt_get_directions:hover,
        body .tt_main_page .loc_map_list_container_class .tt_get_directions:hover,
        body .tt_main_page .tt_location_page_class .tt_location_link a:hover {
            box-shadow: none;
            color: ' . $location_btn_bg . '!important;
            background: ' . $typography_location_btn['color'] . '!important;
            border-color: ' . $loc_btn_border_color . '!important;
            border-top-width: ' . $loc_btn_top . 'px !important;
            border-bottom-width: ' . $loc_btn_bottom . 'px !important;
            border-left-width: ' . $loc_btn_left . 'px !important;
            border-right-width: ' . $loc_btn_right . 'px !important;
            border-style: ' . $loc_btn_border_style . '!important;
            border-top-right-radius: ' . $loc_btn_radius_top_right . 'px !important;
            border-top-left-radius: ' . $loc_btn_radius_top_left . 'px !important;
            border-bottom-right-radius: ' . $loc_btn_radius_bottom_right . 'px !important;
            border-bottom-left-radius: ' . $loc_btn_radius_bottom_left . 'px !important;
        }
        body .tt_main_page .tt_loc_filter_block button {
            background: ' . $filter_btn_bg . ';
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $typography_filter_btn['size'] . 'px!important;
            line-height: ' . $typography_filter_btn['height'] . 'px!important;
            color: ' . $typography_filter_btn['color'] . '!important;
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
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
        body .tt_main_page .tt_loc_filter_block button:hover {
            box-shadow:none;
            background: ' . $typography_filter_btn['color'] . ';
            border: 1px solid' . $filter_btn_bg . '; 
            color: ' . $filter_btn_bg . '!important;
        }
        body .tt_main_page .tt_loc_filter_block button.tt_loc_clear_btn {
            box-shadow: none;
            background: ' . $typography_filter_btn['color'] . ';
            border: 1px solid' . $filter_btn_bg . '; 
            color: ' . $filter_btn_bg . '!important;
        }
        body .tt_main_page .tt_loc_filter_block button.tt_loc_clear_btn:hover {
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
            border: 1px solid' . $filter_btn_bg . '; 
            background: ' . $filter_btn_bg . '!important;
            color: ' . $typography_filter_btn['color'] . '!important;
        }
        body .tt_main_page .tt_loc_filter_block #alphabet-menu li.active {
          background: ' . $filter_btn_bg . '!important;;
        }
        body .tt_main_page .tt_loc_filter_block .select2-container--default .select2-selection--multiple:after {
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
            background: ' . $filter_btn_bg . '!important;
        }
        body .tt_main_page .tt_loc_filter_block .select2-selection__choice,
        body .tt_main_page .tt_loc_filter_block .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: ' . $filter_btn_bg . '!important;
            border: 1px solid' . $filter_btn_bg . '!important; 
            color: ' . $typography_filter_btn['color'] . '!important;
        } 
        body .tt_main_page .tt_loc_filter_block .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: ' . $typography_filter_btn['color'] . '!important;
        }
        body .tt_main_page .tt_loc_filter_block .select2-container--default:before {
            box-shadow: inset 0px 41px 0px -15px ' . $filter_btn_box_shadow . ';
            background: ' . $filter_btn_bg . '!important;
        }
        body .tt_main_page .tt_content .tt_schedule_link {
            font-family: ' . $general_font['family'] . '!important;
            line-height: ' . $typography_location_btn['height'] . 'px !important;
            color: ' . $typography_location_btn['color'] . '!important;
            font-size: ' . $typography_location_btn['size'] . 'px !important;
            background: ' . $location_btn_bg . '!important;
            box-shadow: inset 0px 34px 0px -15px ' . $location_btn_box_shadow . ';
            border-color: ' . $loc_btn_border_color . '!important;
            border-top-width: ' . $loc_btn_top . 'px !important;
            border-bottom-width: ' . $loc_btn_bottom . 'px !important;
            border-left-width: ' . $loc_btn_left . 'px !important;
            border-right-width: ' . $loc_btn_right . 'px !important;
            border-style: ' . $loc_btn_border_style . '!important;
            border-top-right-radius: ' . $loc_btn_radius_top_right . 'px !important;
            border-top-left-radius: ' . $loc_btn_radius_top_left . 'px !important;
            border-bottom-right-radius: ' . $loc_btn_radius_bottom_right . 'px !important;
            border-bottom-left-radius: ' . $loc_btn_radius_bottom_left . 'px !important;
        }
        body .tt_main_page .tt_content .tt_schedule_link:hover {
            box-shadow:none;
            color: ' . $location_btn_bg . '!important;
            background: ' . $typography_location_btn['color'] . '!important;
            border-color: ' . $loc_btn_border_color . '!important;
            border-top-width: ' . $loc_btn_top . 'px !important;
            border-bottom-width: ' . $loc_btn_bottom . 'px !important;
            border-left-width: ' . $loc_btn_left . 'px !important;
            border-right-width: ' . $loc_btn_right . 'px !important;
            border-style: ' . $loc_btn_border_style . '!important;
            border-top-right-radius: ' . $loc_btn_radius_top_right . 'px !important;
            border-top-left-radius: ' . $loc_btn_radius_top_left . 'px !important;
            border-bottom-right-radius: ' . $loc_btn_radius_bottom_right . 'px !important;
            border-bottom-left-radius: ' . $loc_btn_radius_bottom_left . 'px !important;
        }';
    }
}