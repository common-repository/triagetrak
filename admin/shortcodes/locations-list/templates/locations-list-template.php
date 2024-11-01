<?php
tt_enqueue_scripts();
initialize_select_scripts();

$args = array(
    'post_type' => T_T_LOCATION_POST_TYPE,
    'post_status' => 'publish',
    'posts_per_page' => 11,
);
//todo limitation og g maps api call
$query = new WP_Query($args);
?>

<div class="<?= esc_attr($list_class) ?> ">
    <div class="tt_main_page">
        <?php if (!empty($params['show_map']) && !empty($query)) { ?>
            <div id="loc_map_list_container" class="loc_map_list_container_class tt_container">
                <div class="tt_row">
                    <div class="tt_col-lg-8">
                        <div id="tt_lc_map"></div>
                    </div>
                    <div class="tt_col-lg-4">
                        <div id="tt_lc_list">
                            <?php while ($query->have_posts()) : $query->the_post();
                                $address = get_post_meta(get_the_ID(), 'address', true); 
                                $gmb_link = get_post_meta(get_the_ID(), 'gmb_listing_link', true);?>
                                

                                <div class="tt_list_item" data-title="<?php the_title() ?>"
                                     data-id="<?= esc_attr(get_the_ID()) ?>" data-address="<?= strip_tags($address) ?>">
                                    <div class="tt-location-name"><a href="<?= the_permalink( $post )?>"><?php the_title() ?></a></div>
                                    <div class="tt-location-address"><?= $address; ?></div>
                                    <?php if (!empty($gmb_link)) { ?>
                                        <a class="tt_get_directions" target="_blank"
                                            href="<?= trim($gmb_link) ?>">
                                            <?= __('Get Directions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    <?php } else { ?>   

                                        <a class="tt_get_directions" target="_blank"
                                        href="https://maps.google.com/?q=<?= strip_tags($address); ?>">
                                            <?= __('Get Directions', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                    <?php } ?> 
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($params['show_filter'])):
            echo tt_get_api_template_part(get_shortcode_template_path() . 'locations-list/templates/location-filter-template', $params);
        endif; ?>

        <div id="tt_location_page" class="tt_location_page_class tt_content tt_container"
             data-params='<?= json_encode($params); ?>'>
            <div class="tt_loc_inner">
                <div class="tt_row tt_locations_list <?= !empty($params['show_paginate']) ? 'show-paginate' : ''; ?>">
                    <?php echo tt_get_api_template_part(get_shortcode_template_path() . 'locations-list/templates/locations-content-template', $params, $args); ?>
                </div>
            </div>
        </div>
        <div class="tt_load_more"><img src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/loader.gif" alt="loader"></div>
    </div>
</div>