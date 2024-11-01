<?php

$filter_class = new Triage_Trak_Locations_Filter();
$filter_options = get_tt_main_settings();

$alphabet_array = range('A', 'Z');

$filter_alphabet = get_posts(array(
    'post_type' => T_T_LOCATION_POST_TYPE,
    'post_status' => 'publish',
    'posts_per_page' => -1,
));

$locations_array = [];

foreach ($filter_alphabet as $name) {
    $locations_array[] = $name->post_title[0];
}

if ($filter_options && !empty($filter_options['loc_filter_options'])) {
    $filter_options = $filter_options['loc_filter_options']; ?>
    <div class="tt_loc_filter_block tt_container">
        <form action="<?= site_url(); ?>/wp-admin/admin-ajax.php" method="POST" id="tt_locations_filter">
            <div class="tt_filter_content">
                <div class="tt_row tt_m_auto">
                    <?php foreach ($filter_options as $option) {
                        switch ($option) {
                            case 'zip_code': ?>
                                <div class="tt_col-auto "><?php $filter_class->ie_labels(__('Search by Zip Code', TRIAGE_TRAK_TEXT_DOMAIN)); ?>
                                    <div class="tt_zip_code_block">
                                        <input type="text" class="tt_zip_code" id="tt_zip_code" name="zip_code"
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
                                            if (in_array($letter, $locations_array)) { ?>
                                                <li class="active"><input id="letter-<?= $letter ?>" name="loc_letters"
                                                                          type="radio" class="loc_letter_field"
                                                                          value="<?= $letter ?>">
                                                    <label for="letter-<?= $letter ?>"> <?= $letter ?> </label>
                                                </li>

                                            <?php } else { ?>
                                                <li><input disabled id="letter-<?= $letter ?>" name="loc_letters"
                                                           type="radio" class="loc_letter_field" value="<?= $letter ?>">
                                                    <label for="letter-<?= $letter ?>"> <?= $letter ?> </label>
                                                </li>
                                            <?php }
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
            <button class="tt_filter_btn"><?= __('Filter Locations', TRIAGE_TRAK_TEXT_DOMAIN); ?><i
                        class="fa fa-arrow-circle-right"></i></button>
            <button class="tt_loc_clear_btn"><?= __('Clear Search', TRIAGE_TRAK_TEXT_DOMAIN); ?><i
                        class="fa fa-times-circle"></i></button>
            <input type="hidden" name="action" value="locations_filter">

            <?php foreach ($params as $param => $value) { ?>
                <input type="hidden" name="params[<?= $param; ?>]" value="<?= $value; ?>">
            <?php } ?>
    </div>
<?php } ?>
