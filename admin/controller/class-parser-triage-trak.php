<?php
require_once TRIAGE_TRAK_BASE_DIR . 'admin/controller/class-import-triage-trak.php';

if (!class_exists('Triage_Trak_Parse_Data')) {

    class Triage_Trak_Parse_Data extends Triage_Trak_Import
    {
        public $data = [];

        /**
         * @param $object
         * @return mixed
         */
        public function tt_std_object_to_array($object)
        {
            return json_decode(json_encode($object), true);
        }

        /**
         *  Parse data from request
         */
        public function tt_parse_data()
        {
            $this->tt_request_multiple();
            
            $request = $this->tt_std_object_to_array($this->get_data_array()); 
      
            $data = array_column($request, 'data');

            if (!empty($data)) { 

                foreach ($data as $item) {
                    unset($item["count"]); 
                    unset($item["page"]);
                    unset($item["per_page"]);                   

                    if (isset($item["doctors"])) {
                        $new_docs["doctors"][] = $item["doctors"];
                    } elseif (isset($item["files"])) {
                        $new_files["files"][] = $item["files"];
                    } else {
                        $new_locs["locations"][] = $item["locations"];
                    }
                } 

                $merged_docs = array_merge(...$new_docs["doctors"]);
                $merged_locs = array_merge(...$new_locs["locations"]); 
 
                $merged_data[]["locations"] = $merged_locs;
                $merged_data[]["doctors"] = $merged_docs;
                $merged_data[]["files"] = $new_files["files"][0];
                
                 
                foreach ($merged_data as $key => $value) { 

                    $out_arr[] = $value; 

                    $this->data = array_reduce($out_arr, function ($key, $item) {
                        return $key + $item;
                    }, []);
                }
            }            
             
            return $this->data;
        }

        /**
         * Get array by specific names from data
         * @param array $names
         * @param array $data
         * @return array
         */
        public function tt_get_data_by_name(array $names, array $data)
        {

            $data_by_name = [];

            if ($data) {
                foreach ($data as $key => $value) {
                    if (in_array($key, $names)) {
                        $data_by_name[$key] = $value;
                    }
                }
            }

            return $data_by_name;

        }

        /**
         * Delete all post before update
         *
         * @param $post_type
         */
        public function tt_delete_post_before_update($post_type)
        {
            $all_posts = get_posts(array('post_type' => $post_type, 'numberposts' => -1));

            if ($all_posts) {
                foreach ($all_posts as $post) {
                    wp_delete_post($post->ID, true);
                }
            }
        }

        /**
         * Create posts from data
         * @param $post_type
         * @param $title
         * @param $content
         * @param array $tax
         * @param array $meta
         * @param array $term_urls
         */
        public function tt_create_new_post($post_type, $title, $content, array $tax, array $meta, array $term_urls =[])
        {
            //todo check this shit
            require_once(ABSPATH . "wp-includes/pluggable.php");

            $slug = sanitize_title_with_dashes($title);

            $post_data = array(
                'post_name' => $slug,
                'post_title' => $title,
                'post_content' => $content,
                'post_type' => $post_type,
                'comment_status' => 'closed',
                'ping_status' => 'closed',
                'post_status' => 'publish',
                'post_author' => 1,
                'meta_input' => $meta,
            );

            $post_id = wp_insert_post($post_data);

            if (!empty($tax)) {
                foreach ($tax as $key => $value) {
                    wp_set_object_terms($post_id, $value, $key);

                }
            }
            if(!empty($term_urls)){
                foreach ($term_urls as $key => $value){
                    $term_slug = sanitize_title($key);

                    $loc_term = get_term_by('slug', $term_slug, 'loc_departments');
                    $doc_term = get_term_by('slug', $term_slug, 'departments');

                    if(!empty($loc_term ))
                    {
                        update_term_meta( $loc_term->term_id, "loc_external_link" ,$value );
                    }
                    if(!empty($doc_term ))
                    {
                        update_term_meta( $doc_term->term_id, "doc_external_link" ,$value );
                    }
                }

            }

        }
    }
}
