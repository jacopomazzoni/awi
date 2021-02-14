<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content/content-single','hypermate' );
	if ( is_attachment() ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: parent post link. */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'awi' ), '%title' ),
			)
		);
	}

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	// Previous/next post navigation.
	$awi_next = is_rtl() ? '<' : '>';
	$awi_prev = is_rtl() ? '>' : '<';

	$awi_next_label     = esc_html__( 'Next post', 'awi' );
	$awi_previous_label = esc_html__( 'Previous post', 'awi' );

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $awi_next_label . $awi_next . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">' . $awi_prev . $awi_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

get_footer();
