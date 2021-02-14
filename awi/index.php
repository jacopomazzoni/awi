<?php
/* Main Template */

    get_header();

?>

<div id="page-cont" class="col-md-9 m-0">
    

    <h1 class="mb-5"><?php
   /* if($post->post_parent) {
      $title = get_the_title($post->post_parent);
      $title .= " / </br>" . get_the_title();
      echo $title;
   }
   else {
      echo get_the_title($post->ID);
   } */
   echo get_the_title($post->ID);
?></h1>
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

<?php get_footer(); ?>