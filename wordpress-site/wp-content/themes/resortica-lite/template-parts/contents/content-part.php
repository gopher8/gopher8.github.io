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
            the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'resortica-lite' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
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