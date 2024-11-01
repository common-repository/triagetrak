<?php

if (!function_exists('tt_location_cards_dynamic_style')) {
    /**
     * Function that return dynamic styles for location cards
     * @return string
     *
     * @version 2.4.0
     */
    function tt_location_cards_dynamic_style()
    {
        // location typography
        $loc_card_back_color = get_tt_main_settings()['loc_card_back_color'];

        // location card border radius
        $loc_border_radius = get_tt_main_settings()['loc_card_border_radius'];
        $radius_top_left = $loc_border_radius['radius_top_left'];
        $radius_top_right = $loc_border_radius['radius_top_right'];
        $radius_bottom_left = $loc_border_radius['radius_bottom_left'];
        $radius_bottom_right = $loc_border_radius['radius_bottom_right'];

        // location card border
        $loc_card_border = get_tt_main_settings()['loc_card_border'];
        $card_top = $loc_card_border['card_top'];
        $card_bottom = $loc_card_border['card_bottom'];
        $card_left = $loc_card_border['card_left'];
        $card_right = $loc_card_border['card_right'];
        $border_style = $loc_card_border['card_border_style'];
        $border_color = $loc_card_border['card_border_color'];

        return '
        body .tt_main_page .tt_content .tt_location_block {
            background: ' . $loc_card_back_color . '!important;
            border-color: ' . $border_color . '!important;
            border-top-width: ' . $card_top . 'px !important;
            border-bottom-width: ' . $card_bottom . 'px !important;
            border-left-width: ' . $card_left . 'px !important;
            border-right-width: ' . $card_right . 'px !important;
            border-style: ' . $border_style . '!important;
            border-top-right-radius: ' . $radius_top_right . 'px;
            border-top-left-radius: ' . $radius_top_left . 'px;
            border-bottom-right-radius: ' . $radius_bottom_right . 'px;
            border-bottom-left-radius: ' . $radius_bottom_left . 'px;
        }';
    }
}