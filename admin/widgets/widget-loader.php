<?php

if(!function_exists('tt_register_widgets')) {

	function tt_register_widgets() {

		$widgets = array(
			'Triage_Trak_Search',
		);

		foreach($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'tt_register_widgets');