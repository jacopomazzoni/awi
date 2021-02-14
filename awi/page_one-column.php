<?php
/**
    * Template Name: One Column
    */    get_header();
?>
<div id="page-cont" class="col-md-9 m-0">
<h1 class="mb-5"><?php echo get_the_title(); ?></h1>
    <?php 
    // start the loop
    if (have_posts()) :
        while(have_posts()) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
    </div>

<?php
    get_footer();
?>