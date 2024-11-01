<?php
/**
 * Provide a single doctor template for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view/templates/doctors
 */
?>

<div class="tt_row tt_single_doctor">
    <div class="tt_col-lg-4 tt_doc_left">
        <div class="tt_doc_img">
            <img src="<?= esc_url($doctor_avatar); ?>" alt="avatar">
        </div>
    </div>
    <div class="tt_col-lg-8 tt_doc_right">
        <div class="doctor_main_info">
            <?php if (!empty($single_doc->dictCredentials)) { ?>
                <h1 class="tt_doc_name"> <?= esc_html($single_doc->first_name . ' ' . $single_doc->last_name) ?> </h1>
                <div class="tt_credentials">
                    <?php $cred = [];
                    foreach ($single_doc->dictCredentials as $credential) {
                        $cred[] = $credential->name;
                    }
                    echo implode(", ", $cred); ?>
                </div>
            <?php } ?>
            <?php if (!empty($single_doc->departments)) { ?>
                <div class="tt_departments">
                    <?php foreach ($single_doc->departments as $department) { ?>
                        <span> <?= esc_html($department->name); ?></span>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if (!empty($single_doc->dictLanguages)) { ?>
                <div class="tt_languages"><span> <?= __('Languages Spoken: ', TRIAGE_TRAK_TEXT_DOMAIN) ?></span>
                    <?php $lang = [];
                    foreach ($single_doc->dictLanguages as $language) {
                        $lang[] = $language->name;
                    }
                    echo implode(", ", $lang); ?>
                </div>
            <?php } ?>

            <div class="tt_doc_phone">
                <a href="tel:' <?= $phone_number ?>">
                    <i class="fa fa-phone-square"></i> <?= esc_html($phone_number); ?>
                </a>
            </div>

            <?php if (!empty($settings) && !empty($settings['doc_tt_schedule'])) { ?>
                <a class="tt_schedule_link" href="<?= esc_url($settings['doc_tt_schedule']); ?>"
                    <?php set_blank_for_external_url(esc_url($settings['doc_tt_schedule'])) ?>>
                    <?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="tt_col-lg-4 tt_doc_left tt_order_1">
        <?php if (!empty($locations)) { ?>
            <div class="tt_loc_left_block"><h3 class="loc_title"><?= __('Locations', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                <ul class="tt_accordion">
                    <?php foreach ($locations as $location) { ?>
                        <li id=" <?= esc_attr($location->id); ?>" class="accordion-item ">
                            <span class="tt_accordion-thumb "><?= esc_html($location->name); ?> <i
                                        class="fa fa-chevron-circle-down"></i></span>
                            <div class="tt_accordion-panel">
                                <div id="tt_loading_tab"><img
                                            src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/loader.gif" alt="loader">
                                </div>
                                <ul class="tt_loc_top"></ul>

                                <?php if (!empty($location->doctors_locations_hours)) { ?>

                                    <div class="tt_loc_hours">
                                        <h5><?= __('Office Hours', TRIAGE_TRAK_TEXT_DOMAIN); ?></h5>
                                        <?php foreach ($location->doctors_locations_hours as $hours) { ?>

                                            <?php if (isset($hours->Mon)) { ?>
                                                <div class="tt_days">
                                                    <p> <?= __('Mon: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                    <?php foreach ($hours->Mon as $Mon) { ?>
                                                        <span> <?= date('h:i A', strtotime($Mon->start)); ?> - <?= date('h:i A', strtotime($Mon->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($hours->Tue)) { ?>
                                                <div class="tt_days">
                                                    <p> <?= __('Tue: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                    <?php foreach ($hours->Tue as $Tue) { ?>
                                                        <span> <?= date('h:i A', strtotime($Tue->start)); ?>  -  <?= date('h:i A', strtotime($Tue->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($hours->Wed)) { ?>
                                                <div class="tt_days">
                                                    <p> <?= __('Wed: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                    <?php foreach ($hours->Wed as $Wed) { ?>
                                                        <span> <?= date('h:i A', strtotime($Wed->start)); ?> - <?= date('h:i A', strtotime($Wed->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($hours->Thu)) { ?>
                                                <div class="tt_days"><p><?= __('Thu: ', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
                                                    <?php foreach ($hours->Thu as $Thu) { ?>
                                                        <span> <?= date('h:i A', strtotime($Thu->start)); ?> - <?= date('h:i A', strtotime($Thu->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($hours->Fri)) { ?>
                                                <div class="tt_days">
                                                    <p> <?= __('Fri: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                    <?php foreach ($hours->Fri as $Fri) { ?>
                                                        <span> <?= date('h:i A', strtotime($Fri->start)); ?> - <?= date('h:i A', strtotime($Fri->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($hours->Sat)) { ?>
                                                <div class="tt_days">
                                                    <p> <?= __('Sat: ', TRIAGE_TRAK_TEXT_DOMAIN); ?> </p>
                                                    <?php foreach ($hours->Sat as $Sat) { ?>
                                                        <span> <?= date('h:i A', strtotime($Sat->start)); ?> - <?= date('h:i A', strtotime($Sat->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php if (isset($hours->Sun)) { ?>
                                                <div class="tt_days">
                                                    <p> <?= __('Sun: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                    <?php foreach ($hours->Sun as $Sun) { ?>
                                                        <span> <?= date('h:i A', strtotime($Sun->start)); ?> - <?= date('h:i A', strtotime($Sun->end)); ?></span>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                        <?php } ?>
                                    </div>
                                    <?php $location_url = get_permalink(get_page_by_path('tt-location')); ?>
                                    <div class="tt_location_link">
                                        <a href=" <?= esc_url($location_url . $location->id . '\/' . sanitize_title($location->name)); ?>"><?= __('View Location', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    </div>

                                <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <?php if (!empty($settings) && !empty($settings['doc_tt_schedule_text']) && !empty($settings['doc_tt_schedule'])) { ?>
            <div class="tt_schedule_block">
                <h3 class="loc_title"> <?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>

                <p><?= esc_html__($settings['doc_tt_schedule_text'], TRIAGE_TRAK_TEXT_DOMAIN); ?></p>

                <a class="tt_schedule_link" href="<?= esc_url($settings['doc_tt_schedule']); ?>"
                    <?php set_blank_for_external_url(esc_url($settings['doc_tt_schedule'])) ?>>
                    <?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                </a>
            </div>
        <?php } ?>

    </div>
    <div class="tt_col-lg-8 tt_doc_right">
        <div class="tt_doc_tabs_info tt_tabs_accordions">
            <div class="tt_tab-link current" data-tab="tab-1"><?= __('General', TRIAGE_TRAK_TEXT_DOMAIN); ?></div>
            <div id="tab-1" class="tt_tab-content-wrap current">
                <div class="tt_tab-content">
                    <?php if (!empty($single_doc->written_bio)) { ?>
                        <h3 class="loc_title"> <?= __('About ', TRIAGE_TRAK_TEXT_DOMAIN); ?> <?= esc_html($single_doc->first_name . ' ' . $single_doc->last_name); ?></h3>
                    <?php }
                    if (!empty($single_doc->bio_video_link)) {
                        $url = $single_doc->bio_video_link;
                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                        if (!empty($matches)) {
                            $id = $matches[1]; ?>
                            <div class="doc-video hs-responsive-embed ">
                                <iframe type="text/html" width="400" height="200"
                                        src="https://www.youtube.com/embed/' . $id . '"
                                        frameborder="0" allowfullscreen></iframe>
                            </div>
                        <?php }
                    } ?>

                    <?php if (!empty($single_doc->written_bio)) { ?>
                        <div class="tt_doc_about"><?= __($single_doc->written_bio); ?></div>
                    <?php } ?>

                    <?php if (!empty($single_doc->sub_specialties)) { ?>
                        <h3 class="loc_title"> <?= __('Sub Specialties:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($single_doc->sub_specialties as $specialty) { ?>
                                <p> <?= esc_html($specialty->name); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($single_doc->hospital_affiliations)) { ?>
                        <h3 class="loc_title"> <?= __('Hospital Affiliations:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($single_doc->hospital_affiliations as $hospital) { ?>
                                <p><?= esc_html($hospital->name) ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($single_doc->educations)) { ?>
                        <h3 class="loc_title"> <?= __('Education:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($single_doc->educations as $education) { ?>
                                <p> <?= esc_html($education->degree . ', ' . $education->name_of_school . ', ' . $education->city . ', ' . $education->state->name); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if ($doc_award) { ?>
                        <h3 class="loc_title"> <?= __('Awards:', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>
                        <div class="tt_block_content">
                            <?php foreach ($doc_award as $award) {
                                if ($award['type'] == "image/png" || $award['type'] == "image/jpeg" || $award['type'] == "image/gif") { ?>
                                    <span class="tt_award_preview"><img class="tt_doc"
                                                                        src=" <?= esc_url($award['url']); ?>"
                                                                        alt="preview"></span>
                                <?php } else { ?>
                                    <p><img class="tt_doc"
                                            src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/doc.svg"
                                            alt="document"><a href=" <?= esc_url($award['url']); ?>" download
                                                              target="blank"> <?= esc_url($award['name']); ?></a></p>
                                <?php }

                            } ?>
                        </div>
                    <?php } ?>

                    <?php if (!empty($single_doc->dictInjuryTypes)) { ?>
                        <h3 class="loc_title"> <?= __('Injury types treated:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($single_doc->dictInjuryTypes as $dictInjury) { ?>
                                <p> <?= esc_html($dictInjury->name); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <h3 class="loc_title"> <?= __('Accepting New Patients:', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>
                    <div class="tt_block_content">
                        <?php if ($single_doc->accept_new_patients) { ?>
                            <p> <?= __('Yes', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                        <?php } else { ?>
                            <p> <?= __('No', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                        <?php } ?>
                    </div>

                    <?php if (!empty($single_doc->min_age_treated) || !empty($single_doc->max_age_treated)) { ?>
                        <h3 class="loc_title"> <?= __('Ages of Patients Treated:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <p> <?= esc_html($single_doc->min_age_treated . ' - ' . $single_doc->max_age_treated); ?></p>
                        </div>
                    <?php }
                    if ($doc_document) { ?>
                        <h3 class="loc_title"> <?= __('Documents:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($doc_document as $document) { ?>
                                <p><img class="tt_doc" src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/doc.svg"
                                        alt="document"><a href="<?= esc_url($document['url']); ?>" download
                                                          target="blank"> <?= esc_html($document['name']); ?></a></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($single_doc->procedures) || !empty($single_doc->conditions)) { ?>
                <div class="tt_tab-link" data-tab="tab-2"><?= __('Procedures Conditions', TRIAGE_TRAK_TEXT_DOMAIN) ?></div>
                <div id="tab-2" class="tt_tab-content-wrap">
                    <div class="tt_tab-content">

                        <?php if (!empty($single_doc->procedures)) { ?>
                            <h3 class="loc_title"><?= __('Procedures:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                            <div class="tt_block_content">
                                <?php foreach ($single_doc->procedures as $procedure) { ?>
                                    <p> <?= esc_html($procedure->name); ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($single_doc->conditions)) { ?>
                            <div class="tt_block_content">
                                <h3 class="loc_title"><?= __('Conditions:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                <?php foreach ($single_doc->conditions as $condition) { ?>
                                    <p><?= esc_html($condition->name) ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>

            <!--<div class="tt_tab-link" data-tab="tab-3"> <?= __('Publications Research', TRIAGE_TRAK_TEXT_DOMAIN); ?>  </dv>-->

            <!--<div id="tab-3" class="tt_tab-content-wrap"><class="tt_tab-content ">
                    <h3 class="loc_title"><?= __('Residency:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                    <div class="tt_block_content">
                        <?php if (!empty($single_doc->residencies)) {
                foreach ($single_doc->residencies as $residency) { ?>
                                <p> <?= esc_html($residency->sub_specialty . ', ' . $residency->institution . ', ' . $residency->city . ', ' . $residency->state->abbreviation); ?></p>
                            <?php }
            } ?>
                    </div>
                    <h3 class="loc_title"><?php __('Internship:', TRIAGE_TRAK_TEXT_DOMAIN) ?></h3>
                    <div class="tt_block_content">
                        <?php if (!empty($single_doc->internships)) {
                foreach ($single_doc->internships as $internship) { ?>
                                <p> <?= esc_html($internship->hospital . ', ' . $internship->specialty . ', ' . $internship->city . ', ' . $internship->state->name); ?></p>
                            <?php }
            } ?>
                    </div>
                    <h3 class="loc_title"><?= __('Fellowship:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                    <div class="tt_block_content">
                        <?php if (!empty($single_doc->fellowships)) {
                foreach ($single_doc->fellowships as $fellowship) { ?>
                                <p><?= esc_html($fellowship->institution . ', ' . $fellowship->sub_specialty . ', ' . $fellowship->city . ', ' . $fellowship->state->name); ?></p>
                            <?php }
            } ?>
                    </div>
                    <h3 class="loc_title"><?= __('Certification:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                    <div class="tt_block_content">
                        <?php if (!empty($single_doc->board_certifications)) {
                foreach ($single_doc->board_certifications as $certification) { ?>
                                <p><?= esc_html($certification->name); ?></p>
                            <?php }
            } ?>

                    </div>
                    </div>
                </div>-->

            <?php if (!empty($single_doc->insurances) || !empty($single_doc->insurance_companies)) { ?>
            <div class="tt_tab-link" data-tab="tab-4"> <?= __('Accepted Insurance', TRIAGE_TRAK_TEXT_DOMAIN); ?></div>
            <div id="tab-4" class="tt_tab-content-wrap">
                <div class="tt_tab-content ">
                    <?php if (!empty($single_doc->insurances)) { ?>
                        <h3 class="loc_title"><?= __('Accepted Insurances:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($single_doc->insurances as $insurance) { ?>
                                <p><?= esc_html($insurance->name); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($single_doc->insurance_companies)) { ?>
                        <h3 class="loc_title"><?= __('Insurance companies:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                        <div class="tt_block_content">
                            <?php foreach ($single_doc->insurance_companies as $insurance_company) { ?>
                                <p><?= esc_html($insurance_company->name); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

