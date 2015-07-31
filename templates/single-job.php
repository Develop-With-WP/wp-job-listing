<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

//This is simple fetching post meta
$job_fetch_meta = get_post_meta( get_the_ID() );
var_dump( $job_fetch_meta );
echo '<br />';

$job1 = get_post_meta( get_the_ID(), 'date_listed', true );
var_dump($job1);
echo '<br />';

$job2 = get_post_meta( get_the_ID(), 'application_deadline', true );
var_dump($job2);
echo '<br />';

$job3 = get_post_meta( get_the_ID(), 'minimum_requirements', true );
var_dump($job3);