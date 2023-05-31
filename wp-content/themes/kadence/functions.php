<?php
/**
 * Kadence functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kadence
 */

define( 'KADENCE_VERSION', '1.1.37' );
define( 'KADENCE_MINIMUM_WP_VERSION', '5.4' );
define( 'KADENCE_MINIMUM_PHP_VERSION', '7.2' );

// Bail if requirements are not met.
if ( version_compare( $GLOBALS['wp_version'], KADENCE_MINIMUM_WP_VERSION, '<' ) || version_compare( phpversion(), KADENCE_MINIMUM_PHP_VERSION, '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
// Include WordPress shims.
require get_template_directory() . '/inc/wordpress-shims.php';

// Load the `kadence()` entry point function.
require get_template_directory() . '/inc/class-theme.php';

// Load the `kadence()` entry point function.
require get_template_directory() . '/inc/functions.php';

// Initialize the theme.
call_user_func( 'Kadence\kadence' );

/////////////////////////////////////////////// ADD CUSTOM ATTACHMENT SUPPORT CODE STARTS ////////////////////////////////////////////////////////

// Add the meta box to the post editor screen
function add_custom_attachment_meta_box() {
  add_meta_box(
      'custom_attachment_meta_box', // Unique ID
      'Add Attachment', // Box title
      'custom_attachment_meta_box_callback', // Content callback function
      'post' // Post type
  );
}
add_action( 'add_meta_boxes', 'add_custom_attachment_meta_box' );

// Display the meta box content
function custom_attachment_meta_box_callback( $post ) {
  // Retrieve the current attachment ID, if available
  $attachment_id = get_post_meta( $post->ID, '_custom_attachment_id', true );
  // Output the field HTML
  ?>
    <p id="custom-attachment-id" >
        <label for="custom_attachment">Attachment:</label>
        <br />
        <?php if ( $attachment_id ) { ?>
            <a href="<?php echo esc_url( wp_get_attachment_url( $attachment_id ) ); ?>"><?php echo esc_html( get_the_title( $attachment_id ) ); ?></a>
            <br />
            <input type="checkbox" name="custom_attachment_delete" id="custom_attachment_delete" value="1" />
            <label for="custom_attachment_delete">Delete</label>
        <?php } ?>
        <input type="file" name="custom_attachment" id="custom_attachment" />
        <input type="hidden" name="custom_attachment_id" id="custom_attachment_id" value="<?php echo esc_attr( $attachment_id ); ?>" />
    </p>

  <?php
}

// Save the meta box data
function save_custom_attachment_meta_box_data( $post_id ) {
  // Check if the user has permission to save the post
  if ( ! current_user_can( 'edit_post', $post_id ) ) {
    return;
  }
  // Save or delete the attachment
  if ( isset( $_FILES['custom_attachment'] ) && $_FILES['custom_attachment']['error'] == UPLOAD_ERR_OK ) {
    $attachment_id = media_handle_upload( 'custom_attachment', $post_id );
    if ( is_wp_error( $attachment_id ) ) {
        wp_die( $attachment_id->get_error_message() );
    }
    update_post_meta( $post_id, '_custom_attachment_id', $attachment_id );
  } elseif ( isset( $_POST['custom_attachment_delete'] ) && $_POST['custom_attachment_delete'] == 1 ) {
    $attachment_id = get_post_meta( $post_id, '_custom_attachment_id', true );
    wp_delete_attachment( $attachment_id );
    delete_post_meta( $post_id, '_custom_attachment_id' );
  }
}
add_action( 'save_post', 'save_custom_attachment_meta_box_data' );

function enqueue_post_template_script() {
    wp_enqueue_script( 'post_template_script', get_template_directory_uri() . '/assets/js/post_template/post_template.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_post_template_script' );

/////////////////////////////////////////////// ADD CUSTOM ATTACHMENT SUPPORT CODE ENDS ////////////////////////////////////////////////////////
