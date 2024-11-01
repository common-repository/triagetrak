<?php

if (!function_exists('tt_remove_auto_ptag')) {
    function tt_remove_auto_ptag($content, $autop = false)
    {
        if ($autop) {
            $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        }

        return do_shortcode($content);
    }
}

if (!function_exists('get_shortcode_template_path')) {
    function get_shortcode_template_path()
    {
        return 'admin/shortcodes/';
    }
}
