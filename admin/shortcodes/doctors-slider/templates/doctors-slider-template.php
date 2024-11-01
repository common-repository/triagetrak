<?php
tt_enqueue_scripts();
tt_doctor_slider_scripts();

$data_attr = '';

if (!empty($params['animation_speed'])) {
    $data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
}
if (!empty($params['dots_id'])) {
    $data_attr .= ' data-dots_nav=' . $params['dots_id'];
}
if (!empty($params['doctors_columns'])) {
    $data_attr .= ' data-columns=' . $params['doctors_columns'];
}
if (!empty($params['separation'])) {
    $data_attr .= ' data-separation=' . $params['separation'];
}
if (!empty($params['duration'])) {
    $data_attr .= ' data-duration=' . $params['duration'];
}
if (!empty($params['autoplay'])) {
    $data_attr .= ' data-autoplay=1';
}
if (!empty($params['dots'])) {
    $data_attr .= ' data-dots=1';
}
if (!empty($params['navs'])) {
    $data_attr .= ' data-navs=1';
}
if (!empty($params['loop'])) {
    $data_attr .= ' data-loop=1';
}

?>
<div class="tt_main_page">
    <div id="tt_doctors_page" class="tt_doctors_page_class tt_content tt_container">
        <div class="tt_doc_slider" <?= $data_attr ?> >
            <div class="tt_doctors_slider_inner tt_doc_slider_col_<?= $params['doctors_columns']; ?>">
                <?php echo tt_get_api_template_part(get_shortcode_template_path() . 'doctors-slider/templates/doctors-content-template', $params, $args); ?>
            </div>
        </div>
    </div>
</div>
