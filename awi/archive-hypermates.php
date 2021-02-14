<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();

$description = get_the_archive_description();
?>

<div id="page-cont" class="col-md-9 m-0">
<h1 class="mb-5">Hypermates</h1>

<?php if ( have_posts() ) : ?>

		<?php //the_archive_title( '<h1 class="page-title">', '</h1>' ); 
		?>
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>

	<?php while ( have_posts() ) : ?>
		<?php 
		the_post();
        get_template_part( 'template-parts/content/content-excerpt', 'hypermates'  ); 
        ?>
	<?php endwhile; ?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
