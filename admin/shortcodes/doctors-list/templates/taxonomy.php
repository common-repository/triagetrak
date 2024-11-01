<?php

get_header();
tt_enqueue_styles();
initialize_custom_inline_styles('doctors_css');

$taxonomy = get_queried_object();
$theme = wp_get_theme();
if ('Mediche' == $theme->name || 'Mediche' == $theme->parent_theme) {
    mediche_tt_get_title();
} ?>
    <div class="doc_list_photo ">
        <div class="tt_main_page">
            <div id="tt_doctors_page" class="tt_doctors_page_class tt_content tt_container">
                <div class="tt_taxonomy_title"><h1><?php echo $taxonomy->name; ?></h1></div>
                <div class="tt_doc_inner">
                    <div class="tt_row tt_doctors_list">
                        <?php if (have_posts()) {
                            while (have_posts()) : the_post(); ?>
                                <div class="tt_col-xl-3 tt_col-lg-6 tt_col-md-6 tt_four_col tt_m_bottom tt_doc_item">
                                    <div class="tt_doctor_block">
                                        <div class="tt_doctor_img">
                                            <a class="tt_view_prof"
                                               href="<?php the_permalink(); ?>">
                                                <img src="<?= get_post_meta(get_the_ID(), 'avatar', true); ?>"
                                                     alt="avatar"/>
                                            </a>
                                        </div>
                                        <div class="tt_doctor_info">
                                            <h3 class="tt_doctor_name">
                                                <a class="tt_view_prof"
                                                   href="<?php the_permalink(); ?>">
                                                    <?php the_title() ?>
                                                </a>
                                            </h3>

                                            <div class="tt_doctor_link">
                                                <a class="tt_view_prof tt_user"
                                                   href="<?php the_permalink(); ?>"> <?= esc_html__('View Profile', TRIAGE_TRAK_TEXT_DOMAIN) ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                        } else { ?>
                            <p class="tt_no_result"> <?= esc_html__('No Doctors!', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
                        <?php }
                        wp_reset_query(); ?>
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