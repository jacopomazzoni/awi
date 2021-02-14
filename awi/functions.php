<?php 
/* require get_template_directory().'/fontmanager/fontmanager.php';
require get_template_directory().'/options/misc_options.php';
require get_template_directory().'/setup/setup.php'; */

/* -- mandatory garbage -- */
if ( ! isset( $content_width ) ) {
	$content_width = 2000;
}

// define prefix 
$prefix = 'awi_';

if ( ! function_exists('awi_setup')):
    function awi_setup() {
        // let wordpress handle the title tags
        add_theme_support('title-tag');
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
    }
endif;

add_action('after_setup_theme','awi_setup');

/* ----- Register Menu ------ */

function register_awi_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu','awi')
        )
    );
}
add_action('init','register_awi_menus');

/* ----- Register Stylesheet ------ */

function awi_scripts() {
    // Enqueue Main Stylesheet
    wp_enqueue_style('awi_styles', get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts','awi_scripts');

/* ----- Register Widgets ------ */
/* function awi_widget_init() {
    register_sidebar( array (
        'name' => __('manifesto-notes','awi'),
        'id' => 'notes',
        'description' => __('Widgets added here will go in the manifesto notes','awi'),
        'before-widget' => '<div id="%1$s" class="widget %2$s">',
        'after-widget' => '</div>'
    ));
}

add_action('widgets_init','awi_widget_init');
 */




/* ----- Register Custom Post Types ------ */
/* 
require get_template_directory().'/custom-notes.php';
require get_template_directory().'/custom-hypermates.php';
 */


/* add_action( 'load-edit.php', 'awi_remove_note_title' );
function awi_remove_note_title() {
    remove_post_type_support( 'manifesto', 'title' );
} */


/* Add custom editor button code */
include "swpbtn-shortcode.php";

function swp_btn_func( $atts ) {
    $a = shortcode_atts( array(
        'link' => '',
  'name' => 'Try it Out',
        'color' => 'green',
    ), $atts );

    return '<div class="swp-btn">
    <a style="background-color:' . $a['color'] . ';" class="" href="' . $a['link'] . '" target="_blank">' . $a['name'] . '</a>
      </div>';
}
add_shortcode( 'swp-btn', 'swp_btn_func' );



// Enable font size & font family selects in the editor
if ( ! function_exists( 'wpex_mce_buttons' ) ) {
	function wpex_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'fontselect' ); // Add Font Select
		array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'wpex_mce_buttons' );




/* function my_format_TinyMCE( $in ) {
	$in['remove_linebreaks'] = false;
	$in['gecko_spellcheck'] = false;
	$in['keep_styles'] = true;
	$in['accessibility_focus'] = true;
	$in['tabfocus_elements'] = 'major-publishing-actions';
	$in['media_strict'] = false;
	$in['paste_remove_styles'] = false;
	$in['paste_remove_spans'] = false;
	$in['paste_strip_class_attributes'] = 'none';
	$in['paste_text_use_dialog'] = true;
	$in['wpeditimage_disable_captions'] = true;
	$in['plugins'] = 'tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
	$in['content_css'] = get_template_directory_uri() . "/editor-style.css";
	$in['wpautop'] = true;
	$in['apply_source_formatting'] = false;
        $in['block_formats'] = "Paragraph=p; Heading 3=h3; Heading 4=h4";
	$in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
	$in['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help ';
	$in['toolbar3'] = '';
	$in['toolbar4'] = '';
	return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' ); */



/* toolbar3: 'styleselect',
style_formats_merge: true,
style_formats: { name: 'Custom styles', [
  {title: 'Red bold text', inline: 'b', styles: {color: '#ff0000'}},
  {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
  {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
  {title: 'Example 1', inline: 'span', classes: 'example1'},
  {title: 'Example 2', inline: 'span', classes: 'example2'}
]} */

register_sidebar( array(
    'name' => '404 Page',
    'id' => '404',
    'description' => __( 'Content for your 404 error page goes here.' ),
    'before_widget' => '<div id="error-box">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>'
    ) ); 


//* GUTEMBERG STUFF */

/*     function slug_post_type_template() {
        $page_type_object = get_post_type_object( 'notes' );
        $page_type_object->template = [
            [ 'core/group', [], [
                [ 'core/code' ],
            ] ],
        ];
    }
    add_action( 'init', 'slug_post_type_template' ); */

function notes_register_template() {
    $post_type_object = get_post_type_object( 'notes' );
    $post_type_object->template = array(
        array( 'core/html', array(
            'placeholder' => 'Add Note...',
        ) ),
    );
    $post_type_object->template_lock = 'all';
}
add_action( 'init', 'notes_register_template' );



add_filter( 'enter_title_here', 'custom_enter_title' );

function custom_enter_title( $input ) {
    if ( 'notes' === get_post_type() ) {
        return __( 'Insert Note Number', 'awi' );
    }

    return $input;
}
