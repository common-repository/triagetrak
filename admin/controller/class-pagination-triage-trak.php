<?php
/**
 * The file that defines the core pagination class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/admin
 */

if (!class_exists('Triage_Trak_Pagination')) {

    class Triage_Trak_Pagination
    {
        /**
         * Show template for paginate
         *
         * @param $pages
         * @param $current_url
         * @param $name
         * @return string generated HTML for the paginate
         */
        public static function show_paginate($pages, $current_url, $name)
        {
            $paginate = '';

            if ($pages > 1) {
                $paginate .= '<div class="tt_pagination-block"><ul id="tt_paginate">';
                $cur_page = isset($_GET[$name]) ? $_GET[$name] : 1;
                $cur_page = intval($cur_page);
                if ($cur_page !== 1) {
                    $previous_page = $cur_page - 1;
                    $paginate .= '<li><a class="tt_page" id ="" href="' . esc_url($current_url . '?' . $name . '=' . $previous_page) . '">&laquo;</a></li>';
                }
                if (($cur_page - 3) > 0) {
                    if ($cur_page == 1)
                        $paginate .= '<li class="active" ><a class="tt_page" id ="1" href="' . esc_url($current_url . '?' . $name . '=1').'">1</a></li>';
                    else {
                        $paginate .= '<li><a class="tt_page"  id ="1" href="' . esc_url($current_url . '?' . $name . '=1').'">1</a></li>';
                    }

                }
                if (($cur_page - 3) > 1) {
                    $paginate .= '<li><span class="tt_dot">...</span></li>';
                }

                for ($i = ($cur_page - 2); $i <= ($cur_page + 2); $i++) {
                    if ($i < 1) continue;
                    if ($i > $pages) break;
                    if ($i === $cur_page) {
                        $paginate .= '<li class="active" ><a class="tt_page" id ="' . $i . '" href="' . esc_url( $current_url . '?' . $name . '=' . $i ). '">' . $i . '</a></li>';
                    } else {
                        $paginate .= '<li><a class="tt_page"  id ="' . $i . '" href="' . esc_url($current_url . '?' . $name . '=' . $i . '">' . $i) . '</a></li>';
                    }

                }
                if (($pages - ($cur_page + 2)) > 1) {
                    $paginate .= '<li><span class="tt_dot">...</span></li>';
                }
                if (($pages - ($cur_page + 2)) > 0) {
                    if ($cur_page == $pages)
                        $paginate .= '<li class="active" ><a class="tt_page" id ="' . $pages . '" href="' . esc_url($current_url . '?' . $name . '=' . $pages) . '">' . $pages . '</a></li>';
                    else {
                        $paginate .= '<li><a class="tt_page"  id ="' . $pages . '" href="' . esc_url($current_url . '?' . $name . '=' . $pages) . '">' . $pages . '</a></li>';
                    }

                }
                if ($cur_page !== intval($pages)) {
                    $next_page = $cur_page + 1;
                    $paginate .= '<li><a class="tt_page" id ="" href="' . esc_url($current_url . '?' . $name . '=' . $next_page) . '">&raquo;</a></li>';
                }
                $paginate .= '</ul><div/>';
            }
            return $paginate;
        }

    }
}
