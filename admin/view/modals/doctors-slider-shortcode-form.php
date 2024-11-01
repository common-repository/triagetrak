<?php ob_start(); ?>

    <div class="tt_modal tt_doctor_slider_modal">
        <div class="tt_modal_wrapper tt_modal_transition">
            <div class="tt_modal_body">
                <div class="tt_modal_header">
                    <a href="" class="tt_modal_close"></a>
                    <h2>
                        <?= __('Doctors Carousel Shortcode', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                    </h2>
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="slider_general">
                            <?= __('General', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </li>
                        <li class="tab-link" data-tab="slider_settings">
                            <?= __('Card Settings', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </li>
                        <li class="tab-link" data-tab="slider_options">
                            <?= __('Slider Settings', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </li>
                    </ul>
                </div>
                <div class="tt_modal_content">
                    <div id="slider_general" class="tab-content current">
                        <div class="form_item">
                            <label for="doctors_number">
                                <?= __('Number of Slides', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <input name="number_of_doctors" id="doctors_number" type="text" value="">
                        </div>
                        <div class="form_item">
                            <label for="doctor_columns">
                                <?= __('Number of Columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="doctors_columns" id="doctor_columns">
                                <option value="4" selected="selected">
                                    <?= __('Four columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="3">
                                    <?= __('Three columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="2">
                                    <?= __('Two columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                            </select>
                        </div>
                        <div class="form_item">
                            <label for="doctor_order_by">
                                <?= __('Order By', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="order_by" id="doctor_order_by">
                                <option  value="title" selected="selected">
                                    <?= __('Title', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="date">
                                    <?= __('Date', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                            </select>
                        </div>
                        <div class="form_item">
                            <label for="doctor_order">
                                <?= __('Order', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="order" id="doctor_order">
                                <option  value="ASC" selected="selected">
                                    <?= __('ASC', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="DESC">
                                    <?= __('DESC', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div id="slider_settings" class="tab-content">
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="slider_link_button" type="checkbox" name="slider_link_button">
                                <?= __('Show Link Button', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="slider_doc_conditions" type="checkbox" name="slider_doc_conditions">
                                <?= __('Show Doctor Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item show_limit_option">
                            <label class="vc_checkbox-label">
                                <input value="1" id="slider_limit_conditions" type="checkbox" name="slider_limit_conditions">
                                <?= __('Limit Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                    </div>
                    <div id="slider_options" class="tab-content">
                        <div class="form_item">
                            <label for="slider_separation">
                                <?= __('Space Between Cards (px)', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <input name="separation" id="slider_separation" type="text" value="">
                        </div>
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="slider_autoplay" type="checkbox" name="slider_autoplay">
                                <?= __('Autoplay', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="slider_dots" type="checkbox" name="slider_dots">
                                <?= __('Show Dots', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item ">
                            <label class="vc_checkbox-label">
                                <input value="1" id="slider_navs" type="checkbox" name="slider_navs">
                                <?= __('Show Navs', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                    </div>
                    <a href="" class="show_doc_slider_shortcode">
                        <?= __('Show Shortcode', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                    </a>
                    <button class="tt_shortcode_copy result_shortcode"></button>
                    <div class="tt_shortcode_message">
                        <?= __('Press the text with shortcode to copy Doctors shortcode', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php

$output = ob_get_contents();

ob_end_clean();

return $output;