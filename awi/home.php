<?php
/* Main Template */

    get_header();

?>
<style type="text/css">   @import url("<?php echo esc_url( get_template_directory_uri() );?>/assets/css/blue.css"); </style>

<div id="page-cont" class="col-md-9 m-0">
    
    <h1 style="font-size: 10vw!important"><?php echo get_the_title(); ?></h1>
</div>

<?php get_footer(); ?>