<?php

/**
 * Provide a admin import area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      3.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view
 */

if (!defined('WPINC')) die('Silly human what are you doing here');

?>
<div class="wrap_import">
    <p><img class="tt_auto_logo" src="<?= TRIAGE_TRAK_BASE_URL . 'admin/img/WebsitterLogo.png' ?>" alt="logo"
            width="300" height="100%"></p>
    <div class="container">
        <form method="post" enctype="multipart/form-data" class="tt_import_data">
            <h2><?php _e('Import Your WebSitter Pro Data', TRIAGE_TRAK_TEXT_DOMAIN) ?></h2>
            <input type="hidden" name="hidden_field" value="1" />
            <input type="hidden" name="action" value="force_pull">
            <button class="force_pull" id="tt_import" type="submit" >
                <?php _e('Import', TRIAGE_TRAK_TEXT_DOMAIN); ?>
            </button>
        </form>
        <div class="show_process" style="display: none">
            <span id="process_data">0</span> / <span id="total_data">0</span>
        </div>
        <span id="tt_message"></span>
        <div id="tt_success_message" style="display: none">
            <div class="alert alert-success">
                <?php _e('Data successfully imported', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                <span class="tt_doctor_count"></span>
                <?php _e('doctors and', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                <span class="tt_location_count"></span>
                <?php _e('locations', TRIAGE_TRAK_TEXT_DOMAIN); ?>
            </div>
        </div>

        <!-- Progress bar -->
        <div class="form-group" id="tt_process" style="display:none;">
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
    </div>
</div>
