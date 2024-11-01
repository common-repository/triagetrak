<?php
add_action('wp_enqueue_scripts', 'search_scripts_styles');

function search_scripts_styles()
{
    wp_enqueue_style('search-style', plugins_url('/css/style.css', __FILE__), array(), '1.0.0');
    wp_enqueue_script('search-main', plugins_url('/js/search.js', __FILE__), array('jquery'), '', true);
    wp_localize_script(
        'search-main',
        'opt',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'noResults' => esc_html__('No products found', TRIAGE_TRAK_TEXT_DOMAIN),
        )
    );
}

function triage_trak_ajax_search()
{
    if(isset($_POST['keyword']) && !empty($_POST['keyword'])) {
        $keyword = sanitize_text_field($_POST['keyword']);
        $post_types = ['post'];
        $post_terms = [];

        if (check_param_var($_POST['doctors'])) {
            array_unshift($post_types, T_T_DOCTOR_POST_TYPE);
        }

        if (check_param_var($_POST['locations'])) {
            array_unshift($post_types, T_T_LOCATION_POST_TYPE);
        }

        $args = array(
            'post_type' => $post_types,
            'post_status' => 'publish',
            's' => $keyword,
            'posts_per_page' => 6,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {

            $last_post_type = '';

            while ($query->have_posts()): $query->the_post();

                $post = get_queried_object();
                $post_type = get_post_type_object(get_post_type($post));

                if ($post_type != $last_post_type) { ?>
                    <li class="post_type_title"><span><?= esc_html($post_type->label) ?></span></li>
                <?php } ?>

                <li><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                <?php $last_post_type = $post_type;

            endwhile;

            if (check_param_var($_POST['departments'])) {
                array_unshift($post_terms, 'departments');
                $departments = get_terms('departments', array('name__like' => $keyword, 'number' => '4',));
                if (count($departments) > 0) {
                    ?>
                    <li class="post_type_title"><span><?= _e('Departments', TRIAGE_TRAK_TEXT_DOMAIN); ?></span></li>
                    <?php foreach ($departments as $term) {
                        $external_url = get_term_meta( $term->term_id, 'doc_external_link', true );
                        ?>
                        <li><a href="<?= !empty($external_url)? esc_url($external_url): esc_url(get_term_link($term)) ?>"> <?= esc_html($term->name) ?></a></li>
                    <?php }
                }
            }

            if (check_param_var($_POST['conditions'])) {
                array_unshift($post_terms, 'conditions');
                $conditions = get_terms('conditions', array('name__like' => $keyword, 'number' => '4',));
                if (count($conditions) > 0) {
                    ?>
                    <li class="post_type_title"><span><?= _e('Conditions', TRIAGE_TRAK_TEXT_DOMAIN); ?></span></li>
                    <?php foreach ($conditions as $term) { ?>
                        <li><a href="<?= esc_url(get_term_link($term)) ?>"> <?= esc_html($term->name) ?></a></li>
                    <?php }
                }
            }

            if (check_param_var($_POST['procedures'])) {
                array_unshift($post_terms, 'procedures');
                $procedures = get_terms('procedures', array('name__like' => $keyword, 'number' => '4',));
                if (count($procedures) > 0) {
                    ?>
                    <li class="post_type_title"><span><?= _e('Procedures', TRIAGE_TRAK_TEXT_DOMAIN); ?></span></li>
                    <?php foreach ($procedures as $term) { ?>
                        <li><a href="<?= esc_url(get_term_link($term)) ?>"> <?= esc_html($term->name) ?></a></li>
                    <?php }
                }
            }

            $all_post_types = implode(",", $post_types);
            $all_terms = implode(",", $post_terms); ?>

            <li>
                <a id="see_all_results"
                   href="<?= get_site_url() ?>?s=<?= urlencode($keyword) ?>&post_types=<?= $all_post_types ?>&post_terms=<?= $all_terms ?>"><?= _e('View all results', TRIAGE_TRAK_TEXT_DOMAIN) ?></a>
            </li>


        <?php } else { ?>

            <li class="no-results"><?= _e('No results ', TRIAGE_TRAK_TEXT_DOMAIN) ?></li>

        <?php }

        wp_reset_query();
    }

    die();
}

add_action('wp_ajax_tt_search', 'triage_trak_ajax_search');
add_action('wp_ajax_nopriv_tt_search', 'triage_trak_ajax_search');