<?php
/**
*
*
* Template Name: Blank Container
*
**/
get_header(); ?>

 <div class="sec-content single-content" id="primary">
    <div class="container">
        <div class="row">
                    <main id="main" class="site-main" role="main">

                        <?php
                        while ( have_posts() ) : the_post();

                            the_content();

                        endwhile; // End of the loop.
                        ?>

                        </main><!-- #main -->
                </div>
        </div>

    <?php get_footer();?>
</div>
