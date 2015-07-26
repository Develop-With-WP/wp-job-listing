<?php

function dwwp_register_post_type() {

	$singular = __( 'Job Listing' );
	$plural = __( 'Job Listings' );
        //Used for the rewrite slug below.
        $plural_slug = str_replace( ' ', '_', $plural );

        //Setup all the labels to accurately reflect this post type.
	$labels = array(
		'name' 					=> $plural,
		'singular_name' 		=> $singular,
		'add_new' 				=> 'Add New',
		'add_new_item' 			=> 'Add New ' . $singular,
		'edit'		        	=> 'Edit',
		'edit_item'	        	=> 'Edit ' . $singular,
		'new_item'	        	=> 'New ' . $singular,
		'view' 					=> 'View ' . $singular,
		'view_item' 			=> 'View ' . $singular,
		'search_term'   		=> 'Search ' . $plural,
		'parent' 				=> 'Parent ' . $singular,
		'not_found' 			=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
	);

        //Define all the arguments for this post type.
	$args = array(
		'labels' 			  => $labels,
		'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_in_nav_menus'   => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-admin-site',
        'can_export'          => true,
        'delete_with_user'    => false,
        'hierarchical'        => false,
        'has_archive'         => true,
        'query_var'           => true,
        'capability_type'     => 'page',
        'map_meta_cap'        => true,
        // 'capabilities' => array(),
        'rewrite'             => array( 
        	'slug' => strtolower( $plural_slug ),
        	'with_front' => true,
        	'pages' => true,
        	'feeds' => false,

        ),
        'supports'            => array( 
        	'title'
        )
	);

        //Create the post type using the above two varaiables.
	register_post_type( 'job', $args);
}
add_action( 'init', 'dwwp_register_post_type' );


function dwwp_register_taxonomy() {

	$plural = __( 'Locations' );
	$singular = __( 'Location' );


	$labels = array(
		'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Search ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'All ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit ' . $singular,
        'update_item'                => 'Update ' . $singular,
        'add_new_item'               => 'Add New ' . $singular,
        'new_item_name'              => 'New ' . $singular . ' Name',
        'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
        'add_or_remove_items'        => 'Add or remove ' . $plural,
        'choose_from_most_used'      => 'Choose from the most used ' . $plural,
        'not_found'                  => 'No ' . $plural . ' found.',
        'menu_name'                  => $plural,
	);

	$args = array(
		'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => strtolower( $singular ) ),
	);

	register_taxonomy( strtolower( $singular ), 'job', $args );

}

add_action( 'init', 'dwwp_register_taxonomy' );

function dwwp_load_templates( $original_template ) {

       if ( get_query_var( 'post_type' ) !== 'job' ) {

               return;

       }

       if ( is_archive() || is_search() ) {

               if ( file_exists( get_stylesheet_directory(). '/archive-job.php' ) ) {

                     return get_stylesheet_directory() . '/archive-job.php';

               } else {

                       return plugin_dir_path( __FILE__ ) . 'templates/archive-job.php';

               }

       } else {

               if (  file_exists( get_stylesheet_directory(). '/single-job.php' ) ) {

                       return get_stylesheet_directory() . '/single-job.php';

               } else {

                       return plugin_dir_path( __FILE__ ) . 'templates/single-job.php';

               }

       }

        return $original_template;


}
add_action( 'template_include', 'dwwp_load_templates' );
















