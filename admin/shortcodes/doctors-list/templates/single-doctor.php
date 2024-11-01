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

$doc_class = new Triage_Trak_Doctors();

$single_doc = get_post(get_the_ID());
$location_ids = unserialize(get_post_meta(get_the_ID(), 'location_ids', true));
$credentials = unserialize(get_post_meta(get_the_ID(), 'credentials', true));
$hospital_affiliations = unserialize(get_post_meta(get_the_ID(), 'hospital_affiliations', true));
$educations = unserialize(get_post_meta(get_the_ID(), 'educations', true));
$doc_document = unserialize(get_post_meta(get_the_ID(), 'doc_document', true));
$doc_award = unserialize(get_post_meta(get_the_ID(), 'doc_award', true));
$doctors_locations_hours = unserialize(get_post_meta(get_the_ID(), 'doctors_locations_hours', true));
$min_age_treated = get_post_meta(get_the_ID(), 'min_age_treated', true);
$max_age_treated = get_post_meta(get_the_ID(), 'max_age_treated', true);
$phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
$phone_ext = get_post_meta(get_the_ID(), 'phone_extension', true);
$bio_video_link = get_post_meta(get_the_ID(), 'bio_video_link', true);
$insurance_companies = unserialize(get_post_meta(get_the_ID(), 'insurance_companies', true));
$residencies = unserialize(get_post_meta(get_the_ID(), 'residencies', true));
$internships = unserialize(get_post_meta(get_the_ID(), 'internships', true));
$fellowships = unserialize(get_post_meta(get_the_ID(), 'fellowships', true));
$board_certifications = unserialize(get_post_meta(get_the_ID(), 'board_certifications', true));
$zoc_doc_link = get_post_meta(get_the_ID(), 'zoc_doc_link', true);
$publications = get_post_meta(get_the_ID(), 'publications', true);
$review_buttons = unserialize(get_post_meta(get_the_ID(), 'review_buttons', true));

$departments = get_the_terms(get_the_ID(), 'departments');
$languages = get_the_terms(get_the_ID(), 'languages');
$body_parts = get_the_terms(get_the_ID(), 'body_parts');
$conditions = get_the_terms(get_the_ID(), 'conditions');
$procedures = get_the_terms(get_the_ID(), 'procedures');
$insurances = get_the_terms(get_the_ID(), 'insurances');
$injury_types = get_the_terms(get_the_ID(), 'injury_types');
$sub_specialties = get_the_terms(get_the_ID(), 'sub_specialties');
$procedure_urls = unserialize(get_post_meta(get_the_ID(), 'procedures_url', true));
$condition_urls = unserialize(get_post_meta(get_the_ID(), 'conditions_url', true));
$new_patients = get_post_meta(get_the_ID(), 'accept_new_patients', true);
$assistant_info = get_post_meta(get_the_ID(), 'assistant_contact_info', true);

tt_enqueue_styles();
initialize_doctor_scripts();
initialize_select_scripts();
get_header();
initialize_custom_inline_styles('doctors_css');

$theme = wp_get_theme();
if ('Mediche' == $theme->name || 'Mediche' == $theme->parent_theme) {
    mediche_tt_get_title();
}

