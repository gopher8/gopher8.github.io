<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package resortica-lite
 */

get_header(); ?>

<div class="sec-content archive-content" id="primary">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

				<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'resortica-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->

						<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/contents/content', 'search' );

							endwhile;

							the_posts_navigation();

						else :

							get_template_part( 'template-parts/contents/content', 'none' );

				endif; ?>

            </div>
            <div class="col-md-4 sidebar">
				<?php get_sidebar(); ?>
			</div>
        </div>
    </div>
</div>
<?php get_footer();
