<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function for handling the insertion of the scripts
function wpt_load_scripts() {

  ////////////////////////////////////////////////
  // CSS STARTS

  /**
   * 1. unique name
   * 2. path
   * 3. dependency array
   * 4. version
   * 5. support type
   */
  // Including the Bootstrap version 5.0
  wp_enqueue_style( "bootstrap_5", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css", array(), "5.0", "all" );

  // Including the main CSS of the theme
  wp_enqueue_style( "wpt_index_css", get_template_directory_uri() . "/assets/css/index.css", array("bootstrap_5"), "1.0", "all" );

  // Including the theme style.css file
  wp_enqueue_style( "wpt_style", get_stylesheet_uri(), array(), "1.0", "all" );

  // CSS ENDS
  ///////////////////////////////////////////////

  ///////////////////////////////////////////////
  // JS STARTS 

  // To deregister the jquery already being used in the wordpress
  wp_deregister_script('jquery');


  /**
   * 1. Unique Name
   * 2. Path Name
   * 3. Dependency
   * 4. Version
   * 5. Where to put the script -> Footer = true && Header = false
   */
  // Adding jquery dependency
  wp_enqueue_script( "jquery", "https://code.jquery.com/jquery-3.6.0.min.js", array(), "3.6", false );

  // Including Bootstrap 5 JS
  wp_enqueue_script( "bootstrap_5_js", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js", array(), "5.0", true );

  // Including the theme JS
  wp_enqueue_script( "wpt_index_js", get_template_directory_uri() . "/assets/js/index.js", array('jquery'), "1.0", true );
  // JS ENDS
  ///////////////////////////////////////////////

}

// Calling the function above which requires the add_action hook 
// wp_enqueue_scripts defines what does the function do
add_action("wp_enqueue_scripts", "wpt_load_scripts");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Function for initial configuration of the theme created
function wpt_config() {

  ///////////////////////////////////////////////
  // Registering the Nav Menus in the theme
  // Passing a list of slug names in the array for registering the number of menus
  register_nav_menus(
    array(
      // slug_name => "Title of the Slug"
      'mytheme_main_menu' => 'Header Menu',
      'mytheme_footer_menu' => 'Footer Menu'
    )
  );

  // Once register the menus you need to call the navigation menu in your HTML 
  // through wp_nav_menu()

  ///////////////////////////////////////////////

  // Adding theme support for the logo
  add_theme_support('custom-logo', array(
    'width'                   => 200,
    'height'                  => 110,
    'flex-height'             => true,
    'flex-width'              => true,
    ) 
  );

  // Adding theme support for the header image
  add_theme_support( 'custom-header', array(
      'width'                  => 1920,
      'height'                 => 600,
      'flex-height'            => true,
      'flex-width'             => true,
      'header-text'            => true,
      'uploads'                => true,
      'default-image'          => get_template_directory_uri() . '/assets/img/mytheme-header-image.jpg',
    ) 
  );

  // Adding the dynamic title support
  // add_theme_support('title-tag');

  // Adding theme support for post thumbnails 
  add_theme_support( 'post-thumbnails' );

}

// After creating the function above. we need the add the add_action hook to call the function.
add_action( 'after_setup_theme', 'wpt_config', 0 ); 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Add the meta box to the post editor screen
function add_custom_attachment_meta_box() {
  add_meta_box(
      'custom_attachment_meta_box', // Unique ID
      'Custom Attachment', // Box title
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
  <p>
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
