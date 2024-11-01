<?php

get_header();
tt_enqueue_styles();
initialize_location_scripts();
initialize_custom_inline_styles('locations_css');

$taxonomy = get_queried_object();
$theme = wp_get_theme();
if ('Mediche' == $theme->name || 'Mediche' == $theme->parent_theme) {
    mediche_tt_get_title();
} ?>
    <div class="loc_list_photo">
        <div class="tt_main_page">
            <div id="tt_location_page" class="tt_location_page_class tt_content tt_container">
                <div class="tt_taxonomy_title"><h1><?php echo $taxonomy->name; ?></h1></div>
                <div class="tt_loc_inner">
                    <div class="tt_row tt_locations_list">
                        <?php if (have_posts()) {
                            while (have_posts()) : the_post(); ?>
                                <div class="tt_col-lg-3 tt_col-md-6 tt_four_col tt_m_bottom tt_loc_item ">
                                    <div class="tt_location_block">
                                        <div class="tt_location_img">
                                            <a class="tt_view_prof"
                                               href="<?= get_permalink(); ?>">
                                                <img src="<?= esc_url(get_post_meta(get_the_ID(), 'photo', true)) ?>"
                                                     alt="avatar"/>
                                            </a>
                                        </div>
                                        <div class="tt_location_info">
                                            <h3 class="tt_location_name">
                                                <a class="tt_view_prof tt_location"
                                                   href=" <?php the_permalink(); ?> ">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <h4 class="tt_location_address<?php if ($params['limit_address']) echo " limit_titles" ?>">
                                                <?= esc_html(get_post_meta(get_the_ID(), 'address', true)) ?>
                                            </h4>

                                            <?php $phone = get_post_meta(get_the_ID(), 'phone_number', true);
                                            if (!empty($phone)): ?>
                                                <a href="tel:<?= $phone; ?>" class="tt_location_phone">
                                                    <i class="fa fa-phone-square"></i>
                                                    <?= esc_html($phone); ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="tt_location_link">
                                                <a class="tt_view_prof tt_location"
                                                   href=" <?= get_permalink(); ?> ">
                                                    <?= esc_html__('View Location', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                        } else { ?>
                            <p class="tt_no_result"> <?= esc_html__('No Locations!', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
                        <?php }
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
tt_enqueue_scripts();
initialize_doctor_scripts();
get_footer();
?>