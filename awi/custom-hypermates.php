<?php
/*
---------  Custom Classes Post Type --------
*/
$prefix = 'awi_';

function create_hypermates_post_type() {
    register_post_type( 'awi_hypermates',
        array(
            'labels' => array(
                'name' => __( 'Hypermates','awi' ),
                'singular_name' => __( 'Hypermate','awi' )
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-groups',
            'supports' => array(
                'title',
                'thumbnail'

            )
        )
    );  
}

add_action( 'init', 'create_hypermates_post_type' );
      
$hypermates_meta_box = array(

    'id' => 'awi_hypermates',
    'title' => 'Add New Hypermate',
    'page' => 'awi_hypermates',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Hypermate Name'),
            'descr' => __('Enter the name of the Hypermate'),
            'id' => $prefix . 'hypermate_name',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('Hypermate Description'),
            'descr' => __('Please write a paragraph describing the Hypermate'),
            'id' => $prefix . 'description',
            'type' => 'textarea',
            'std' => 'Enter description'
        )
        
        
    ) //fields array


); // meta_box aray    
          
/*   add_action('admin_menu', 'awi_add_hypermate');
 */  
add_action( 'add_meta_boxes', 'awi_add_hypermate' );
  // Add meta box
  
  function awi_add_hypermate() {
    global $hypermates_meta_box;
    add_meta_box(
        $hypermates_meta_box['id'], 
        $hypermates_meta_box['title'], 
        'awi_show_hypermate_box', 
        $hypermates_meta_box['page'], 
        $hypermates_meta_box['context'], 
        $hypermates_meta_box['priority']
    );
  }
  
  
  function awi_show_hypermate_box() {
      global $hypermates_meta_box, $hypermates_post_id;
  
      // Use nonce for verification
      echo '<input type="hidden" name="hypermate_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
  
      echo '<table class="form-table">';
  
      foreach ($hypermates_meta_box['fields'] as $field) {
          // get current post meta data
          $meta = get_post_meta($hypermates_post_id, $field['id'], true);
  
          echo '<tr>',
                  '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                  '<td>';
          switch ($field['type']) {
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
  
  add_action('save_post', 'hypermates_save_data');
  
  
// Save data from meta box
function hypermates_save_data($hypermates_post_id) {
    global $hypermates_meta_box;

    // verify nonce
    if ( isset($_POST['hypermates_meta_box_nonce'])) {
        $tmp =$_POST['hypermates_meta_box_nonce'];
    } else {
        $tmp = null;
    }

    if (!wp_verify_nonce($tmp, basename(__FILE__))) {
        return $hypermates_post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $hypermates_post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $hypermates_post_id)) {
            return $hypermates_post_id;
        }
    } elseif (!current_user_can('edit_post', $hypermates_post_id)) {
        return $hypermates_post_id;
    }

    foreach ($hypermates_meta_box['fields'] as $field) {
        $old = get_post_meta($hypermates_post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($hypermates_post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($hypermates_post_id, $field['id'], $old);
        }
    }
}
