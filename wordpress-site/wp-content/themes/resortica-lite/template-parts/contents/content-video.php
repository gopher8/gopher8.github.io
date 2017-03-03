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
    <?php
     if(is_archive() || is_home()):
        $post_content = trim(get_the_content());
            echo wp_kses_post(resortica_lite_the_featured_video($post_content));
    endif;
    get_template_part( 'template-parts/contents/content', 'part' ); ?>
</div>
