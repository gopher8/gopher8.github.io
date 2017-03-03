<?php
/**
 * Template part for displaying content-gallery posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resortica-lite
 */

?>

 <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post-content'); ?>>
    <?php $image_url = get_post_gallery_images($post);
    if(!empty($image_url)): ?>
            <div class="resortica-gallery-carousel owl-carousel">
                <?php foreach( $image_url as $image ) { ?>
                <div  style="background-image: url(<?php echo esc_url($image) ?>)">
                </div>
                <?php } ?>
            </div>
         <?php
    endif;
   ?>
   <div class="blog-content-body">
    <h2><?php the_title(); ?></h2>
    <div class="metabar">
        <span class="byline"><i class="fa fa-user" aria-hidden="true"></i> <span class="author vcard"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a></span></span>
        <span class="posted-on"><i class="fa fa-clock-o" aria-hidden="true"></i><a href="<?php echo esc_url(resortica_lite_archive_link($post)); ?>"><?php echo get_the_date('F d, Y'); ?></time></a></span>

        <span class="post-comments"><i class="fa fa-comments" aria-hidden="true"></i><?php comments_popup_link( 'No comment', '1', '%', '', '-' ); ?></span>

    </div>
    <div class="post-desc">
        <?php if(is_archive() || is_home()):
            the_excerpt();
        else:
            echo strip_shortcodes(wpautop(get_the_content()));
        endif;
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'resortica-lite' ),
            'after'  => '</div>',
        ) ); ?>
    </div>
    <?php if(!is_single()): ?>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-def">
            <?php esc_html_e( 'Read More', 'resortica-lite' );?>
        </a>
    <?php endif; ?>

</div>
</div>