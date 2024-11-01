<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Triage_Trak_Search
 *
 * @since      3.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 *
 */

class Triage_Trak_Search extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tt_search_bar',
            esc_html__(' WebSitter Pro Search', TRIAGE_TRAK_TEXT_DOMAIN),
            array('description' => esc_html__('Shows search result by doctors and locations', TRIAGE_TRAK_TEXT_DOMAIN))
        );
    }

    public function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $doctors = $instance['doctors'] ? 'true' : 'false';
        $locations = $instance['locations'] ? 'true' : 'false';
        $departments = $instance['departments'] ? 'true' : 'false';
        $conditions = $instance['conditions'] ? 'true' : 'false';
        $procedures = $instance['procedures'] ? 'true' : 'false';

        echo $before_widget;

        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        } ?>
        <div class="tt-search-content">
            <form id='tt_search' name="tt-search" method="POST" autocomplete="off">
                <div class="search-wrapper">
                    <i class="ttm-icon-font-awesome fa fa-search "></i>
                    <input type="text" name="search" class="search"
                           placeholder="<?php echo esc_html__('Search for...', TRIAGE_TRAK_TEXT_DOMAIN); ?>" value="">
                    <?php if ('on' == $instance['doctors']) : ?>
                        <input id="doctors" type="hidden" name="doctors" value="<?= $doctors; ?>">
                    <?php endif; ?>
                    <?php if ('on' == $instance['locations']) : ?>
                        <input id="locations" type="hidden" name="locations" value="<?= $locations; ?>">
                    <?php endif; ?>
                    <?php if ('on' == $instance['departments']) : ?>
                        <input id="departments" type="hidden" name="departments" value="<?= $departments; ?>">
                    <?php endif; ?>
                    <?php if ('on' == $instance['conditions']) : ?>
                        <input id="conditions" type="hidden" name="conditions" value="<?= $conditions; ?>">
                    <?php endif; ?>
                    <?php if ('on' == $instance['procedures']) : ?>
                        <input id="procedures" type="hidden" name="procedures" value="<?= $procedures; ?>">
                    <?php endif; ?>

                </div>
            </form>
            <div class="tt_search_results"></div>
        </div>

        <?php echo $after_widget;
    }

    public function form($instance)
    {

        $defaults = array(
            'title' => '',
            'doctors' => 'on',
            'locations' => 'on',
            'departments' => 'on',
            'conditions' => 'on',
            'procedures' => 'on',
        );

        $instance = wp_parse_args((array)$instance, $defaults);

        ?>

        <div id="<?php echo esc_attr($this->get_field_id('widget_id')); ?>">

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Title:', TRIAGE_TRAK_TEXT_DOMAIN); ?></label>
                <input class="widefat <?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['doctors'], 'on'); ?>
                       id="<?php echo $this->get_field_id('doctors'); ?>"
                       name="<?php echo $this->get_field_name('doctors'); ?>"/>
                <label for="<?php echo $this->get_field_id('doctors'); ?>"><?php echo esc_html__(' By Doctors', TRIAGE_TRAK_TEXT_DOMAIN)?></label>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['locations'], 'on'); ?>
                       id="<?php echo $this->get_field_id('locations'); ?>"
                       name="<?php echo $this->get_field_name('locations'); ?>"/>
                <label for="<?php echo $this->get_field_id('locations'); ?>"><?php echo esc_html__(' By Locations', TRIAGE_TRAK_TEXT_DOMAIN)?></label>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['departments'], 'on'); ?>
                       id="<?php echo $this->get_field_id('departments'); ?>"
                       name="<?php echo $this->get_field_name('departments'); ?>"/>
                <label for="<?php echo $this->get_field_id('departments'); ?>"><?php echo esc_html__(' By Departments', TRIAGE_TRAK_TEXT_DOMAIN)?></label>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['conditions'], 'on'); ?>
                       id="<?php echo $this->get_field_id('conditions'); ?>"
                       name="<?php echo $this->get_field_name('conditions'); ?>"/>
                <label for="<?php echo $this->get_field_id('conditions'); ?>"><?php echo esc_html__(' By Conditions', TRIAGE_TRAK_TEXT_DOMAIN)?></label>
            </p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['procedures'], 'on'); ?>
                       id="<?php echo $this->get_field_id('procedures'); ?>"
                       name="<?php echo $this->get_field_name('procedures'); ?>"/>
                <label for="<?php echo $this->get_field_id('procedures'); ?>"><?php echo esc_html__(' By Procedures', TRIAGE_TRAK_TEXT_DOMAIN)?></label>
            </p>
        </div>

        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['doctors'] = $new_instance['doctors'];
        $instance['locations'] = $new_instance['locations'];
        $instance['departments'] = $new_instance['departments'];
        $instance['conditions'] = $new_instance['conditions'];
        $instance['procedures'] = $new_instance['procedures'];
        return $instance;
    }

}