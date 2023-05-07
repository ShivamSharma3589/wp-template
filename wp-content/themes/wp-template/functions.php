<?php

/**
 * function for handling the stylesheets and scripts
 * @return null
 */
function wpt_load_scripts() {

  ////////////////////////////////////////////////
  // CSS STARTS

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

  // deregister jquery if any old jquery older version has been installed 
  wp_deregister_script('jquery');

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
add_action("wp_enqueue_scripts", "wpt_load_scripts");