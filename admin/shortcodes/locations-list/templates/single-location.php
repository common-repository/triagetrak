<?php
/**
 * Provide a single location template for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view/templates/locations
 */

$loc_class = new Triage_Trak_Locations;

$single_loc = get_post(get_the_ID());
$address = get_post_meta(get_the_ID(), 'address', true);
$address_details = get_post_meta(get_the_ID(), 'address_details', true);
$phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
$phone_ext = get_post_meta(get_the_ID(), 'phone_extension', true);
$phone_numbers = unserialize(get_post_meta(get_the_ID(), 'phone_numbers', true));
$hours = unserialize(get_post_meta(get_the_ID(), 'hours', true));
$doctor_ids = get_post_meta(get_the_ID(), 'doctor_ids', true);

$gmb_link = get_post_meta(get_the_ID(), 'gmb_listing_link', true);

$departments = get_the_terms(get_the_ID(), 'loc_departments');
$procedures = $loc_class->get_doctor_terms($loc_class->get_doctors_by_ids($doctor_ids), 'procedures');
$conditions = $loc_class->get_doctor_terms($loc_class->get_doctors_by_ids($doctor_ids), 'conditions');

tt_enqueue_styles();
initialize_location_scripts();
get_header();
initialize_custom_inline_styles('locations_css');

