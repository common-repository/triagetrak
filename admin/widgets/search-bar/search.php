<?php
get_header();
tt_enqueue_styles();

$theme = wp_get_theme();
if ('Mediche' == $theme->name || 'Mediche' == $theme->parent_theme) {
    mediche_tt_get_title();
}

if (check_param_var($_GET['post_types'])) {
    $types = explode(',', $_GET['post_types']);
}

if (check_param_var($_GET['post_terms'])) {
    $terms = explode(',', $_GET['post_terms']);
}

$args = array(
    'post_type' => $types,
    'post_status' => 'publish',
    's' => $_GET['s'],
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'posts_per_page' => 10,
);
$query = new WP_Query($args);
?>
    <div class="tt_search_container">
        <h1 class="search_title">
            <?php _e('Search Results Found For', TRIAGE_TRAK_TEXT_DOMAIN); ?>: " <?php the_search_query(); ?> " </h1>
        <?php if ($query->have_posts()) { ?>
            <div class="  tt_search_page ">
                <?php while ($query->have_posts()) {
                    $query->the_post() ?>
                    <div class=" tt_row tt_search_result_item">
                        <?php if (get_post_type() === T_T_DOCTOR_POST_TYPE) : ?>
                            <div class="tt_col-xl-2 tt_col-lg-2 tt_col-md-4">
                                <div class="tt_post_img">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?= get_post_meta(get_the_ID(), 'avatar', true); ?>" alt="avatar"/>
                                    </a>
                                </div>
                            </div>
                        <?php elseif (get_post_type() === T_T_LOCATION_POST_TYPE) : ?>
                            <div class="tt_col-xl-2 tt_col-lg-2 tt_col-md-4">
                                <div class="tt_post_img">
                                    <a href="<?= get_permalink(); ?>">
                                        <img src="<?= esc_url(get_post_meta(get_the_ID(), 'photo', true)) ?>"
                                             alt="avatar"/>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="tt_col-xl-10 tt_col-lg-10 tt_col-md-8">
                            <h2 class="tt_post_title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p><?php the_excerpt() ?></p>
                            <a class="tt_read_more" href="<?php the_permalink(); ?>">
                                <?= _e('Read More', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="entry">
                <p><?php esc_html_e('No posts were found.', TRIAGE_TRAK_TEXT_DOMAIN); ?></p>
            </div>
        <?php } ?>
        <?php wp_reset_query(); ?>

        <div class=" tt_row tt_search_terms">
            <?php if ($terms) {
                foreach ($terms as $term_name) {
                    $cur_term = get_terms($term_name, array('name__like' => $_GET['s']));
                    if (count($cur_term) > 0) { ?>
                        <div class="tt_col-sm-12">
                            <div class="tt_search_term_item">
                                <h3><?= _e(ucfirst($term_name), TRIAGE_TRAK_TEXT_DOMAIN); ?></h3>
                                <ul>
                                    <?php foreach ($cur_term as $term) {
                                        $external_url = get_term_meta($term->term_id, 'doc_external_link', true); ?>
                                        <li>
                                            <a href="<?= !empty($external_url) ? esc_url($external_url) : esc_url(get_term_link($term)) ?>"> <?= esc_html($term->name) ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    <?php }
                }
            } ?>
        </div>
    </div>

<?php get_footer(); ?>