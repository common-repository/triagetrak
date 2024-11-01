<?php

add_action('exopite_sof_after_generate_field', 'tt_locations_dynamic_style');
if (!function_exists('tt_locations_dynamic_style')) {
    /**
     * Function that return dynamic styles for location
     *
     * @version 2.4.0
     */
    function tt_locations_dynamic_style()
    {
        if (!empty(get_tt_main_settings())) {
            $title_locations = get_tt_main_settings()['title_locations'];
            $general_font = get_tt_main_settings()['general_font'];

            if ($general_font['variant'] == 'regular') {
                $general_variant = '400';
            } else {
                $general_variant = $general_font['variant'];
            }

            $typography_filter = get_tt_main_settings()['loc_typography_filter'];
            $typography_locations = get_tt_main_settings()['typography_locations'];
            $loc_main_title = get_tt_main_settings()['loc_main_title'];
            $loc_block_title = get_tt_main_settings()['loc_block_title'];
            $loc_block_text = get_tt_main_settings()['loc_block_text'];
            $loc_card_info_bg_color = get_tt_main_settings()['loc_card_info_back_color'];

            // location photo border radius
            $loc_photo = get_tt_main_settings()['loc_photo'];
            $loc_photo_border_radius = $loc_photo['border_radius'];

            // location photo border
            $loc_photo_border = get_tt_main_settings()['loc_photo_border'];
            $photo_top = $loc_photo_border['photo_top'];
            $photo_bottom = $loc_photo_border['photo_bottom'];
            $photo_left = $loc_photo_border['photo_left'];
            $photo_right = $loc_photo_border['photo_right'];
            $photo_border_style = $loc_photo_border['photo_border_style'];
            $photo_border_color = $loc_photo_border['photo_border_color'];

            // location card info border radius
            $loc_card_info_border_radius = get_tt_main_settings()['loc_card_info_border_radius'];
            $card_info_radius_top_left = $loc_card_info_border_radius['radius_top_left'];
            $card_info_radius_top_right = $loc_card_info_border_radius['radius_top_right'];
            $card_info_radius_bottom_left = $loc_card_info_border_radius['radius_bottom_left'];
            $card_info_radius_bottom_right = $loc_card_info_border_radius['radius_bottom_right'];

            // location card info border
            $loc_card_info_border = get_tt_main_settings()['loc_card_info_border'];
            $card_info_top = $loc_card_info_border['card_top'];
            $card_info_bottom = $loc_card_info_border['card_bottom'];
            $card_info_left = $loc_card_info_border['card_left'];
            $card_info_right = $loc_card_info_border['card_right'];
            $card_info_border_style = $loc_card_info_border['card_border_style'];
            $card_info_border_color = $loc_card_info_border['card_border_color'];

            $custom_styles = '
        body .tt_main_page {
            font-family: ' . $general_font['family'] . '!important;
            font-weight: ' . $general_variant . '!important;
        }
        body .tt_main_page .tt_content .tt_location_name {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $title_locations['color'] . '!important;
            font-size: ' . $title_locations['size'] . 'px !important;
            line-height: ' . $title_locations['height'] . 'px !important;
        }
        body .tt_main_page .tt_content .tt_loc_img img {
            border-color: ' . $photo_border_color . '!important;
            border-style: ' . $photo_border_style . '!important;
            border-top-width: ' . $photo_top . 'px !important;
            border-bottom-width: ' . $photo_bottom . 'px !important;
            border-left-width: ' . $photo_left . 'px !important;
            border-right-width: ' . $photo_right . 'px !important;
            border-radius: ' . $loc_photo_border_radius . '% !important;
        }
        body .tt_main_page .tt_content .tt_location_address {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $typography_locations['color'] . '!important;
            font-size: ' . $typography_locations['size'] . 'px !important;
            line-height: ' . $typography_locations['height'] . 'px !important;
        }
        body .tt_main_page .loc_map_list_container_class .tt-location-address {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $typography_locations['color'] . '!important;
        }
        body .tt_main_page .loc_map_list_container_class .tt-location-name {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $title_locations['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_location_phone {
            font-family: ' . $general_font['family'] . '!important;
            font-size: ' . $typography_locations['size'] . 'px !important;
            line-height: ' . $typography_locations['height'] . 'px !important;
            color: ' . $title_locations['color'] . '!important;
        }
        body .tt_main_page .tt_content ul.tt_tabs li,
        body .tt_main_page .tt_content ul.tt_tabs li.current {
            font-family: ' . $general_font['family'] . '!important;
        }
        body .tt_main_page .tt_content ul.tt_tabs li,
        body .tt_main_page .tt_content ul.tt_tabs li.current {
            color: ' . $loc_block_text['color'] . '!important;
        }
        body .tt_main_page .tt_loc_filter_block input,
        body .tt_main_page .tt_loc_filter_block .select2-container--default .select2-selection--single .select2-selection__placeholder,
        body .tt_main_page .tt_loc_filter_block .select2-container--default .select2-selection--single .select2-selection__rendered, 
        body .tt_main_page .tt_loc_filter_block input::-webkit-input-placeholder {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $typography_filter['size'] . 'px!important;
            color: ' . $typography_filter['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_loc_name {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $loc_main_title['size'] . 'px!important;
            line-height: ' . $loc_main_title['height'] . 'px!important;
            color: ' . $loc_main_title['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_single_location h3 {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $loc_block_title['size'] . 'px!important;
            line-height: ' . $loc_block_title['height'] . 'px!important;
        }
        body .tt_main_page .tt_content .tt_loc_phones i,
        body .tt_main_page .tt_content .tt_single_location h3 {
            color: ' . $loc_block_title['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_loc_phones a,
        body .tt_main_page .tt_content .tt_loc_address,
        body .tt_main_page .tt_content .tt_loc_departments a,
        body .tt_main_page .tt_content .tt_single_location .tt_days span,
        body .tt_main_page .tt_content .tt_single_location p,
        body .tt_main_page .tt_content .tt_loc_procedures li,
        body .tt_main_page .tt_content .tt_loc_conditions li,
        body .tt_main_page .tt_content .tt_loc_procedures li a,
        body .tt_main_page .tt_content .tt_loc_conditions li a {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $loc_block_text['size'] . 'px!important;
            line-height: ' . $loc_block_text['height'] . 'px!important;
            color: ' . $loc_block_text['color'] . '!important;
        }
        body .tt_main_page .tt_loc_filter_block input::-webkit-input-placeholder {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $typography_filter['size'] . 'px!important;
            line-height: ' . $typography_filter['height'] . 'px!important;
            color: ' . $typography_filter['color'] . '!important;
        }
        body .tt_main_page .tt_location_page_class .tt_schedule_block,
        body .tt_main_page .tt_location_page_class .tt_loc_departments,
        body .tt_main_page .tt_location_page_class .tt_loc_phones,
        body .tt_main_page .tt_location_page_class .tt_loc_hours {
            background: ' . $loc_card_info_bg_color . '!important;
            border-color: ' . $card_info_border_color . '!important;
            border-top-width: ' . $card_info_top . 'px !important;
            border-bottom-width: ' . $card_info_bottom . 'px !important;
            border-left-width: ' . $card_info_left . 'px !important;
            border-right-width: ' . $card_info_right . 'px !important;
            border-style: ' . $card_info_border_style . '!important;
            border-top-right-radius: ' . $card_info_radius_top_right . 'px;
            border-top-left-radius: ' . $card_info_radius_top_left . 'px;
            border-bottom-right-radius: ' . $card_info_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $card_info_radius_bottom_left . 'px;
        }
        body .tt_main_page .tt_content .tt_tab-content {
            background: ' . $loc_card_info_bg_color . '!important;
            border-color: ' . $card_info_border_color . '!important;
            border-bottom-width: ' . $card_info_bottom . 'px !important;
            border-style: ' . $card_info_border_style . '!important;
            border-bottom-right-radius: ' . $card_info_radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $card_info_radius_bottom_left . 'px;
        }
        body .tt_main_page .tt_content ul.tt_tabs li.current {
            background: ' . $loc_card_info_bg_color . '!important;
        }';

            $custom_styles .= tt_location_cards_dynamic_style();
            $custom_styles .= tt_location_buttons_dynamic_style();
            $custom_styles .= tt_doctor_cards_dynamic_style();
            $custom_styles .= tt_doctor_buttons_dynamic_style();

            tt_generate_options_css('locations-dynamic-styles.css', $custom_styles);
        }
    }
}
