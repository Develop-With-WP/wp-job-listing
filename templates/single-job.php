<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				$job_fetch_meta = get_post_meta( get_the_ID() );
				$job_meta = array_map( function( $a ){ return $a[0]; }, $job_fetch_meta );
				var_dump( $job_meta );
				?>

				<div>

				</div>

				<?php

				// End the loop.
			endwhile;
			?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>