<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/header/excerpt-header', get_post_format() ); ?>

	<div class="entry-content">
		<?php        
		the_title( '<h1 class="entry-title">', '</h1>' );
		the_post_thumbnail('large');
		the_content();

 ?>
	<p class="taxonomy-continent"> <?php echo get_the_term_list( get_the_ID(), 'continent' , '[' , ' ' , ']'); ?></p>
	</div><!-- .entry-content -->

	
</article><!-- #post-${ID} -->
