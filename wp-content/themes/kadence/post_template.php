<?php
    /**
     * Template Name: Custom Attachment Template
     * Template Post Type: post
     * Author: shivayasharma1149@gmail.com
     */

    /* 

    How to use:
    1. Add this template to your theme folder
    2. Go to functions.php file and copy the code between ADD CUSTOM ATTACHMENT SUPPORT CODE comment to your code
    3. Add the post_template.css file to your theme and link the same with the post_template.php file
    4. Add the JS file post_template.js which is required into your functions.php file for toggling the meta box

    */

    wp_enqueue_style( "post_template_css", get_template_directory_uri() . "/assets/css/post_template.css", array(), "1.0", "all" );
    get_header();

?>

<div class="post-temp-wrapper">
    <section class="post-content-area">

        <?php
            // SHOWING THE CATEGORIES RELATED TO THE POST
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
            <?php 
                // TO SHOW THE TITLE 
                the_title(); 
            ?>
        </h1>

        <?php
            // TO SHOW THE CONTENT RELATED TO THE POST
            the_content();
        ?>

        <div class="tags-section">
            <?php
                // TO SHOW THE TAGS
                $tags = get_the_tags();
                if ($tags) {
                    echo '<div class="tag-title">Tags:</div>';
                    the_tags('<ul class="tags-list"><li>', '</li><li>', '</li></ul>');
                }
            ?>
        </div>
    </section>
    <aside class="media-content-wrapper">

        <!-- TO SHOW THE IMAGE STARTS -->
        <?php 
            // CHECKING IF THERE IS ANY POST THUMBNAIL AVAILABLE
            if (has_post_thumbnail()) {
                // SHOWING THE POST THUMBNAIL
                the_post_thumbnail();
            }
        ?>
        <!-- TO SHOW THE IMAGE ENDS -->

        <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT STARTS -->
        <?php 
            // CHECKING IF THIS POST HAS ANY ATTACHMENT OR NOT 
            $attachment_id = get_post_meta( get_the_ID(), '_custom_attachment_id', true );  
            if ( $attachment_id ) {
                $attachment_url = wp_get_attachment_url( $attachment_id );
        ?>
            <p>
                <a href="<?php echo esc_url( $attachment_url ); ?>" download="attachment.png" class="attachment-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15px" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
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

<?php
    // Retrieve the three most recent posts
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 3,
        'post_status' => 'publish',
        'post__not_in'   => array(get_the_ID()), // Exclude the current post
    ));
    if (count($recent_posts)) {
?>

    <div class="related-post-wrapper">

        <h3 class="other-post-heading">Recent Posts</h3>

        <div class="posts-grid-wrapper">

            <?php
            // Output the recent posts
            foreach ($recent_posts as $recent) {
                $permalink = get_permalink($recent['ID']);
                $title = $recent['post_title'];
                $thumbnail = get_the_post_thumbnail($recent['ID'], '');
                ?>
                    <div class="other-post-card">
                        <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT STARTS -->
                        <?php 
                            // CHECKING IF THIS POST HAS ANY ATTACHMENT OR NOT 
                            $attachment_id = get_post_meta( $recent['ID'], '_custom_attachment_id', true );  
                            if ( $attachment_id ) {
                                $attachment_url = wp_get_attachment_url( $attachment_id );
                        ?>
                            <a href="<?php echo esc_url( $attachment_url ); ?>" download="" class="attachment-card-btn">
                                <span class="tooltip">Download Attached File</span>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                            </a>
                        <?php
                            }
                        ?>
                        <!-- TO SHOW THE DOWNLOAD BUTTON FOR THE ATTACHMENT ENDS -->
                        <a href="<?php echo esc_url($permalink); ?>" class="image-area">
                            <?php echo $thumbnail; ?>
                        </a>
                        <div class="other-post-content-area">
                            <a href="<?php echo esc_url($permalink); ?>" class="title">
                                <h2><?php echo $title; ?></h2>
                            </a>
                            <div class="excerpt-area">
                                <p><?php echo get_the_excerpt($recent['ID']); ?></p>
                            </div>
                            
                            <div class="read-more-link">
                                <a href="<?php echo esc_url($permalink); ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
            ?>
        </div>

    </div>

<?php } ?>

<?php get_footer(); ?>
