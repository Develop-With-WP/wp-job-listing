<?php
/**
 * Plugin Name: WP Job Listing
 * Plugin URI: http://hatrackmedia.com
 * Description: This plugin allows you to add a simple job listing section to your WordPress website.
 * Author: Bobby Bryant
 * Author URI: http://hatrackmedia.com
 * Version: 0.0.1
 * License: GPLv2
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'wp-job-cpt.php' );
require_once ( plugin_dir_path(__FILE__) . 'wp-job-settings.php' );
require_once ( plugin_dir_path(__FILE__) . 'wp-job-fields.php' );
require_once ( plugin_dir_path(__FILE__) . 'wp-job-shortcode.php' );

function dwwp_admin_enqueue_scripts() {
	global $pagenow, $typenow;

	if ( $typenow == 'job') {

		wp_enqueue_style( 'dwwp-admin-css', plugins_url( 'css/admin-jobs.css', __FILE__ ) );

	}

	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'job' ) {
		
		wp_enqueue_script( 'dwwwp-job-js', plugins_url( 'js/admin-jobs.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), '20150204', true );
		wp_enqueue_script( 'dwwp-custom-quicktags', plugins_url( 'js/dwwp-quicktags.js', __FILE__ ), array( 'quicktags' ), '20150206', true );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );

	}

	if ( $pagenow =='edit.php' && $typenow == 'job') {

		wp_enqueue_script( 'reorder-js', plugins_url( 'js/reorder.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), '20150626', true );
		wp_localize_script( 'reorder-js', 'WP_JOB_LISTING', array(
			'security' => wp_create_nonce( 'wp-job-order' ),
			'success' => __( 'Jobs sort order has been saved.' ),
			'failure' => __( 'There was an error saving the sort order, or you do not have proper permissions.' )
		) );

	}

}
add_action( 'admin_enqueue_scripts', 'dwwp_admin_enqueue_scripts' );





