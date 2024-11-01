<?php

if (!function_exists('tt_doctor_cards_dynamic_style')) {
    /**
     * Function that return dynamic styles for doctor cards
     * @return string
     *
     * @version 2.4.0
     */
    function tt_doctor_cards_dynamic_style()
    {
        // doctor typography
        $general_font = get_tt_main_settings()['general_font'];
        $typography_doctors = get_tt_main_settings()['typography_doctors'];
        $doctors_sub_title = get_tt_main_settings()['doctors_sub_title'];
        $doc_card_back_color = get_tt_main_settings()['doc_card_back_color'];

        // doctor card border radius
        $doc_border_radius = get_tt_main_settings()['card_border_radius'];
        $radius_top_left = $doc_border_radius['radius_top_left'];
        $radius_top_right = $doc_border_radius['radius_top_right'];
        $radius_bottom_left = $doc_border_radius['radius_bottom_left'];
        $radius_bottom_right = $doc_border_radius['radius_bottom_right'];

        // doctor card border
        $doc_border = get_tt_main_settings()['card_border'];
        $card_top = $doc_border['card_top'];
        $card_bottom = $doc_border['card_bottom'];
        $card_left = $doc_border['card_left'];
        $card_right = $doc_border['card_right'];
        $border_style = $doc_border['card_border_style'];
        $border_color = $doc_border['card_border_color'];

        return '
        body .tt_main_page .tt_doctors_page_class .tt_doctor_block,
        body .tt_main_page .tt_location_page_class .tt_doctor_block {
            background: ' . $doc_card_back_color . '!important;
            border-color: ' . $border_color . '!important;
            border-top-width: ' . $card_top . 'px !important;
            border-bottom-width: ' . $card_bottom . 'px !important;
            border-left-width: ' . $card_left . 'px !important;
            border-right-width: ' . $card_right . 'px !important;
            border-style: ' . $border_style . '!important;
            border-top-right-radius: ' . $radius_top_right . 'px !important;
            border-top-left-radius: ' . $radius_top_left . 'px !important;
            border-bottom-right-radius: ' . $radius_bottom_right . 'px !important;
            border-bottom-left-radius: ' . $radius_bottom_left . 'px !important;
        }
        body .tt_main_page .tt_doctors_page_class .tt_doctor_block .tt_doctor_name,
        body .tt_main_page .tt_location_page_class .tt_doctor_block .tt_doctor_name {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $typography_doctors['color'] . '!important;
            font-size: ' . $typography_doctors['size'] . 'px !important;
            line-height: ' . $typography_doctors['height'] . 'px !important;
        }
        body .tt_main_page .tt_doctors_page_class .tt_doctor_block .tt_doctor_condition,
        body .tt_main_page .tt_location_page_class .tt_doctor_block .tt_doctor_condition {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $doctors_sub_title['color'] . '!important;
            font-size: ' . $doctors_sub_title['size'] . 'px !important;
            line-height: ' . $doctors_sub_title['height'] . 'px !important;
            min-height: ' . $doctors_sub_title['height'] . 'px !important;
        }';
    }
}