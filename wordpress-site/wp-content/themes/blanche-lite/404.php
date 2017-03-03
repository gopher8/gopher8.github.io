<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Blanche
 */

get_header(); ?>

<div id="wrapper">
  <div id="contentwrapper" class="animated fadeIn">
    <h1 class="entry-title">
      <?php esc_html_e( 'Oops! That page can&rsquo;t be found', 'blanche-lite' ); ?>
    </h1>
    <div id="content">
      <?php get_search_form(); ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>
