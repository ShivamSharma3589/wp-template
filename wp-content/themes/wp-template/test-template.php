<?php
/**
 * Template Name: Test Template
 */
?>

<!-- Including the header  -->
<?php get_header(); ?>

<?php
  echo get_the_title();
  echo get_the_content( );
?>

<!-- Including the footer -->
<?php get_footer(); ?>