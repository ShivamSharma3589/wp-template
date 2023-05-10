<!-- Including the header  -->
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h2><?php the_title() ;?></h2>
<?php the_post_thumbnail(); ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php the_excerpt(); ?>
<?php endwhile; else : ?>
  <p><?php _e( 'No Posts To Display.' ); ?></p>
  <?php endif; ?> 

<!-- Including the footer -->
<?php get_footer(); ?>