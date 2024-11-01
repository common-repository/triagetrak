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

if (!defined('WPINC')) die();

$auth = new Triage_Trak_Auth;
$auth->tokens_handler();
$auth->api_logout();
$api_user_login = get_option('tt_user_login');
$api_user_pass = get_option('tt_user_password');
$tt_auth_success = get_option('tt_auth_success');?>
<div class="wrap_api">
<p><img class="tt_auto_logo" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>/img/WebsitterLogo.png" alt="logo" width="300" height="100%"></p>

<?php if (empty($api_user_login) || empty($api_user_pass) || !$tt_auth_success): ?>

        <form method="post" class="api_auto">
            <h2><?php _e('Authentication', $this->textdomain) ?></h2>
            <div class="api_col">
                <label for="triage-trak-api-login">
                    <?php _e('User login', $this->textdomain); ?>
                </label>
                <input type="text"
                       id="triage-trak-api-login"
                       name="tt_user_login"
                       value="<?php if (!empty($api_user_login)) echo esc_attr($api_user_login) ?>"
                       required>
            </div>
            <div class="api_col">
                <label for="triage-trak-api-password">
                    <?php _e('User password', $this->textdomain); ?>
                </label>
                <input type="password"
                       id="triage-trak-api-password"
                       name="tt_user_password"
                       value="<?php if (!empty($api_user_pass)) echo esc_attr($api_user_pass) ?>"
                       required>
            </div>
            <button class="api_btn" type="submit"
                    name="submit_api"><?php _e('Api connect', $this->textdomain); ?></button>
            <?php if (isset($_POST['submit_api']) || !$tt_auth_success): ?>
                <div class="exopite-sof-error"><?php echo $auth->get_error(); ?></div>
            <?php endif; ?>
        </form>

<?php else: ?>
    <?php if ($tt_auth_success && isset($_POST['submit_api'])) : ?>
        <div class="success_notice"> <?php _e('Authentication Success', $this->textdomain); ?></div>
    <?php endif; ?>
        <form method="post" class="api_auto tt_logout_form">
            <label for="triage-trak-api-login">
                <?php _e('User login', $this->textdomain); ?>
            </label>
            <div class="api_col"><?= $api_user_login ?></div>
            <input type="hidden" name="logout_api" >
            <button class="api_btn api_logout"  type="submit"><?php _e('Logout', $this->textdomain); ?></button>
        </form>
    <div class="tt_modal_confirm">
        <div class="tt_modal_overlay tt_modal_toggle"></div>
        <div class="tt_modal_wrapper tt_modal_transition">
            <div class="tt_modal_body">
                <div class="tt_modal_header">
                    <a href="" class="tt_modal_close"></a>
                    <h2 class="tt_modal_heading"><?php _e('Are you sure you want to logout?', $this->textdomain); ?></h2>
                </div>
                <h3 class="tt_modal_description"><?php _e('Be careful after logout all information about the doctors will not be available!', $this->textdomain); ?></h3>
                <div class="tt_modal_content">
                    <button id="tt_modal_ok" class="tt_modal_logout"><?php _e('Logout', $this->textdomain); ?></button>
                    <button id="tt_modal_no" class="tt_modal_cancel"><?php _e('Cancel', $this->textdomain); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
</div>