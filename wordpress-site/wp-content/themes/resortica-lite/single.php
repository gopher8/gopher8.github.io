<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package resortica-lite
 */

get_header();
    ?>
 <div class="sec-content single-content" id="primary">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/contents/content', get_post_format() );

                        if ( get_the_category_list() != '' ) { ?>
                            <span class="resortica-lite-cats"><?php esc_attr_e( 'Category : ','resortica-lite' );
                            the_category( ' , ' ); ?></span>
                            <?php }
                        if ( get_the_tag_list() != '' ) { ?>
                            <span class="resortica-lite-tags"><?php the_tags( __( 'Tags : ','resortica-lite' ), ' , ' ); ?></span>
                            <?php }

						the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop. ?>

            </div>
            <div class="col-md-4 sidebar">
				<?php get_sidebar(); ?>
			</div>
        </div>
    </div>
</div>
<?php get_footer();
