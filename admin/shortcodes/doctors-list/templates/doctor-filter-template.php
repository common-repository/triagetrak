<?php

$filter_class = new Triage_Trak_Doctors_Filter();
$filter_options = get_tt_main_settings();

$alphabet_array = range('A','Z');
$filter_alphabet = get_posts(array(
    'meta_key' => 'last_name',
    'post_type' => T_T_DOCTOR_POST_TYPE,
    'post_status' => 'publish',
    'posts_per_page' => -1,
));
$last_names_array = [];

foreach ($filter_alphabet as $last_name){
    $last_names_array[] = get_post_meta($last_name->ID, 'last_name', true)[0];
}

if ($filter_options && !empty($filter_options['filter_options'])) {
    $filter_options = $filter_options['filter_options'];?>
    <div class="tt_doc_filter_block tt_container">
        <form action="<?= site_url(); ?>/wp-admin/admin-ajax.php" method="POST" id="tt_doctors_filter">
            <div class="tt_filter_content">
                <div class="tt_row tt_m_auto">

                    <?php foreach ($filter_options as $option) {
                        switch ($option) {
                            case 'patient_ages': ?>
                                <div class="tt_col-auto "> <?= $filter_class->ie_labels(__('Patient ages', TRIAGE_TRAK_TEXT_DOMAIN)); ?>
                                    <select id="tt_patient_ages" class="select_picker tt_patient_ages"
                                            data-minimum-results-for-search="Infinity"
                                            data-placeholder=" <?= __('Patient ages', TRIAGE_TRAK_TEXT_DOMAIN); ?>"
                                            name="patient_ages">
                                        <option></option>
                                        <option value="0-4">0-4</option>
                                        <option value="5-8">5-8</option>
                                        <option value="9-12">9-12</option>
                                        <option value="13-17">13-17</option>
                                        <option value="18">18+</option>
                                    </select>
                                </div>
                                <?php break;
                            case 'accept_new_patients': ?>
                                <div class="tt_col-auto ">
                                    <div class="tt_checkbox_block"><input class="checkbox" type="checkbox"
                                                                          id="tt_new_patients"
                                                                          name="new_patients">
                                        <label for="tt_new_patients" class="checkbox_label">
                                            <span class="checkbox_text"> <?= __('Accepting New Patients', TRIAGE_TRAK_TEXT_DOMAIN); ?></span>
                                        </label>
                                    </div>
                                </div>
                                <?php break;
                            case 'zip_code': ?>
                                <div class="tt_col-auto "><?php $filter_class->ie_labels(__('Search by Zip Code', TRIAGE_TRAK_TEXT_DOMAIN)); ?>
                                    <div class="tt_zip_code_block">
                                        <input type="text" class="tt_zip_code" id="tt_doc_zip_code" name="doc_zip_code"
                                               placeholder="<?= __('Search by Zip Code', TRIAGE_TRAK_TEXT_DOMAIN); ?>"
                                               autocomplete="off"
                                               value=""><i class="fa fa-search"></i>
                                    </div>
                                </div>
                                <?php break;
                            case 'alphabet' : ?>
                                <div class="tt_col-12">
                                    <ul id="alphabet-menu">
                                        <?php
                                        foreach ($alphabet_array as $letter) {
                                            if (in_array($letter, $last_names_array)) { ?>
                                                <li class="active"><input id="letter-<?= $letter ?>" name="letters" type="radio" class="letter_field" value="<?= $letter ?>">
                                                    <label for="letter-<?= $letter ?>"> <?= $letter ?> </label>
                                                </li>

                                            <?php  } else { ?>
                                                <li><input disabled id="letter-<?= $letter ?>" name="letters" type="radio" class="letter_field"  value="<?= $letter ?>">
                                                    <label for="letter-<?= $letter ?>"> <?= $letter ?> </label>
                                                </li>
                                            <?php  }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <?php break;
                            default: ?>
                                <div class="tt_col-auto "><?= $filter_class->show_select($option); ?></div>
                            <?php }
                    } ?>
                </div>
            </div>
            <button class="tt_filter_btn"><?= __('Filter Doctors', TRIAGE_TRAK_TEXT_DOMAIN); ?><i
                        class="fa fa-arrow-circle-right"></i></button>
            <button class="tt_clear_btn"><?= __('Clear Search', TRIAGE_TRAK_TEXT_DOMAIN); ?><i
                        class="fa fa-times-circle"></i></button>
            <input type="hidden" name="action" value="filter">

           <?php foreach ($params as $param => $value) { ?>
           <input type="hidden" name="params[<?= $param; ?>]" value="<?= $value; ?>">
           <?php } ?>
    </div>
<?php } ?>
