<?php
$departments = get_terms('departments', array(
    'number' => $params['departments_count'],
));

tt_enqueue_scripts();
?>

<?php if (!empty($departments)) { ?>
    <div id="tt_schortcode_departments" class="<?= esc_attr($el_class) ?> ">
        <ul class="tt_departments_list">
            <?php foreach ($departments as $department) {
                $external_url = get_term_meta( $department->term_id, 'doc_external_link', true );
                $term_link = get_term_link($department->term_id, 'departments');?>
                <li>
                    <a href="<?= !empty($external_url)? esc_url($external_url): $term_link; ?>"
                       target="<?php $params['target'] ?>"><?= $department->name ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } else { ?>
    <p><?php __('No Doctors!', TRIAGE_TRAK_TEXT_DOMAIN) ?></p>
<?php } ?>