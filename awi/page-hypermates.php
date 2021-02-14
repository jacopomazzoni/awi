<?php
/**
* Template Name: Hypermates Page
*/    
    get_header();
?>
<div id="page-cont" class="col-md-9 m-0">
    <div class="row" >
        <h1 class="mb-5"><?php echo get_the_title(); ?></h1>
    </div>
    <div class="row" >
    <div class="col" >
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
</div>
<div class="row">
    <div class="col-md-3">
    <?php
        $args = array( 
            'post_type' => 'awi_hypermates',  
            'meta_key' => $prefix . 'hypermate_name', 
            'orderby' => 'meta_value', 
            'order' => 'ASC' 
        );

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();
          the_content();
              $meta_box_fields = $hypermates_meta_box['fields'];
              var_dump($meta_box_fields);
              // returns the key for the Name field for each Class
              $note_number_key = $meta_box_fields[0]['id'];
              $note_number_value = get_post_meta($post->ID, $note_number_key, true);
              
              // returns the key for the Instructor field
              $note_text_key = $meta_box_fields[1]['id'];
              $note_text_value = get_post_meta ($post->ID, $note_text_key, true);
                            
              ?>
              <div class="row">
                <a href="#<?php echo $note_number_value; ?>">[<?php echo $note_number_value; ?>] <?php echo $note_text_value; ?></a>
              </div>
        
         <?php endwhile; ?>
    </div>
</div>
    
<?php
    get_footer();
?>