<?php ob_start(); ?>

<div class="tt_modal tt_location_modal">
    <div class="tt_modal_wrapper tt_modal_transition">
        <div class="tt_modal_body">
            <div class="tt_modal_header">
                <a href="" class="tt_modal_close"></a>
                <h2>
                  <?= __('Locations List Shortcode', TRIAGE_TRAK_TEXT_DOMAIN);?>
                </h2>
                <ul class="tabs">
                    <li class="tab-link current" data-tab="loc_general">
                       <?= __('General', TRIAGE_TRAK_TEXT_DOMAIN);?>
                    </li>
                    <li class="tab-link" data-tab="loc_section_settings">
                       <?= __('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN);?>
                    </li>
                </ul>
            </div>
            <div class="tt_modal_content">
                <div id="loc_general" class="tab-content current">
                    <div class="form_item">
                        <label for="location_list_type">
                          <?= __('List Type', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                        <select name="list_type" id="location_list_type">
                            <option class="loc_list_photo" value="loc_list_photo" selected="selected">
                               <?= __('Locations list with photo', TRIAGE_TRAK_TEXT_DOMAIN);?>
                            </option>
                            <option class="loc_list_photo_small" value="loc_list_photo_small">
                               <?= __('Locations list with photo (small)', TRIAGE_TRAK_TEXT_DOMAIN);?>
                            </option>
                        </select>
                    </div>
                    <div class="form_item">
                        <label for="locations_count">
                           <?= __('Number of Cards Per Page', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                        <input name="per_page" id="locations_count" type="text" value="">
                    </div>
                    <div class="form_item">
                        <label for="loc_grid_columns">
                           <?= __('Number of Grid Columns', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                        <select name="grid_columns" id="loc_grid_columns">
                            <option value="four" selected="selected">
                               <?= __('Four columns', TRIAGE_TRAK_TEXT_DOMAIN);?>
                            </option>
                            <option value="three">
                               <?= __('Three columns', TRIAGE_TRAK_TEXT_DOMAIN);?>
                            </option>
                            <option value="two">
                               <?= __('Two columns', TRIAGE_TRAK_TEXT_DOMAIN);?>
                            </option>
                            <option value="one">
                               <?= __('One column', TRIAGE_TRAK_TEXT_DOMAIN);?>
                            </option>
                        </select>
                    </div>
                </div>
                <div id="loc_section_settings" class="tab-content">
                    <div class="form_item">
                        <label for="loc_el_class">
                           <?= __('Extra class name', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                        <input id="loc_el_class" name="el_class" type="text">
                    </div>
                    <div class="form_item">
                        <label class="vc_checkbox-label">
                            <input value="1" id="show_map" type="checkbox" name="map">
                           <?= __('Show Map', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                    <div class="form_item">
                        <label class="vc_checkbox-label">
                            <input value="1" id="show_loc_paginate" type="checkbox" name="show_paginate">
                           <?= __('Show Paginate', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                    <div class="form_item show_loc_filter_option">
                        <label class="vc_checkbox-label">
                            <input value="1" id="show_loc_filter" type="checkbox" name="filter">
                           <?= __('Show Filter', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                    <div class="form_item">
                        <label class="vc_checkbox-label">
                            <input value="1" id="show_address" type="checkbox" name="address">
                           <?= __('Show Address', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                    <div class="form_item show_loc_limit_option">
                        <label class="vc_checkbox-label">
                            <input value="1" id="limit_address" type="checkbox" name="limit_address">
                           <?= __('Limit Address', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                    <div class="form_item">
                        <label class="vc_checkbox-label">
                            <input value="1" id="show_phone" type="checkbox" name="phone">
                           <?= __('Show Phone', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                    <div class="form_item">
                        <label class="vc_checkbox-label">
                            <input value="1" id="show_loc_button" type="checkbox" name="show_loc_button">
                          <?=  __('Show Link Button', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </label>
                    </div>
                </div>
                <a href="" class="show_loc_shortcode">
                   <?= __('Show Shortcode', TRIAGE_TRAK_TEXT_DOMAIN);?>
                </a>
                <button class="tt_shortcode_copy result_shortcode"></button>
                <div class="tt_shortcode_message">
                   <?= __('Press the text with shortcode to copy Locations shortcode', TRIAGE_TRAK_TEXT_DOMAIN);?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$output = ob_get_contents();

ob_end_clean();

return $output;



