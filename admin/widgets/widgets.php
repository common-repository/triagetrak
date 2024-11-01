<?php

if(!function_exists('tt_load_widgets')) {

    function tt_load_widgets() {

        foreach(glob(TRIAGE_TRAK_BASE_DIR.'admin/widgets/*/load.php') as $widget_load) {
            include_once $widget_load;
        }

        include_once 'widget-loader.php';
    }

    add_action('tt_before_options', 'tt_load_widgets');
}

do_action('tt_before_options');