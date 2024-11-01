<?php
$departments_options = [];
$conditions_options = [];
$procedures_options = [];
$args = array(
    'taxonomy' => array('departments', 'conditions', 'procedures'),
);
$term_query = new WP_Term_Query($args);
if (!empty($term_query) && !empty($term_query->terms)) {
    foreach ($term_query->terms as $term) {
        if ($term->taxonomy == 'departments') {
            $departments_options = array_merge($departments_options, [$term->name => $term->slug]);
            $departments_options = array_merge(['All Options' => ''], $departments_options);
        }
        if ($term->taxonomy == 'conditions') {
            $conditions_options = array_merge($conditions_options, [$term->name => $term->slug]);
            $conditions_options = array_merge(['All Options' => ''], $conditions_options);
        }
        if ($term->taxonomy == 'procedures') {
            $procedures_options = array_merge($procedures_options, [$term->name => $term->slug]);
            $procedures_options = array_merge(['All Options' => ''], $procedures_options);
        }
    }
}
ob_start(); ?>

    <div class="tt_modal tt_doctor_modal">
        <div class="tt_modal_wrapper tt_modal_transition">
            <div class="tt_modal_body">
                <div class="tt_modal_header">
                    <a href="" class="tt_modal_close"></a>
                    <h2>
                        <?= __('Doctors List Shortcode', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                    </h2>
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="general">
                            <?= __('General', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </li>
                        <li class="tab-link" data-tab="section_settings">
                            <?= __('Section Settings', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </li>
                        <li class="tab-link" data-tab="card_settings">
                            <?= __('Card Settings', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </li>
                    </ul>
                </div>
                <div class="tt_modal_content">
                    <div id="general" class="tab-content current">
                        <div class="form_item">
                            <label for="doctor_list_type">
                                <?= __('List Type', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="list_type" id="doctor_list_type">
                                <option class="doc_list_photo" value="doc_list_photo" selected="selected">
                                    <?= __('Doctors list with photo', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option class="doc_list_photo_small" value="doc_list_photo_small">
                                    <?= __('Doctors list with photo (small)', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                            </select>
                        </div>
                        <div class="form_item">
                            <label for="doctors_count">
                                <?= __('Number of Cards Per Page', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <input name="per_page" id="doctors_count" type="text" value="">
                        </div>
                        <div class="form_item">
                            <label for="doctor_grid_columns">
                                <?= __('Number of Grid Columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="grid_columns" id="doctor_grid_columns">
                                <option value="four" selected="selected">
                                    <?= __('Four columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="three">
                                    <?= __('Three columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="two">
                                    <?= __('Two columns', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                                <option value="one">
                                    <?= __('One column', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div id="section_settings" class="tab-content">
                        <div class="form_item">
                            <label for="doctor_grid_columns">
                                <?= __('Choose departments to filter the list', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="doc_departments" id="doctor_departments">
                                <?php foreach ($departments_options as $key => $option) { ?>
                                    <option id="<?= $option; ?>" value=" <?= $option; ?>"> <?= $key; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form_item">
                            <label for="doctor_grid_columns">
                                <?= __('Choose conditions to filter the list', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="doc_conditions" id="doctor_conditions">
                                <?php foreach ($conditions_options as $key => $option) { ?>
                                    <option id="<?= $option; ?>" value=" <?= $option; ?>"> <?= $key; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form_item">
                            <label for="doctor_grid_columns">
                                <?= __('Choose procedures to filter the list', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <select name="doc_procedures" id="doctor_procedures">
                                <?php foreach ($procedures_options as $key => $option) { ?>
                                    <option id="<?= $option; ?>" value=" <?= $option; ?>"> <?= $key; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="show_paginate" type="checkbox" name="show_paginate">
                                <?= __('Show Paginate', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item show_filter_option">
                            <label class="vc_checkbox-label">
                                <input value="1" id="show_filter" type="checkbox" name="filter">
                                <?= __('Show Filter', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                    </div>
                    <div id="card_settings" class="tab-content">
                        <div class="form_item">
                            <label for="doc_el_class">
                                <?= __('Extra class name', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                            <input id="doc_el_class" name="el_class" type="text">
                        </div>
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="show_link_button" type="checkbox" name="show_link_button">
                                <?= __('Show Link Button', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item">
                            <label class="vc_checkbox-label">
                                <input value="1" id="show_doc_conditions" type="checkbox" name="show_doc_conditions">
                                <?= __('Show Doctor Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                        <div class="form_item show_limit_option">
                            <label class="vc_checkbox-label">
                                <input value="1" id="limit_conditions" type="checkbox" name="limit_conditions">
                                <?= __('Limit Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </label>
                        </div>
                    </div>
                    <a href="" class="show_doc_shortcode">
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