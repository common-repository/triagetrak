<?php
$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) : $query->the_post(); ?>
        <div class="<?= get_doctor_grid($params['grid_columns']); ?>">
            <div class="tt_doctor_block">
                <div class="tt_doctor_img">
                    <a class="tt_view_prof"
                       href="<?php the_permalink(); ?>">
                        <img src="<?= get_post_meta(get_the_ID(), 'avatar', true); ?>" alt="avatar"/>
                    </a>
                </div>
                <div class="tt_doctor_info">
                    <h3 class="tt_doctor_name">
                        <a class="tt_view_prof"
                           href="<?php the_permalink(); ?>">
                            <?php the_title() ?>
                        </a>
                    </h3>

                    <?php if (!empty($params['show_doc_conditions'])): ?>
                        <span class="tt_doctor_condition <?php if (!empty($limit_conditions)) echo "limit_titles" ?>">
                        <?php $cred = [];
                        $credentials = unserialize(get_post_meta(get_the_ID(), 'credentials', true));

                        if (!empty($credentials)) {
                            foreach ($credentials as $credential) {
                                $cred[] = $credential;
                            }
                        }
                        echo implode(", ", $cred); ?>
                    </span>
                    <?php endif ?>

                    <?php if (!empty($params['show_link_button'])): ?>
                        <div class="tt_doctor_link">
                            <a class="tt_view_prof tt_user"
                               href="<?php the_permalink(); ?>"> <?= esc_html__('View Profile', TRIAGE_TRAK_TEXT_DOMAIN) ?></a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endwhile;
} else { ?>
    <p class="tt_no_result"> <?= esc_html__('No Doctors!', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
<?php }

wp_reset_query();

?>