<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Blanche
 */

get_header(); ?>

<div id="wrapper">
  <div id="contentwrapper" class="animated fadeIn">
    <div id="content">
      <?php while ( have_posts() ) : the_post(); ?>
      <div <?php post_class(); ?>>
        <h1 class="entry-title">
          <?php the_title(); ?>
        </h1>
        <div class="postcat"><span><?php echo get_the_date(); ?></span>
          <?php the_category( ', ' ); ?>
        </div>
        <?php the_post_thumbnail('blanche-blogthumb'); ?>
        <div class="entry">
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<p><strong>'. esc_html__( 'Pages:', 'blanche-lite' ) .'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
          <?php edit_post_link(); ?>
          <?php echo get_the_tag_list('<p class="singletags">',' ','</p>'); ?>
          <div class="post-navigation">
            <div class="nav-previous">
              <?php previous_post_link( '%link' ) ?>
            </div>
            <div class="nav-next">
              <?php next_post_link( '%link' ) ?>
            </div>
          </div>
          <?php comments_template(); ?>
        </div>
      </div>
      <?php endwhile; // end of the loop. ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>
