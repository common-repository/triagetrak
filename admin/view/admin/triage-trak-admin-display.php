<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin/view
 */

if (!defined('WPINC')) die('Silly human what are you doing here');

$auth = new Triage_Trak_Auth;
$auth->tokens_handler();
$auth->api_logout();
?>

<div class="wrap_api">
    <p><img class="tt_auto_logo" src="<?= TRIAGE_TRAK_BASE_URL . 'admin/img/WebsitterLogo.png' ?>" alt="logo"
            width="300" height="100%"></p>

    <?php if (!tt_is_auth_success()): ?>
        <form method="post" class="api_auto">
            <h2><?php _e('Authentication', TRIAGE_TRAK_TEXT_DOMAIN) ?></h2>
            <div class="api_col">
                <label for="triage-trak-api-login">
                    <?php _e('User login', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                </label>
                <input type="text"
                       id="triage-trak-api-login"
                       name="tt_user_login"
                       required>
            </div>
            <div class="api_col">
                <label for="triage-trak-api-password">
                    <?php _e('User password', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                </label>
                <input type="password"
                       id="triage-trak-api-password"
                       name="tt_user_password"
                       required>
            </div>
            <button class="api_btn" type="submit"
                    name="submit_api"><?php _e('Api connect', TRIAGE_TRAK_TEXT_DOMAIN); ?></button>
            <?php if (isset($_POST['submit_api']) || !tt_is_auth_success()): ?>
                <div class="exopite-sof-error"><?php echo $auth->get_error(); ?></div>
            <?php endif; ?>
        </form>
    <?php else: ?>

        <?php if (tt_is_auth_success() && isset($_POST['submit_api'])) : ?>
            <div class="success_notice"> <?php _e('Authentication Success', TRIAGE_TRAK_TEXT_DOMAIN); ?></div>
        <?php endif; ?>
        <form method="post" class="api_auto tt_logout_form">
            <label for="triage-trak-api-login">
                <?php _e('User login', TRIAGE_TRAK_TEXT_DOMAIN); ?>
            </label>
            <div class="api_col"><?= get_option('tt_user_login') ?></div>
            <input type="hidden" name="logout_api">
            <button class="api_btn api_logout" type="submit"><?php _e('Logout', TRIAGE_TRAK_TEXT_DOMAIN); ?></button>
        </form>
        <div class="tt_modal_confirm">
            <div class="tt_modal_overlay tt_modal_toggle"></div>
            <div class="tt_modal_wrapper tt_modal_transition">
                <div class="tt_modal_body">
                    <div class="tt_modal_header">
                        <a href="" class="tt_modal_close"></a>
                        <h2 class="tt_modal_heading"><?php _e('Are you sure you want to logout?', TRIAGE_TRAK_TEXT_DOMAIN); ?></h2>
                    </div>
                    <h3 class="tt_modal_description">
                        <?php _e('Be careful after logout all information about the doctors and locations will not be available!', TRIAGE_TRAK_TEXT_DOMAIN); ?>
                    </h3>
                    <div class="tt_modal_content">
                        <button id="tt_modal_ok"
                                class="tt_modal_logout"><?php _e('Logout', TRIAGE_TRAK_TEXT_DOMAIN); ?></button>
                        <button id="tt_modal_no"
                                class="tt_modal_cancel"><?php _e('Cancel', TRIAGE_TRAK_TEXT_DOMAIN); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>