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

$class_locations = new Triage_Trak_Locations;
?>

<div class="tt_row tt_single_location">
    <div class="tt_col-lg-4">
        <div class="tt_loc_img">
            <img src="<?= esc_url($loc_photo); ?>" alt="avatar">
        </div>
        <h1 class="tt_loc_name"><i class="fa fa-map-marker"></i>
            <span class="tt_loc_name_text"><?= esc_html($single_loc->name); ?></span>
        </h1>

        <?php if (!empty($single_loc->address)) {
            $address = $single_loc->address . ' ' . $single_loc->city . ', ' . $single_loc->zip_code; ?>
            <div class="tt_loc_address">
                <p> <?= esc_html($address); ?></p>
            </div>
        <?php } ?>

        <a class="tt_get_directions" target="_blank" href="https://maps.google.com/?q=<?= esc_html($address); ?>">
            <?= __('Get Directions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
            <i class="fa fa-arrow-circle-right"></i>
        </a>

        <?php if (!empty((array)$single_loc->phone_number) || !empty((array)$single_loc->phone_numbers)) { ?>
            <div class="tt_loc_phones">
                <h3> <?= __('Phone Number(s)', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                <div class="tt_loc_content">
                    <a href="tel:<?= $class_locations->phone_space($single_loc->phone_number); ?> ">
                        <i class="fa fa-phone-square"></i> <?= esc_html($class_locations->phone_space($single_loc->phone_number)); ?>
                    </a>

                    <?php foreach ($single_loc->phone_numbers as $phone_number) { ?>
                        <a href="tel:<?= $class_locations->phone_space($phone_number->phone_number); ?>">
                            <i class="fa fa-phone-square"></i> <?= esc_html($class_locations->phone_space($phone_number->phone_number)); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty((array)$single_loc->hours)) { ?>
            <div class="tt_loc_hours">
                <div class="tt_loc_content">
                    <h3> <?= __('Hours', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>

                    <?php if (isset($single_loc->hours->Mon)) { ?>
                        <div class="tt_days"><p> <?= __('Mon: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Mon as $Mon) { ?>
                                <span> <?= date('h:i A', strtotime($Mon->start)); ?> - <?= date('h:i A', strtotime($Mon->end)); ?> </span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($single_loc->hours->Tue)) { ?>
                        <div class="tt_days"><p> <?= __('Tue: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Tue as $Tue) { ?>
                                <span><?= date('h:i A', strtotime($Tue->start)); ?> - <?= date('h:i A', strtotime($Tue->end)); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($single_loc->hours->Wed)) { ?>
                        <div class="tt_days"><p> <?= __('Wed: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Wed as $Wed) { ?>
                                <span><?= date('h:i A', strtotime($Wed->start)); ?> - <?= date('h:i A', strtotime($Wed->end)); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($single_loc->hours->Thu)) { ?>
                        <div class="tt_days"><p><?= __('Thu: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Thu as $Thu) { ?>
                                <span> <?= date('h:i A', strtotime($Thu->start)); ?> - <?= date('h:i A', strtotime($Thu->end)); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($single_loc->hours->Fri)) { ?>
                        <div class="tt_days"><p> <?= __('Fri: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Fri as $Fri) { ?>
                                <span><?= date('h:i A', strtotime($Fri->start)); ?> - <?= date('h:i A', strtotime($Fri->end)); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($single_loc->hours->Sat)) { ?>
                        <div class="tt_days"><p> <?= __('Sat: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Sat as $Sat) { ?>
                                <span> <?= date('h:i A', strtotime($Sat->start)); ?> - <?= date('h:i A', strtotime($Sat->end)); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($single_loc->hours->Sun)) { ?>
                        <div class="tt_days"><p> <?= __('Sun: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                            <?php foreach ($single_loc->hours->Sun as $Sun) { ?>
                                <span><?= date('h:i A', strtotime($Sun->start)); ?> - <?= date('h:i A', strtotime($Sun->end)); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>

        <?php } ?>

        <?php if (!empty((array)$single_loc->departmentsLocations)) { ?>
            <div class="tt_loc_departments">
                <div class="tt_loc_content">
                    <h3><?= __('Departments', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                    <?php foreach ($single_loc->departmentsLocations as $department) { ?>
                        <a href=" <?= esc_url($department->page_url); ?>"
                           target="_blank"><?= esc_html($department->name); ?></a>
                    <?php } ?>
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
            <li class="tab-link current" data-tab="tab-1"><?= __('General', TRIAGE_TRAK_TEXT_DOMAIN); ?></li>

            <?php if ($class_locations->isset_procedures_conditions($single_loc->Doctors)) { ?>
                <li class="tab-link"
                    data-tab="tab-2"><?= __('Procedures & Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?></li>
            <?php } ?>

        </ul>
        <div id="tab-1" class="tt_tab-content current">
            <iframe width="640" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://maps.google.it/maps?q=<?= esc_html($address); ?>&output=embed"></iframe>
            <h3><?= __('Doctors at ', TRIAGE_TRAK_TEXT_DOMAIN) . esc_html($single_loc->name); ?></h3>
            <?= $class_locations->show_doctors($single_loc->Doctors); ?>
        </div>

        <?php if ($class_locations->isset_procedures_conditions($single_loc->Doctors)) { ?>
            <div id="tab-2" class="tt_tab-content">
                <?= $class_locations->show_procedures_conditions($single_loc->Doctors); ?>
            </div>
        <?php } ?>
    </div>
</div>