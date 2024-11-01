<?php ob_start(); ?>

<div class="tt_modal tt_departments_modal">
    <div class="tt_modal_wrapper tt_modal_transition">
        <div class="tt_modal_body">
            <div class="tt_modal_header">
                <a href="" class="tt_modal_close"></a>
                <h2>
                  <?= __('Departments List Shortcode', TRIAGE_TRAK_TEXT_DOMAIN);?>
                </h2>
            </div>
            <div class="tt_modal_content">
                <div class="form_item">
                    <label for="doc_el_class">
                      <?= __('Extra class name', TRIAGE_TRAK_TEXT_DOMAIN);?>
                    </label>
                    <input id="dep_el_class" name="el_class" type="text">
                </div>
                <div class="form_item">
                    <label for="departments_target">
                       <?= __('Link Target', TRIAGE_TRAK_TEXT_DOMAIN);?>
                    </label>
                    <select name="target" id="departments_target">
                        <option value="self" selected="selected">
                           <?= __('Self', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </option>
                        <option value="blank">
                           <?= __('Blank', TRIAGE_TRAK_TEXT_DOMAIN);?>
                        </option>
                    </select>
                </div>
                <div class="form_item">
                    <label for="departments_count">
                        <?= __('Departments count', TRIAGE_TRAK_TEXT_DOMAIN);?>
                    </label>
                    <input name="departments_count" id="departments_count" type="text" value="">
                </div>
                <a href="" class="show_dep_shortcode">
                    <?= __('Show Shortcode', TRIAGE_TRAK_TEXT_DOMAIN);?>
                </a>
                <button class="tt_shortcode_copy result_shortcode"></button>
                <div class="tt_shortcode_message">
                   <?= __('Press the text with shortcode to copy Departments shortcode', TRIAGE_TRAK_TEXT_DOMAIN);?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$output = ob_get_contents();

ob_end_clean();

return $output;

