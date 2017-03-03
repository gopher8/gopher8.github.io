<?php
/**
 * Template part for displaying content-image posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resortica-lite
 */

?>
 <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post-content'); ?>>
    <?php $blog_image_id    = get_post_thumbnail_id();
    $blog_image_url   = wp_get_attachment_image_src( $blog_image_id, 'full' );
    $blog_image_title = get_the_title($blog_image_id);
    if(!empty($blog_image_url)):
        ?>
        <div class="post-thumb">
            <img src="<?php echo esc_url($blog_image_url[0]); ?>" alt="<?php the_title(); ?>" title="<?php echo esc_attr($blog_image_title); ?>">
        </div>
         <?php
     endif;
    get_template_part( 'template-parts/contents/content', 'part' ); ?>
</div>
