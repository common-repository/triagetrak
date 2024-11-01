<?php
/**
 * Provide a doctors list template for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view/templates/doctors
 */

$class_doctor = new Triage_Trak_Doctors;

foreach ($doctors as $doctor) :
    $doctor_slug = sanitize_title($doctor->first_name . ' ' . $doctor->last_name);
    $doctor_url = get_permalink(get_page_by_path('tt-doctor')); ?>

    <div class="<?= get_doctor_grid($grid_columns); ?>">
        <div class="tt_doctor_block">
            <div class="tt_doctor_img">
                <a class="tt_view_prof" id="<?= esc_attr($doctor->id) ?>"
                   href="<?= esc_url($doctor_url . $doctor->id . '\/' . $doctor_slug ); ?>">
                    <img src="<?= esc_url($class_doctor->get_doctor_avatar($doctor)) ?>" alt="avatar"/>
                </a>
            </div>
            <div class="tt_doctor_info">
                <h3 class="tt_doctor_name">
                    <a class="tt_view_prof" id="<?= $doctor->id ?>"
                       href="<?= esc_url($doctor_url . $doctor->id . '\/' . $doctor_slug ); ?>">
                        <?= esc_html($doctor->first_name . ' ' . $doctor->last_name) ?>
                    </a>
                </h3>
                <?php if (!empty($show_doc_conditions)): ?>
                    <span class="tt_doctor_condition <?php if (!empty($limit_conditions)) echo "limit_titles" ?>">
                            <?php $cred = [];
                            foreach ($doctor->dictCredentials as $credential) {
                                $cred[] = $credential->name;
                            }
                            echo implode(", ", $cred); ?>
                        </span>
                <?php endif ?>
                <?php if (!empty($show_link_button)): ?>
                    <div class="tt_doctor_link">
                        <a class="tt_view_prof tt_user" id="<?= esc_attr($doctor->id) ?>"
                           href="<?= esc_url($doctor_url . $doctor->id . '\/' . $doctor_slug ); ?>"> <?= esc_html__('View Profile', TRIAGE_TRAK_TEXT_DOMAIN) ?></a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

