<?php
/**
 * Template Name: Custom Attachment Template
 * Template Post Type: post
 * author: shivayasharma1149@gmail.com
 */
wp_enqueue_style( "post_template_css", get_template_directory_uri() . "/assets/css/post_template.css", array(), "1.0", "all" );
get_header();

?>

<div class="post-temp-wrapper">
    <section class="post-content-area">

        <?php
            $categories = get_the_category(); // Retrieve the categories assigned to the post
            if ($categories) {
                echo '<div class="categories-wrapper">';
                    echo '<div class="category-title">Categories:</div>';
                    echo '<ul class="categories-section">';
                    foreach ($categories as $category) {
                        $category_link = get_category_link($category->term_id); // Get the link to the category archive page
                        echo '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></li>'; // Display category name with link
                    }
                    echo '</ul>';
                echo '</div>';
            }
        ?>

        <h1>
            <?php the_title(); ?>
        </h1>

        <div class="tags-section">
            <?php
                $tags = get_the_tags();
                if ($tags) {
                    echo '<div class="tag-title">Tags:</div>';
                    the_tags('<ul class="tags-list"><li>', '</li><li>', '</li></ul>');
                }
            ?>
        </div>

        <?php
            the_content();
        ?>
    </section>
    <aside class="media-content-wrapper">

        <!-- TO SHOW THE IMAGE STARTS -->
        <?php 
            if (has_post_thumbnail()) {
                the_post_thumbnail();
            }
        ?>
        <!-- TO SHOW THE IMAGE ENDS -->

        <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT STARTS -->
        <?php 
            $attachment_id = get_post_meta( get_the_ID(), '_custom_attachment_id', true );  
            if ( $attachment_id ) {
                $attachment_url = wp_get_attachment_url( $attachment_id );
        ?>
            <p>
                <a href="<?php echo esc_url( $attachment_url ); ?>" download="attachment.png" class="attachment-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                        <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                    </svg>
                    Download
                </a>
            </p>
        <?php
            }
        ?>
        <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT ENDS -->
    </aside>
</div>

<div class="related-post-wrapper">
    <?php
        $related_posts = new WP_Query(
            array(
                'posts_per_page' => 3, // Number of posts to display
                'post__not_in'   => array(get_the_ID()), // Exclude the current post
                'orderby'        => 'date', // Order by date
                'order'          => 'DESC', // Sort in descending order
            )
        );

        if ($related_posts->have_posts()) {
            ?>
            <h3 class="other-post-heading">Recent Posts</h3>

            <div class="posts-grid-wrapper">
                <?php 
                    while ($related_posts->have_posts()) {
                        $related_posts->the_post();
                        ?>
                            <div class="other-post-card">
                                <a href="<?php esc_url(get_permalink()); ?>" class="image-area">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <div class="other-post-content-area">
                                    <a href="<?php esc_url(get_permalink()); ?>" class="title">
                                        <h2><?php the_title() ?></h2>
                                    </a>
                                    <p class="excerpt-area"><?php the_excerpt() ?></p>
                                    <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT STARTS -->
        <?php 
            $attachment_id = get_post_meta( get_the_ID(), '_custom_attachment_id', true );  
            if ( $attachment_id ) {
                $attachment_url = wp_get_attachment_url( $attachment_id );
        ?>
            <p>
                <a href="<?php echo esc_url( $attachment_url ); ?>" download="attachment.png" class="attachment-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                        <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                    </svg>
                    Download
                </a>
            </p>
        <?php
            }
        ?>
        <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT ENDS -->
                                    <div class="read-more-link">
                                        <a href="<?php esc_url(get_permalink()); ?>">Read more</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    wp_reset_postdata(); // Restore the original post data
                ?>
            </div>
            <?php            
        }
    ?>
</div>

<?php get_footer(); ?>











<!-- <div class="posts-grid-wrapper">
                <div class="other-post-card">
                    <a href="#" class="image-area">
                        <img src="http://localhost/wp-template/wp-content/uploads/2023/05/img-feat-web-design-1024x576-1.jpg" alt="">
                    </a>
                    <div class="other-post-content-area">
                        <a href="#" class="title">
                            <h2>I am the title</h2>
                        </a>
                        <p class="excerpt-area">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, ad! Sunt corporis quis aperiam laboriosam temporibus. Beatae, quasi. Nostrum necessitatibus ab impedit laboriosam.</p>
                        <div class="read-more-link">
                            <a href="#">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="other-post-card">
                    <a href="#" class="image-area">
                        <img src="http://localhost/wp-template/wp-content/uploads/2023/05/img-feat-web-design-1024x576-1.jpg" alt="">
                    </a>
                    <div class="other-post-content-area">
                        <a href="#" class="title">
                            <h2>I am the title</h2>
                        </a>
                        <p class="excerpt-area">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, ad! Sunt corporis quis aperiam laboriosam temporibus. Beatae, quasi. Nostrum necessitatibus ab impedit laboriosam.</p>
                        <div class="read-more-link">
                            <a href="#">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="other-post-card">
                    <a href="#" class="image-area">
                        <img src="http://localhost/wp-template/wp-content/uploads/2023/05/img-feat-web-design-1024x576-1.jpg" alt="">
                    </a>
                    <div class="other-post-content-area">
                        <a href="#" class="title">
                            <h2>I am the title</h2>
                        </a>
                        <p class="excerpt-area">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, ad! Sunt corporis quis aperiam.</p>
                        <div class="read-more-link">
                            <a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div> -->
