<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resortica-lite
 */

get_header(); ?>
 <div class="sec-content single-content" id="primary">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
					<main id="main" class="site-main" role="main">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/contents/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

						</main><!-- #main -->
				</div>
				<div class="col-md-4 sidebar">
				<?php get_sidebar(); ?>
			</div>
        </div>
    </div>
</div>

<?php
get_footer();
