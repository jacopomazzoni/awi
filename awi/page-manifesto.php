<?php
/**
    * Template Name: Manifesto Page
    */    
    get_header();
?>
<div id="page-cont" class="col-md-9">
    <div class="row" >
        <h1 class="mb-5"><?php echo get_the_title(); ?></h1>
    </div>
    <div class="row" >
    <div class="col col-md-9" >
    <?php 
    // start the loop
    if (have_posts()) :
        while(have_posts()) :
            the_post();
            the_content();
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
    </div>
    <div class="col-md-3">
    <?php
// all cpost of certain type
$args = array(
    'tax_query' => array(
        array(
            'taxonomy' => 'note_page',
            'field'    => 'slug',
            'terms'    => get_the_title(),
        ),
    ),
    'post_type' => 'notes',
    'posts_per_page' => -1, 
    'orderby' => 'title',
    'order' => 'ASC' 
);

$query = new WP_Query($args);

while ($query->have_posts()): $query->the_post();
?>

<div class="row mb-2">
    <div class="col single-note"> <a href="#<?php the_title();?>">[ <?php the_title(); ?> ]</a> <?php the_content();?></div>
</div>

<?php
endwhile;
 
wp_reset_postdata();
 ?>
    </div>
</div>
    
<?php
    get_footer();
?>