$theme = wp_get_theme();
if ('Mediche' == $theme->name || 'Mediche' == $theme->parent_theme) {
    mediche_tt_get_title();
}
?> 
    <div class="tt_main_page tt_single_location_class">
        <div id="tt_location_page" class="tt_location_page_class tt_content tt_container">
            <div class="tt_row tt_single_location">
                <div class="tt_col-lg-4">
                    <div class="tt_loc_img">
                        <img src="<?= esc_url(get_post_meta($single_loc->ID, 'photo', true)); ?>" alt="avatar">
                    </div>
                    <h1 class="tt_loc_name"><i class="fa fa-map-marker"></i>
                        <span class="tt_loc_name_text"><?= esc_html($single_loc->post_title); ?></span>
                    </h1>
                    <?php if (!empty($address)) { ?>
                        <div class="tt_loc_address">
                            <p> <?= $address; ?></p>
                            <p> <?= $address_details; ?></p>
                        </div>
                    <?php } ?>

                    <?php if (!empty($gmb_link)) { ?>
                        <a class="tt_get_directions" target="_blank"
                            href="<?= trim($gmb_link) ?>">
                            <?= __('Get Directions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php } else { ?>   

                        <a class="tt_get_directions" target="_blank"
                        href="https://maps.google.com/?q=<?= strip_tags($address); ?>">
                            <?= __('Get Directions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php } ?>   
                    <?php if (!empty($phone_number)) { ?>
                        <div class="tt_loc_phones">
                            <h3> <?= __('Phone Number(s)', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                            <div class="tt_loc_content">
                                <a href="tel:<?= $phone_number; ?> ">
                                    <i class="fa fa-phone-square"></i> <?= esc_html($phone_number); ?> <?php if (!empty($phone_ext)) {?> <?= __('ext. ', TRIAGE_TRAK_TEXT_DOMAIN); ?><?= $phone_ext; ?><?php } ?>
                                </a>

                                <?php if (!empty(!empty($phone_numbers))) {
                                    foreach ($phone_numbers as $phone_number) { ?>
                                        <a href="tel:<?= $phone_number->phone_number; ?>">
                                            <i class="fa fa-phone-square"></i>
                                            <?= esc_html($phone_number->phone_number); ?>  <?php if (!empty($phone_ext)) {?> <?= __('ext. ', TRIAGE_TRAK_TEXT_DOMAIN); ?><?=  $phone_ext; ?><?php } ?>
                                        </a>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty((array)$hours)) { ?>
                        <div class="tt_loc_hours">
                            <div class="tt_loc_content">
                                <h3> <?= __('Hours', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>

                                <?php if (isset($hours['Mon'])) { ?>
                                    <div class="tt_days"><p> <?= __('Mon: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Mon'] as $Mon) { ?>
                                            <span> <?= date('h:i A', strtotime($Mon['start'])); ?> - <?= date('h:i A', strtotime($Mon['end'])); ?> </span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($hours['Tue'])) { ?>
                                    <div class="tt_days"><p> <?= __('Tue: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Tue'] as $Tue) { ?>
                                            <span><?= date('h:i A', strtotime($Tue['start'])); ?> - <?= date('h:i A', strtotime($Tue['end'])); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($hours['Wed'])) { ?>
                                    <div class="tt_days"><p> <?= __('Wed: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Wed'] as $Wed) { ?>
                                            <span><?= date('h:i A', strtotime($Wed['start'])); ?> - <?= date('h:i A', strtotime($Wed['end'])); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($hours['Thu'])) { ?>
                                    <div class="tt_days"><p><?= __('Thu: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Thu'] as $Thu) { ?>
                                            <span> <?= date('h:i A', strtotime($Thu['start'])); ?> - <?= date('h:i A', strtotime($Thu['end'])); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($hours['Fri'])) { ?>
                                    <div class="tt_days"><p> <?= __('Fri: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Fri'] as $Fri) { ?>
                                            <span><?= date('h:i A', strtotime($Fri['start'])); ?> - <?= date('h:i A', strtotime($Fri['end'])); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($hours['Sat'])) { ?>
                                    <div class="tt_days"><p> <?= __('Sat: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Sat'] as $Sat) { ?>
                                            <span> <?= date('h:i A', strtotime($Sat['start'])); ?> - <?= date('h:i A', strtotime($Sat['end'])); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (isset($hours['Sun'])) { ?>
                                    <div class="tt_days"><p> <?= __('Sun: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                        <?php foreach ($hours['Sun'] as $Sun) { ?>
                                            <span><?= date('h:i A', strtotime($Sun['start'])); ?> - <?= date('h:i A', strtotime($Sun['end'])); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    <?php } ?>

                    <?php if (!empty((array)$departments)) { ?>
                        <div class="tt_loc_departments">
                            <div class="tt_loc_content">
                                <h3><?= __('Departments', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                <?php foreach ($departments as $department) {
                                    $external_url = get_term_meta($department->term_id, 'loc_external_link', true);
                                    $term_link = get_term_link($department->term_id, 'loc_departments');
                                    if (!empty($external_url)) { ?>
                                        <a href=" <?= esc_url($external_url); ?>"
                                           target="_blank"><?= esc_html($department->name); ?></a>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($settings) && !empty($settings['doc_tt_schedule_text']) && !empty($settings['tt_schedule'])) { ?>
                        <div class="tt_schedule_block">
                            <h3 class="loc_title"><?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                            <p> <?= esc_html__($settings['doc_tt_schedule_text'], TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <a class="tt_schedule_link" href="<?= esc_url($settings['tt_schedule']); ?>"
                                <?php set_blank_for_external_url(esc_url($settings['tt_schedule'])) ?>>
                                <?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="tt_col-lg-8">
                    <?php if (!empty($settings) && !empty($settings['tt_schedule'])) { ?>
                        <div class="tt_schedule">
                            <a class="tt_schedule_link" href="<?= esc_url($settings['tt_schedule']); ?>"
                                <?php set_blank_for_external_url(esc_url($settings['tt_schedule'])) ?>>
                                <?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </a>
                        </div>
                    <?php } ?>

                    <ul class="tt_tabs">
                        <li class="tab-link current"
                            data-tab="tab-1"><?= __('General', TRIAGE_TRAK_TEXT_DOMAIN); ?></li>

                        <?php if ($procedures || $conditions) { ?>
                            <li class="tab-link"
                                data-tab="tab-2"><?= __('Procedures & Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?></li>
                        <?php } ?>
                    </ul>

                    <div id="tab-1" class="tt_tab-content current">
                        <iframe width="640" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.it/maps?q=<?= strip_tags($address); ?>&output=embed">
                        </iframe>

                        <?php if (!empty($loc_class->get_doctors_by_ids($doctor_ids))) { ?>
                            <h3><?= __('Doctors at ', TRIAGE_TRAK_TEXT_DOMAIN) . esc_html($single_loc->post_title); ?></h3>
                            <div class="tt_row tt_doctors_list">
                                <?php foreach ($loc_class->get_doctors_by_ids($doctor_ids) as $doctor) {
                                    $doctor = $doctor[0]; ?>
                                    <div class="<?= get_doctor_grid('three'); ?>">
                                        <div class="tt_doctor_block">
                                            <div class="tt_doctor_img">
                                                <a class="tt_view_prof" id="<?= esc_attr($doctor->ID) ?>"
                                                   href="<?= $doctor->guid; ?>">
                                                    <img src="<?= get_post_meta($doctor->ID, 'avatar', true); ?>"
                                                         alt="avatar"/>
                                                </a>
                                            </div>
                                            <div class="tt_doctor_info">
                                                <h3 class="tt_doctor_name">
                                                    <a class="tt_view_prof" id="<?= $doctor->ID ?>"
                                                       href="<?= $doctor->guid; ?>">
                                                        <?= esc_html($doctor->post_title) ?>
                                                    </a>
                                                </h3>
                                                <span class="tt_doctor_condition <?php if (!empty($limit_conditions)) echo "limit_titles" ?>">
                                                <?php $cred = [];
                                                foreach (unserialize(get_post_meta($doctor->ID, 'credentials', true)) as $credential) {
                                                    $cred[] = $credential;
                                                }
                                                echo implode(", ", $cred); ?>
                                            </span>
                                                <div class="tt_doctor_link">
                                                    <a class="tt_view_prof tt_user" id="<?= esc_attr($doctor->ID) ?>"
                                                       href="<?= $doctor->guid; ?>"> <?= esc_html__('View Profile', TRIAGE_TRAK_TEXT_DOMAIN) ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (!empty($procedures) || !empty($conditions)) { ?>
                        <div id="tab-2" class="tt_tab-content">
                            <?php if (!empty($procedures)) { ?>
                                <h3><?= __('Procedures', TRIAGE_TRAK_TEXT_DOMAIN) ?></h3>
                                <ul class="tt_loc_procedures">
                                    <?php foreach ($procedures as $procedure) { ?>
                                        <li><?= esc_html($procedure->name) ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>

                            <?php if (!empty($conditions)) { ?>
                                <h3><?= __('Conditions', TRIAGE_TRAK_TEXT_DOMAIN) ?></h3>
                                <ul class="tt_loc_conditions">
                                    <?php foreach ($conditions as $condition) { ?>
                                        <li><?= esc_html($condition->name) ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php
tt_enqueue_scripts();
get_footer();
?>