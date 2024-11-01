<?php
tt_enqueue_scripts();
initialize_select_scripts();


?>


<div class="<?= esc_attr($list_class) ?> ">
    <div class="tt_main_page">
        <?php if (!empty($params['show_filter'])):
           echo tt_get_api_template_part(get_shortcode_template_path() . 'doctors-list/templates/doctor-filter-template', $params);
         endif; ?>
        <div id="tt_doctors_page" class="tt_doctors_page_class tt_content tt_container" data-params='<?= json_encode($params); ?>'>
            <div class="tt_doc_inner">
                <div class="tt_row tt_doctors_list <?= !empty($params['show_paginate'])? 'show-paginate' : '';  ?> ">
                    <?php echo tt_get_api_template_part(get_shortcode_template_path() . 'doctors-list/templates/doctors-content-template', $params, $args); ?>
                </div>
            </div>
            <div class="tt_load_more"><img src="<?= TRIAGE_TRAK_BASE_URL ?>admin/img/loader.gif" alt="loader"></div>
        </div>
    </div>
</div>

