<?php

add_action('exopite_sof_after_generate_field', 'tt_doctors_dynamic_style');
if (!function_exists('tt_doctors_dynamic_style')) {
    /**
     * Function that return dynamic styles for doctor
     *
     * @version 2.4.0
     */
    function tt_doctors_dynamic_style()
    {
        if (!empty(get_tt_main_settings())) {
            $general_font = get_tt_main_settings()['general_font'];

            if ($general_font['variant'] == 'regular') {
                $general_variant = '400';
            } else {
                $general_variant = $general_font['variant'];
            }

            $doc_block_title = get_tt_main_settings()['doc_block_title'];
            $doc_block_text = get_tt_main_settings()['doc_block_text'];
            $doc_links_text = get_tt_main_settings()['doc_links_text'];
            $typography_filter = get_tt_main_settings()['typography_filter'];
            $doc_card_info_bg_color = get_tt_main_settings()['doc_card_info_back_color'];

            // doctor photo border radius
            $doc_photo = get_tt_main_settings()['doc_photo'];
            $doc_photo_border_radius = $doc_photo['border_radius'];

            // doctor photo border
            $doc_photo_border = get_tt_main_settings()['doc_photo_border'];
            $photo_top = $doc_photo_border['photo_top'];
            $photo_bottom = $doc_photo_border['photo_bottom'];
            $photo_left = $doc_photo_border['photo_left'];
            $photo_right = $doc_photo_border['photo_right'];
            $photo_border_style = $doc_photo_border['photo_border_style'];
            $photo_border_color = $doc_photo_border['photo_border_color'];

            // doctor card info border radius
            $doc_card_info_border_radius = get_tt_main_settings()['doc_card_info_border_radius'];
            $card_info_radius_top_left = $doc_card_info_border_radius['radius_top_left'];
            $card_info_radius_top_right = $doc_card_info_border_radius['radius_top_right'];
            $card_info_radius_bottom_left = $doc_card_info_border_radius['radius_bottom_left'];
            $card_info_radius_bottom_right = $doc_card_info_border_radius['radius_bottom_right'];

            // doctor card info border
            $doc_card_info_border = get_tt_main_settings()['doc_card_info_border'];
            $card_info_top = $doc_card_info_border['card_top'];
            $card_info_bottom = $doc_card_info_border['card_bottom'];
            $card_info_left = $doc_card_info_border['card_left'];
            $card_info_right = $doc_card_info_border['card_right'];
            $card_info_border_style = $doc_card_info_border['card_border_style'];
            $card_info_border_color = $doc_card_info_border['card_border_color'];

            $custom_styles = '
        body .tt_main_page .tt_content {
            font-family: ' . $general_font['family'] . '!important;
            font-weight: ' . $general_variant . '!important;
        }
        body .tt_main_page .tt_content .tt_doc_img img {
            border-color: ' . $photo_border_color . '!important;
            border-style: ' . $photo_border_style . '!important;
            border-top-width: ' . $photo_top . 'px !important;
            border-bottom-width: ' . $photo_bottom . 'px !important;
            border-left-width: ' . $photo_left . 'px !important;
            border-right-width: ' . $photo_right . 'px !important;
            border-radius: ' . $doc_photo_border_radius . '% !important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .loc_title {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $doc_block_title['size'] . 'px!important;
            line-height: ' . $doc_block_title['height'] . 'px!important;
            color: ' . $doc_block_title['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_departments,
        body .tt_main_page .tt_content .tt_single_doctor .tt_credentials,
        body .tt_main_page .tt_content .tt_single_doctor .tt_doc_phone a,
        body .tt_main_page .tt_content .tt_loc_hours h5 {
           font-family: ' . $general_font['family'] . '!important;
           color: ' . $doc_block_title['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_schedule_link,
        body .tt_main_page .tt_content .tt_single_doctor .tt_accordion li .tt_location_link a,
        body .tt_main_page .tt_content .tt_single_doctor .tt_doc_name, 
        body .tt_main_page .tt_content .tt_single_doctor .tt_accordion-thumb {
           font-family: ' . $general_font['family'] . '!important;
         }
        body .tt_main_page .tt_content .tt_single_doctor .tt_doc_about,
        body .tt_main_page .tt_content .tt_single_doctor p,
        body .tt_main_page .tt_content .tt_single_doctor a{
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $doc_block_text['size'] . 'px!important;
            line-height: ' . $doc_block_text['height'] . 'px!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_doc_about,
        body .tt_main_page .tt_content .tt_single_doctor p{
            color: ' . $doc_block_text['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_loc_top>li a,
        body .tt_main_page .tt_content .tt_single_doctor .tt_loc_top>li {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $doc_block_text['size'] . 'px!important;
            color: ' . $doc_block_text['color'] . '!important;
        }
        .tt_tabs_accordions .tt_tab-link.current,
        body .tt_main_page .tt_content ul.tt_tabs li.current {
            background: ' . $doc_card_info_bg_color . '!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_accordion-thumb span,
        body .tt_main_page .tt_content .tt_single_doctor .tt_days p,
        body .tt_main_page .tt_content .tt_single_doctor .tt_languages,
        .tt_tabs_accordions .tt_tab-link.current,
        .tt_tabs_accordions .tt_tab-link,
        body .tt_main_page .tt_content ul.tt_tabs li.current,
        body .tt_main_page .tt_content ul.tt_tabs li {
          font-family: ' . $general_font['family'] . '!important;
          color: ' . $doc_block_text['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_accordion-panel span {
            font-family: ' . $general_font['family'] . '!important;
            color: ' . $doc_block_text['color'] . '!important;
            font-size:' . $doc_block_text['size'] . 'px!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_sub_name {
            font-family: ' . $general_font['family'] . '!important;
            font-size:' . $doc_links_text['size'] . 'px!important;
            line-height: ' . $doc_links_text['height'] . 'px!important;
            color: ' . $doc_links_text['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_single_doctor .tt_departments span:after,
        body .tt_main_page .tt_content .tt_single_doctor .tt_loc_top i, 
        body .tt_main_page .tt_content .tt_single_doctor .tt_doc_name, 
        body .tt_main_page .tt_content .tt_single_doctor .tt_accordion-thumb { 
             color: ' . $doc_block_title['color'] . '!important;
        }
         body .tt_main_page .tt_doc_filter_block input,
         body .tt_main_page .tt_doc_filter_block .select2-container--default .select2-selection--single .select2-selection__placeholder,
         body .tt_main_page .tt_doc_filter_block .select2-container--default .select2-selection--single .select2-selection__rendered, 
         body .tt_main_page .tt_doc_filter_block .checkbox_label,
         body .tt_main_page .tt_doc_filter_block input::-webkit-input-placeholder {
            font-family: ' . $general_font['family'] . '!important;
            font-size: ' . $typography_filter['size'] . 'px!important;
            color: ' . $typography_filter['color'] . '!important;
        }
        body .tt_main_page .tt_content .tt_loc_left_block,
        body .tt_main_page .tt_content .tt_doc_right .doctor_main_info,
        body .tt_main_page .tt_content .tt_schedule_block {
            background: ' . $doc_card_info_bg_color . '!important;
            border-color: ' . $card_info_border_color . '!important;
            border-top-width: ' . $card_info_top . 'px !important;
            border-bottom-width: ' . $card_info_bottom . 'px !important;
            border-left-width: ' . $card_info_left . 'px !important;
            border-right-width: ' . $card_info_right . 'px !important;
            border-style: ' . $card_info_border_style . '!important;
            border-top-right-radius: ' . $card_info_radius_top_right . 'px!important;
            border-top-left-radius: ' . $card_info_radius_top_left . 'px!important;
            border-bottom-right-radius: ' . $card_info_radius_bottom_right . 'px!important;
            border-bottom-left-radius: ' . $card_info_radius_bottom_left . 'px!important;
        }
        body .tt_main_page .tt_content .tt_tab-content {
            background: ' . $doc_card_info_bg_color . '!important;
            border-color: ' . $card_info_border_color . '!important;
            border-bottom-width: ' . $card_info_bottom . 'px !important;
            border-style: ' . $card_info_border_style . '!important;
            border-bottom-right-radius: ' . $card_info_radius_bottom_right . 'px !important;
            border-bottom-left-radius: ' . $card_info_radius_bottom_left . 'px !important;
        }';

            $custom_styles .= tt_doctor_cards_dynamic_style();
            $custom_styles .= tt_doctor_buttons_dynamic_style();

            tt_generate_options_css('doctors-dynamic-styles.css', $custom_styles);
        }
    }
}