$metaaa = get_post_meta(get_the_ID(), '', false);
?>
 
    <div class="tt_main_page tt_single_doctor_class">
        <div id="tt_doctors_page" class="tt_doctors_page_class tt_content tt_container">
            <div class="tt_row tt_single_doctor">
                <div class="tt_col-lg-4 tt_doc_left">
                    <div class="tt_doc_img">
                        <img src="<?= esc_url(get_post_meta(get_the_ID(), 'avatar', true)); ?>" alt="avatar">
                    </div>
                </div>
                <div class="tt_col-lg-8 tt_doc_right">
                    <div class="doctor_main_info">
                        <h1 class="tt_doc_name"> <?php the_title() ?> </h1>

                        <?php if (!empty($credentials)) { ?>
                            <div class="tt_credentials">
                                <?php $cred = [];
                                foreach ($credentials as $credential) {
                                    $cred[] = $credential;
                                }
                                echo implode(", ", $cred);
                                ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($departments)) { ?>
                            <div class="tt_departments">
                                <?php foreach ($departments as $department) { ?>
                                    <span> <?= esc_html($department->name); ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($languages)) { ?>
                            <div class="tt_languages">
                                <span> <?= __('Languages Spoken: ', TRIAGE_TRAK_TEXT_DOMAIN) ?></span>
                                <?php $lang = [];
                                foreach ($languages as $language) {
                                    $lang[] = $language->name;
                                }
                                echo implode(", ", $lang); ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($zoc_doc_link)) { ?>
                            <div class="tt_doc_phone">
                                <span> <?= __('ZocDoc link: ', TRIAGE_TRAK_TEXT_DOMAIN) ?></span>
                                <a href="<?= $zoc_doc_link ?>">
                                    <?= esc_html($zoc_doc_link); ?>
                                </a>
                            </div>
                        <?php } ?>

                        <?php if (!empty($phone_number)) { ?>
                            <div class="tt_doc_phone">
                                <a href="tel:' <?= $phone_number ?>">
                                    <i class="fa fa-phone-square"></i> <?= esc_html($phone_number); ?>  <?php if (!empty($phone_ext)): ?> <?= __(' ext. ', TRIAGE_TRAK_TEXT_DOMAIN); ?> <?= esc_html($phone_ext); ?>  <?php endif; ?>
                                </a>
                            </div>
                        <?php } ?>

                        <?php if (!empty($review_buttons)) {
                            foreach ($review_buttons as $button) { ?>
                                <a class="tt_schedule_link" href="<?= $button['link']; ?>" target="_blank">
                                    <i class="fas fa-star" style="font-style: normal;color: #FFD700;"></i> <?= $button['title']; ?>
                                </a>
                            <?php }
                        } ?>

                        <?php if (!empty(strip_tags($assistant_info)) && $assistant_info != null && strip_tags($assistant_info) != ""): ?>
                            <div class="tt_scedule_block">
                                <h3 class="loc_title"> <?= __('Assistant Info', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                <p><?= $assistant_info ?></p>                        
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($settings) && !empty($settings['doc_tt_schedule'])) { ?>
                            <a class="tt_schedule_link" href="<?= esc_url($settings['doc_tt_schedule']); ?>"
                                <?php set_blank_for_external_url(esc_url($settings['doc_tt_schedule'])) ?>>
                                <?= __('Schedule an Appointment', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="tt_col-lg-4 tt_doc_left tt_order_1">
                    <?php if (!empty($doc_class->get_locations_by_ids($location_ids)[0])) { ?>
                        <div class="tt_loc_left_block">
                            <h3 class="loc_title"><?= __('Locations', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                            <ul class="tt_accordion">
                                <?php foreach ($doc_class->get_locations_by_ids($location_ids) as $location) {
                                    $location = $location[0];
                                    if (!empty($location)) {
                                        $loc_address = get_post_meta($location->ID, 'address', true);
                                        $loc_phone_number = get_post_meta($location->ID, 'phone_number', true);
                                        $loc_phone_ext = get_post_meta($location->ID, 'phone_extension', true);

                                        ?>
                                        <li id=" <?= esc_attr($location->ID); ?>" class="accordion-item ">
                                        <span class="tt_accordion-thumb "><?= esc_html($location->post_title); ?>
                                            <i class="fa fa-chevron-circle-down"></i>
                                        </span>
                                            <div class="tt_accordion-panel">
                                                <ul class="tt_loc_top">
                                                    <?php if (!empty($loc_address)) { ?>
                                                        <li>
                                                            <?= $loc_address; ?>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if (!empty($loc_phone_number)) { ?>
                                                        <li>
                                                            <a href="tel:' <?= $loc_phone_number ?>">
                                                                <i class="fa fa-phone-square"></i> <?= esc_html($loc_phone_number); ?> <?php if (!empty($loc_phone_ext)): ?> <?= __(' ext. ', TRIAGE_TRAK_TEXT_DOMAIN); ?> <?= esc_html($loc_phone_ext); ?>  <?php endif; ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>

                                                <?php if (!empty($doctors_locations_hours)) { ?>
                                                    <div class="tt_loc_hours">
                                                        <h5><?= __('Office Hours', TRIAGE_TRAK_TEXT_DOMAIN); ?></h5>
                                                        <?php foreach ($doctors_locations_hours as $hours) {
                                                            if ($hours['location_id'] == get_post_meta($location->ID, 'location_id', true)) {
                                                                $hours = $hours['hours'];
                                                            }

                                                            if (isset($hours['Mon'])) { ?>
                                                                <div class="tt_days">
                                                                    <p> <?= __('Mon: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                                    <?php foreach ($hours['Mon'] as $Mon) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Mon['start'])); ?> - <?= date('h:i A', strtotime($Mon['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (isset($hours['Tue'])) { ?>
                                                                <div class="tt_days">
                                                                    <p> <?= __('Tue: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                                    <?php foreach ($hours['Tue'] as $Tue) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Tue['start'])); ?>  -  <?= date('h:i A', strtotime($Tue['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (isset($hours['Wed'])) { ?>
                                                                <div class="tt_days">
                                                                    <p> <?= __('Wed: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                                    <?php foreach ($hours['Wed'] as $Wed) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Wed['start'])); ?> - <?= date('h:i A', strtotime($Wed['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (isset($hours['Thu'])) { ?>
                                                                <div class="tt_days">
                                                                    <p><?= __('Thu: ', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
                                                                    <?php foreach ($hours['Thu'] as $Thu) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Thu['start'])); ?> - <?= date('h:i A', strtotime($Thu['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (isset($hours['Fri'])) { ?>
                                                                <div class="tt_days">
                                                                    <p> <?= __('Fri: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                                    <?php foreach ($hours['Fri'] as $Fri) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Fri['start'])); ?> - <?= date('h:i A', strtotime($Fri['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (isset($hours['Sat'])) { ?>
                                                                <div class="tt_days">
                                                                    <p> <?= __('Sat: ', TRIAGE_TRAK_TEXT_DOMAIN); ?> </p>
                                                                    <?php foreach ($hours['Sat'] as $Sat) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Sat['start'])); ?> - <?= date('h:i A', strtotime($Sat['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if (isset($hours['Sun'])) { ?>
                                                                <div class="tt_days">
                                                                    <p> <?= __('Sun: ', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                                                    <?php foreach ($hours['Sun'] as $Sun) { ?>
                                                                        <span> <?= date('h:i A', strtotime($Sun['start'])); ?> - <?= date('h:i A', strtotime($Sun['end'])); ?></span>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                        <?php } ?>
                                                    </div>

                                                    <div class="tt_location_link">
                                                        <a href=" <?= esc_url($location->guid); ?>"><?= __('View Location', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                                            <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>

                                                <?php } ?>
                                        </li>
                                    <?php }
                                } ?>
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
                        <div class="tt_tab-link current"
                             data-tab="tab-1"><?= __('General', TRIAGE_TRAK_TEXT_DOMAIN); ?></div>
                        <div id="tab-1" class="tt_tab-content-wrap current">
                            <div class="tt_tab-content">
                                <?php if (!empty(get_the_content())) { ?>
                                    <h3 class="loc_title"> <?= __('About ', TRIAGE_TRAK_TEXT_DOMAIN); ?><?php the_title(); ?></h3>
                                <?php }

                                if (!empty($bio_video_link)) {
                                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $bio_video_link, $matches);
                                    if (!empty($matches)) {
                                        $id = $matches[0]; ?>
                                        <div class="doc-video hs-responsive-embed ">
                                            <iframe type="text/html" width="400" height="200"
                                                    src="https://www.youtube.com/embed/<?= $id; ?>"
                                                    frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    <?php }
                                } ?>

                                <?php if (!empty(get_the_content())) { ?>
                                    <div class="tt_doc_about"><?php the_content(); ?></div>
                                <?php } ?>

                                <?php if (!empty($sub_specialties)) { ?>
                                    <h3 class="loc_title"> <?= __('Sub Specialties:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($sub_specialties as $sub_specialtie) { ?>
                                            <p> <?= esc_html($sub_specialtie->name); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($hospital_affiliations)) { ?>
                                    <h3 class="loc_title"> <?= __('Hospital Affiliations:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($hospital_affiliations as $hospital) {
                                            if (!empty($hospital['website'])):?>
                                                <a href="<?= esc_url($hospital['website']) ?>"
                                                   target="_blank"><?= esc_html($hospital['name']) ?></a>
                                            <?php else: ?>
                                                <p><?= esc_html($hospital['name']) ?></p>
                                            <?php endif;
                                        } ?>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($educations)) { ?>
                                    <h3 class="loc_title"> <?= __('Education:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php
                                        // todo $education['state'] id -> name
                                        foreach ($educations as $education) { ?>
                                            <p> <?= esc_html($education['degree'] . ', ' . $education['name_of_school'] . ', ' . $education['city']); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($board_certifications)) { ?>
                                    <h3 class="loc_title"><?= __('Certification:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($board_certifications as $certification) { ?>
                                            <p><?= esc_html($certification); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($residencies)) { ?>
                                    <h3 class="loc_title"><?= __('Residency:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <!--todo state-->
                                        <?php foreach ($residencies as $residency) { ?>
                                            <p> <?= esc_html($residency['sub_specialty'] . ', ' . $residency['institution'] . ', ' . $residency['city']) ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($fellowships)) { ?>
                                    <h3 class="loc_title"><?= __('Fellowship:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <!--todo state-->
                                        <?php foreach ($fellowships as $fellowship) { ?>
                                            <p><?= esc_html($fellowship['institution'] . ', ' . $fellowship['sub_specialty'] . ', ' . $fellowship['city']); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if ($doc_award) {
                                    $order_by = array_column($doc_award, 'dnd_order');
                                    array_multisort($order_by, SORT_ASC, $doc_award); ?>
                                    <h3 class="loc_title"> <?= __('Awards:', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($doc_award as $award) {
                                            if ($award['type'] == "image/png" || $award['type'] == "image/jpeg" || $award['type'] == "image/gif") { ?>
                                                <span class="tt_award_preview">
                                                    <img class="tt_doc" src=" <?= esc_url($award['url']); ?>"
                                                         alt="preview">
                                                </span>
                                            <?php } else { ?>
                                                <p>
                                                    <img class="tt_doc"
                                                         src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/doc.svg"
                                                         alt="document">
                                                    <a href=" <?= esc_url($award['url']); ?>" download
                                                       target="blank"> <?= esc_url($award['name']); ?></a>
                                                </p>
                                            <?php }

                                        } ?>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($injury_types)) { ?>
                                    <h3 class="loc_title"> <?= __('Injury types treated:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($injury_types as $injury_type) { ?>
                                            <p> <?= esc_html($injury_type->name); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if ($new_patients) { ?>
                                    <h3 class="loc_title"> <?= __('Accepting New Patients:', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>
                                    <div class="tt_block_content">
                                        <p> <?= __('Yes', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                    </div>
                                <?php } elseif (!empty($new_patients) && !is_null($new_patients)) { ?>
                                    <h3 class="loc_title"> <?= __('Accepting New Patients:', TRIAGE_TRAK_TEXT_DOMAIN); ?> </h3>
                                    <div class="tt_block_content">
                                        <p> <?= __('No', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
                                    </div>
                                <?php } ?>

                                <?php if (!empty($min_age_treated) || !empty($max_age_treated)) { ?>
                                    <h3 class="loc_title"> <?= __('Ages of Patients Treated:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <p> <?= esc_html($min_age_treated . ' - ' . $max_age_treated); ?></p>
                                    </div>
                                <?php }

                                if ($doc_document) { ?>
                                    <h3 class="loc_title"> <?= __('Documents:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($doc_document as $document) { ?>
                                            <p>
                                                <img class="tt_doc"
                                                     src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/doc.svg"
                                                     alt="document">
                                                <a href="<?= esc_url($document['url']); ?>"
                                                   download
                                                   target="blank"> <?= esc_html($document['name']); ?></a>
                                            </p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                        <?php if (!empty($procedures) || !empty($conditions)) { ?>
                            <div class="tt_tab-link"
                                 data-tab="tab-2"><?= __('Procedures Conditions', TRIAGE_TRAK_TEXT_DOMAIN) ?></div>
                            <div id="tab-2" class="tt_tab-content-wrap">
                                <div class="tt_tab-content">
                                    <?php if (!empty($procedure_urls)) { ?>
                                        <div class="tt_block_content">
                                            <h3 class="loc_title"><?= __('Procedures:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                            <?php foreach ($procedure_urls as $procedure_url) {
                                                if (!empty($procedure_url['page_url'])):?>
                                                    <a href="<?= esc_url($procedure_url['page_url']) ?>"
                                                       target="_blank"><?= esc_html($procedure_url['name']) ?></a>
                                                <?php else: ?>
                                                    <p><?= esc_html($procedure_url['name']) ?></p>
                                                <?php endif;
                                            } ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($condition_urls)) { ?>
                                        <div class="tt_block_content">
                                            <h3 class="loc_title"><?= __('Conditions:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                            <?php foreach ($condition_urls as $condition_url) {
                                                if (!empty($condition_url['page_url'])):?>
                                                    <a href="<?= esc_url($condition_url['page_url']) ?>"
                                                       target="_blank"><?= esc_html($condition_url['name']) ?></a>
                                                <?php else: ?>
                                                    <p><?= esc_html($condition_url['name']) ?></p>
                                                <?php endif;
                                            } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!empty($publications) || !empty($internships)) { ?>
                            <div class="tt_tab-link"
                                 data-tab="tab-3"><?= __('Publications', TRIAGE_TRAK_TEXT_DOMAIN); ?></div>

                            <div id="tab-3" class="tt_tab-content-wrap">
                                <div class="tt_tab-content">

                                    <?php if (!empty($publications)) { ?>
                                        <h3 class="loc_title"><?= __('Publications:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                        <div class="tt_block_content">
                                            <!--todo state-->
                                            <?= $publications; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($internships)) { ?>
                                        <h3 class="loc_title"><?= __('Internship:', TRIAGE_TRAK_TEXT_DOMAIN) ?></h3>
                                        <div class="tt_block_content">
                                            <!--todo state-->
                                            <?php foreach ($internships as $internship) { ?>
                                                <p> <?= esc_html($internship['hospital'] . ', ' . $internship['specialty'] . ', ' . $internship['city']); ?></p>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>

                        <?php if (!empty($insurances) || !empty($insurance_companies)) { ?>
                        <div class="tt_tab-link"
                             data-tab="tab-4"> <?= __('Accepted Insurance', TRIAGE_TRAK_TEXT_DOMAIN); ?></div>
                        <div id="tab-4" class="tt_tab-content-wrap">
                            <div class="tt_tab-content ">
                                <?php if (!empty($insurances)) { ?>
                                    <h3 class="loc_title"><?= __('Accepted Insurances:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($insurances as $insurance) { ?>
                                            <p><?= esc_html($insurance->name); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php }

                                if (!empty($insurance_companies)) { ?>
                                    <h3 class="loc_title"><?= __('Insurance companies:', TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                    <div class="tt_block_content">
                                        <?php foreach ($insurance_companies as $insurance_company) { ?>
                                            <p><?= esc_html($insurance_company); ?></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php
tt_enqueue_scripts();
get_footer();
?>