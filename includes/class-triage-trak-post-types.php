<?php

/**
 * Register custom post type
 *
 * @since      3.0.0
 *
 * @package    Triage_Trak
 * @subpackage Triage_Trak/includes
 */
class Triage_Trak_Post_Types {

    /**
     * Register custom post type
     *
     * @link https://codex.wordpress.org/Function_Reference/register_post_type
     */
    private function register_single_post_type( $fields ) {

        /**
		 * Labels used when displaying the posts in the admin and sometimes on the front end.  These
		 * labels do not cover post updated, error, and related messages.  You'll need to filter the
		 * 'post_updated_messages' hook to customize those.
		 */
        $labels = array(
            'name'                  => $fields['plural'],
            'singular_name'         => $fields['singular'],
            'menu_name'             => $fields['menu_name'],
            'new_item'              => sprintf( __( 'New %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'add_new_item'          => sprintf( __( 'Add new %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'edit_item'             => sprintf( __( 'Edit %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'view_item'             => sprintf( __( 'View %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'view_items'            => sprintf( __( 'View %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['plural'] ),
            'search_items'          => sprintf( __( 'Search %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['plural'] ),
            'not_found'             => sprintf( __( 'No %s found', TRIAGE_TRAK_TEXT_DOMAIN ), strtolower( $fields['plural'] ) ),
            'not_found_in_trash'    => sprintf( __( 'No %s found in trash', TRIAGE_TRAK_TEXT_DOMAIN ), strtolower( $fields['plural'] ) ),
            'all_items'             => sprintf( __( 'All %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['plural'] ),
            'archives'              => sprintf( __( '%s Archives', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'attributes'            => sprintf( __( '%s Attributes', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'insert_into_item'      => sprintf( __( 'Insert into %s', TRIAGE_TRAK_TEXT_DOMAIN ), strtolower( $fields['singular'] ) ),
            'uploaded_to_this_item' => sprintf( __( 'Uploaded to this %s', TRIAGE_TRAK_TEXT_DOMAIN ), strtolower( $fields['singular'] ) ),

            /* Labels for hierarchical post types only. */
            'parent_item'           => sprintf( __( 'Parent %s', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),
            'parent_item_colon'     => sprintf( __( 'Parent %s:', TRIAGE_TRAK_TEXT_DOMAIN ), $fields['singular'] ),

            /* Custom archive label.  Must filter 'post_type_archive_title' to use. */
			'archive_title'        => $fields['plural'],
        );

        $args = array(
            'labels'             => $labels,
            'description'        => ( isset( $fields['description'] ) ) ? $fields['description'] : '',
            'public'             => ( isset( $fields['public'] ) ) ? $fields['public'] : true,
            'publicly_queryable' => ( isset( $fields['publicly_queryable'] ) ) ? $fields['publicly_queryable'] : true,
            'exclude_from_search'=> ( isset( $fields['exclude_from_search'] ) ) ? $fields['exclude_from_search'] : false,
            'show_ui'            => ( isset( $fields['show_ui'] ) ) ? $fields['show_ui'] : true,
            'show_in_menu'       => ( isset( $fields['show_in_menu'] ) ) ? $fields['show_in_menu'] : true,
            'query_var'          => ( isset( $fields['query_var'] ) ) ? $fields['query_var'] : true,
            'show_in_admin_bar'  => ( isset( $fields['show_in_admin_bar'] ) ) ? $fields['show_in_admin_bar'] : true,
            'capability_type'    => ( isset( $fields['capability_type'] ) ) ? $fields['capability_type'] : 'post',
            'has_archive'        => ( isset( $fields['has_archive'] ) ) ? $fields['has_archive'] : true,
            'hierarchical'       => ( isset( $fields['hierarchical'] ) ) ? $fields['hierarchical'] : true,
            'supports'           => ( isset( $fields['supports'] ) ) ? $fields['supports'] : array(
                'title',
                'editor',
                'excerpt',
                'author',
                'thumbnail',
                'comments',
                'trackbacks',
                'custom-fields',
                'revisions',
                'page-attributes',
                'post-formats',
            ),
            'menu_position'      => ( isset( $fields['menu_position'] ) ) ? $fields['menu_position'] : 21,
            'menu_icon'          => ( isset( $fields['menu_icon'] ) ) ? $fields['menu_icon']: 'dashicons-admin-generic',
            'show_in_nav_menus'  => ( isset( $fields['show_in_nav_menus'] ) ) ? $fields['show_in_nav_menus'] : true,
            'show_in_rest'       => ( isset( $fields['show_in_rest'] ) ) ? $fields['show_in_rest'] : true,
        );

        if ( isset( $fields['rewrite'] ) ) {

            /**
             *  Add $this->plugin_name as translatable in the permalink structure,
             *  to avoid conflicts with other plugins which may use customers as well.
             */
            $args['rewrite'] = $fields['rewrite'];
        }


        /**
         * Register Taxnonmies if any
         * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
         */
        if ( isset( $fields['taxonomies'] ) && is_array( $fields['taxonomies'] ) ) {

            foreach ( $fields['taxonomies'] as $taxonomy ) {

                $this->register_single_post_type_taxnonomy( $taxonomy );

            }

        }

	register_post_type( $fields['slug'], $args );

    }

    private function register_single_post_type_taxnonomy( $tax_fields ) {

        $labels = array(
            'name'                       => $tax_fields['plural'],
            'singular_name'              => $tax_fields['single'],
            'menu_name'                  => $tax_fields['plural'],
            'all_items'                  => sprintf( __( 'All %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
            'edit_item'                  => sprintf( __( 'Edit %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'view_item'                  => sprintf( __( 'View %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'update_item'                => sprintf( __( 'Update %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'add_new_item'               => sprintf( __( 'Add New %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'new_item_name'              => sprintf( __( 'New %s Name' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'parent_item'                => sprintf( __( 'Parent %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'parent_item_colon'          => sprintf( __( 'Parent %s:' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['single'] ),
            'search_items'               => sprintf( __( 'Search %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
            'popular_items'              => sprintf( __( 'Popular %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
            'separate_items_with_commas' => sprintf( __( 'Separate %s with commas' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
            'add_or_remove_items'        => sprintf( __( 'Add or remove %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
            'choose_from_most_used'      => sprintf( __( 'Choose from the most used %s' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
            'not_found'                  => sprintf( __( 'No %s found' , TRIAGE_TRAK_TEXT_DOMAIN ), $tax_fields['plural'] ),
        );

        $args = array(
        	'label'                 => $tax_fields['plural'],
        	'labels'                => $labels,
        	'hierarchical'          => ( isset( $tax_fields['hierarchical'] ) )          ? $tax_fields['hierarchical']          : true,
        	'public'                => ( isset( $tax_fields['public'] ) )                ? $tax_fields['public']                : true,
        	'show_ui'               => ( isset( $tax_fields['show_ui'] ) )               ? $tax_fields['show_ui']               : true,
        	'show_in_nav_menus'     => ( isset( $tax_fields['show_in_nav_menus'] ) )     ? $tax_fields['show_in_nav_menus']     : true,
        	'show_tagcloud'         => ( isset( $tax_fields['show_tagcloud'] ) )         ? $tax_fields['show_tagcloud']         : true,
        	'meta_box_cb'           => ( isset( $tax_fields['meta_box_cb'] ) )           ? $tax_fields['meta_box_cb']           : null,
        	'show_admin_column'     => ( isset( $tax_fields['show_admin_column'] ) )     ? $tax_fields['show_admin_column']     : true,
        	'show_in_quick_edit'    => ( isset( $tax_fields['show_in_quick_edit'] ) )    ? $tax_fields['show_in_quick_edit']    : true,
        	'update_count_callback' => ( isset( $tax_fields['update_count_callback'] ) ) ? $tax_fields['update_count_callback'] : '',
        	'show_in_rest'          => ( isset( $tax_fields['show_in_rest'] ) )          ? $tax_fields['show_in_rest']          : true,
        	'rest_base'             => $tax_fields['taxonomy'],
        	'rest_controller_class' => ( isset( $tax_fields['rest_controller_class'] ) ) ? $tax_fields['rest_controller_class'] : 'WP_REST_Terms_Controller',
        	'query_var'             => $tax_fields['taxonomy'],
        	'rewrite'               => ( isset( $tax_fields['rewrite'] ) )               ? $tax_fields['rewrite']               : true,
        	'sort'                  => ( isset( $tax_fields['sort'] ) )                  ? $tax_fields['sort']                  : '',
        );

        $args = apply_filters( $tax_fields['taxonomy'] . '_args', $args );

        register_taxonomy( $tax_fields['taxonomy'], $tax_fields['post_types'], $args );

    }

    /**
     * Assign capabilities to users
     *
     * @link https://codex.wordpress.org/Function_Reference/register_post_type
     * @link https://typerocket.com/ultimate-guide-to-custom-post-types-in-wordpress/
     */
    public function assign_capabilities( $caps_map, $users  ) {

        foreach ( $users as $user ) {

            $user_role = get_role( $user );

            foreach ( $caps_map as $cap_map_key => $capability ) {

                $user_role->add_cap( $capability );

            }

        }

    }

    /**
     * Create post types
     */
    public function create_custom_post_type() {

        $post_types_fields = array(

            array(
                'slug'                  => T_T_DOCTOR_POST_TYPE,
                'singular'              => 'Doctor',
                'plural'                => 'Doctors',
                'menu_name'             => 'Doctors',
                'description'           => 'Doctors',
                'has_archive'           => true,
                'hierarchical'          => false,
                'menu_icon'             => 'dashicons-tag',
                'menu_position'         => 22,
                'public'                => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'show_ui'               => true,
                'show_in_menu'          => false,
                'query_var'             => true,
                'show_in_admin_bar'     => false,
                'show_in_nav_menus'     => true,
                'supports'              => array(
                    'title',
                    'editor',
                    'excerpt',
                    'author',
                    'thumbnail',
                    'comments',
                    'trackbacks',
                    'custom-fields',
                    'revisions',
                    'page-attributes',
                    'post-formats',
                ),
                'taxonomies'            => array(
                    array(
                        'taxonomy'          => 'languages',
                        'plural'            => 'Languages',
                        'single'            => 'Language',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE ),
                    ),
                    array(
                        'taxonomy'          => 'departments',
                        'plural'            => 'Departments',
                        'single'            => 'Department',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE ),
                    ),
                    array(
                        'taxonomy'          => 'body_parts',
                        'plural'            => 'Body Parts',
                        'single'            => 'Body Part',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE ),
                    ),
                    array(
                        'taxonomy'          => 'sub_specialties',
                        'plural'            => 'Sub Specialties',
                        'single'            => 'Sub Specialty',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE ),
                    ),
                    array(
                        'taxonomy'          => 'conditions',
                        'plural'            => 'Conditions',
                        'single'            => 'Condition',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE),
                    ),
                    array(
                        'taxonomy'          => 'procedures',
                        'plural'            => 'Procedures',
                        'single'            => 'Procedure',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE ),
                    ),
                    array(
                        'taxonomy'          => 'patient_ages',
                        'plural'            => 'Patient Ages',
                        'single'            => 'Patient Age',
                        'post_types'        => array( T_T_DOCTOR_POST_TYPE ),
                    ),
                    array(
                        'taxonomy'          => 'insurances',
                        'plural'            => 'Insurances',
                        'single'            => 'Insurance',
                        'post_types'        => array(T_T_DOCTOR_POST_TYPE),
                    ),
                    array(
                        'taxonomy'          => 'injury_types',
                        'plural'            => 'Injury Types',
                        'single'            => 'Injury Type',
                        'post_types'        => array(T_T_DOCTOR_POST_TYPE),
                    ),
                    array(
                        'taxonomy'          => 'hospital_affiliations_tax',
                        'plural'            => 'Hospital Affiliations',
                        'single'            => 'Hospital Affiliation',
                        'post_types'        => array(T_T_DOCTOR_POST_TYPE),
                    ),

                ),
            ),
            array(
                'slug'                  => T_T_LOCATION_POST_TYPE,
                'singular'              => 'Locations',
                'plural'                => 'Locations',
                'menu_name'             => 'Locations',
                'description'           => 'Locations',
                'has_archive'           => true,
                'hierarchical'          => false,
                'menu_icon'             => 'dashicons-tag',
                'menu_position'         => 23,
                'public'                => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'show_ui'               => true,
                'show_in_menu'          => false,
                'query_var'             => true,
                'show_in_admin_bar'     => false,
                'show_in_nav_menus'     => true,
                'supports'              => array(
                    'title',
                    'editor',
                    'excerpt',
                    'author',
                    'thumbnail',
                    'comments',
                    'trackbacks',
                    'custom-fields',
                    'revisions',
                    'page-attributes',
                    'post-formats',
                ),
                'taxonomies'            => array(
                    array(
                        'taxonomy'          => 'loc_departments',
                        'plural'            => 'Departments',
                        'single'            => 'Department',
                        'post_types'        => array( T_T_LOCATION_POST_TYPE ),
                    ),
                ),
            ),

        );

        foreach ( $post_types_fields as $fields ) {

            $this->register_single_post_type( $fields );

        }

    }

}
