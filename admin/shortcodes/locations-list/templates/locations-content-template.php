<?php
$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) : $query->the_post(); ?>
        <div class="<?= get_location_grid($params['grid_columns']); ?> ">
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

                    <?php if (!empty($params['show_address'])): ?>
                        <h4 class="tt_location_address<?php if ($params['limit_address']) echo " limit_titles" ?>">
                            <?= get_post_meta(get_the_ID(), 'address', true); ?>
                        </h4>
                    <?php endif;

                $phone = get_post_meta(get_the_ID(), 'phone_number', true);
                if (!empty($params['show_phone']) && !empty($phone)): ?>
                    <a href="tel:<?= $phone; ?>" class="tt_location_phone">
                        <i class="fa fa-phone-square"></i>
                        <?= esc_html($phone); ?>
                    </a>
                <?php endif; ?>

                    <?php if (!empty($params['show_link_button'])): ?>
                        <div class="tt_location_link">
                            <a class="tt_view_prof tt_location"
                               href=" <?= get_permalink(); ?> ">
                                <?= esc_html__('View Location', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile;
} else { ?>
    <p class="tt_no_result" > <?= esc_html__('No Locations!', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
<?php }

wp_reset_query();

?>