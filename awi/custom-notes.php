<?php
/*
---------  Custom notes Post Type --------
*/
$prefix = 'awi_';

function create_post_type() {
    register_post_type( 'manifesto',
        array(
            'labels' => array(
                'name' => __('Notes','awi'),
                'singular_name' => __('Note','awi') 
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-editor-ol',
            'supports' => array(
                'title',
            )
        )
    );
}

add_action('init','create_post_type');


$meta_box = array(
    
    'id' => 'Notes',
    'title' => 'Add New Note',
    'page' => 'manifesto',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Note Number',
            'descr' => 'Reference Number',
            'id' => $prefix . 'note_number',
            'type' => 'number',
            'std' => 1
        ),
        array(
            'name' => 'Note',
            'descr' => 'Note',
            'id' => $prefix . 'note',
            'type' => 'textarea',
            'std' => 'Note'
        )
        
    ) //fields array


); // meta_box aray    
    
/* add_action('admin_menu', 'awi_add_notes');
 */  add_action( 'add_meta_boxes', 'awi_add_notes' );


// Add meta box

function awi_add_notes() {
    global $meta_box;
    
    add_meta_box(
        $meta_box['id'], 
        $meta_box['title'], 
        'awi_show_box', 
        $meta_box['page'], 
        $meta_box['context'], 
        $meta_box['priority']
    );
}

function awi_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="awi_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'number':
                echo '<input type="number" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['descr'];
                break;
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['descr'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['descr'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
            case 'theme_colors':
                 echo $field['descr'], '<br><br>';
                 foreach($field['options'] as $option){
                     echo '<label>', $option['color'], ' <input type="radio" name="', $field['id'], '" value="', $option['color'], '" id="', $field['id'] . '_' . strtolower($option['color']), '"class="', $field['class'], '"', $meta == $option['color'] ? ' checked="checked"' : '', ' /></label><br>';
                 }
        }
        echo     '</td><td>',
            '</td></tr>';
    }

    echo '</table>';
}

add_action('save_post', 'awi_save_data');

// Save data from meta box
function awi_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if ( isset($_POST['awi_meta_box_nonce'])) {
        $tmp =$_POST['awi_meta_box_nonce'];
    } else {
        $tmp = null;
    }
    if (!wp_verify_nonce($tmp, basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
