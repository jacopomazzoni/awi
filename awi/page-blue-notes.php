<?php
/**
    * Template Name: BLUE Page with Notes
    */    
    get_header();
?>
<style type="text/css">   @import url("<?php echo esc_url( get_template_directory_uri() );?>/assets/css/blue.css"); </style>
>
<div id="page-cont" class="col-md-9 m-0">
    <div class="row" >
        <h1 class="mb-5"><?php echo get_the_title(); ?></h1>
    </div>
    <div class="row" >
    <div class="col-md-9" >
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
    'posts_per_page' => -1
);

$query = new WP_Query($args);

while ($query->have_posts()) {
    
    $query->the_post();
    echo "<p>[" . get_the_title() . "] " . get_the_content() . "</p>";
}
 ?>
    </div>
</div>
    
<?php
    get_footer();
?>