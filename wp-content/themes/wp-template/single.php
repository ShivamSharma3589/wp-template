<!-- Including the header  -->
<?php get_header(); ?>

<?php
  echo get_the_title();
  echo get_the_content( );
?>

<?php
// $custom_upload = get_post_meta( get_the_ID(), 'custom_upload', true );
// if ( ! empty( $custom_upload ) ) {
//     echo '<p><a href="' . esc_url( $custom_upload ) . '">Download file</a></p>';
// }
?>

<?php
// Retrieve the attachment URL for the current post
$attachment_url = get_post_meta( get_the_ID(), '_custom_attachment_url', true );
// Output the attachment link, if available
if ( $attachment_url ) {
    ?>
    <p>
        <a href="<?php echo esc_url( $attachment_url ); ?>" target="_blank">Download Attachment</a>
    </p>
    <?php
} ?>

<?php
$attachment_id = get_post_meta( get_the_ID(), '_custom_attachment_id', true );
if ( $attachment_id ) {
    $attachment_url = wp_get_attachment_url( $attachment_id );
    ?>
    <p>
        <a href="<?php echo esc_url( $attachment_url ); ?>" download="attachment.png" class="btn btn-primary">Download Attachment</a>
    </p>
    <?php
}
?>



<?php
// $file_path = get_post_meta( get_the_ID(), 'attachment_file_path', true );
// if ( $file_path ) {
//     ?>
<!-- <p><strong>Attachment:</strong> <a href="<?php echo esc_url( $file_path ); ?>" download>Download</a></p> -->
    <?php
// }
?>

<!-- Including the footer -->
<?php get_footer(); ?>

<!-- <label for="custom_upload">Upload File:</label>
<input type="file" name="custom_upload" id="custom_upload"> -->
