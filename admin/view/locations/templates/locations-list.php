<?php
/**
 * Provide a locations list template for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      2.4.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view/templates/locations
 */

$class_locations = new Triage_Trak_Locations;

foreach ($locations as $location) {
    $address = $location->address . ', ' . $location->city . ', ' . $location->zip_code;
    $location_url = get_permalink(get_page_by_path('tt-location'));
    $location_slug = sanitize_title($location->name); ?>

    <div class="<?= get_location_grid($grid_columns); ?>">
        <div class="tt_location_block">
            <div class="tt_location_img">
                <a class="tt_view_prof" id="<?= esc_attr($location->id) ?>"
                   href="<?= esc_url($location_url . $location->id . '\/' . $location_slug); ?>">
                    <img src="<?= esc_url($class_locations->get_location_photo($location)) ?>" alt="avatar"/>
                </a>
            </div>
            <div class="tt_location_info">
                <h3 class="tt_location_name">
                    <a class="tt_view_prof tt_location" id="<?= esc_attr($location->id); ?>"
                       href=" <?= esc_url($location_url . $location->id . '\/' . $location_slug); ?> ">
                        <?= esc_html($location->name); ?>
                    </a>
                </h3>

                <?php if (!empty($show_address)): ?>
                    <h4 class="tt_location_address<?php if ($limit_address) echo " limit_titles" ?>"><?= esc_html($address) ?></h4>
                <?php endif;

                if (!empty($show_phone)): ?>
                    <a href="tel:<?= $class_locations->phone_space($location->phone_number); ?>"
                       class="tt_location_phone">
                        <i class="fa fa-phone-square"></i><?= esc_html($class_locations->phone_space($location->phone_number)); ?>
                    </a>
                <?php endif; ?>

                <?php if (!empty($show_link_button)): ?>
                    <div class="tt_location_link">
                        <a class="tt_view_prof tt_location" id="<?= esc_attr($location->id); ?>"
                           href=" <?= esc_url($location_url . $location->id . '\/' . $location_slug); ?> ">
                            <?= esc_html__('View Location', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php } ?>
