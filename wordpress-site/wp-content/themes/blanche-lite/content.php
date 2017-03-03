<?php
/**
 * The template for displaying posts on index view
 *
 * @package Blanche
 */
?>

<div <?php post_class(); ?>>
  <div class="entry">
    <h2 class="entry-title" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink(); ?>" rel="bookmark">
      <?php the_title(); ?>
      </a> </h2>
    <div class="postcat"><span><?php echo get_the_date(); ?></span>
      <?php the_category( ', ' ); ?>
    </div>
    <?php the_post_thumbnail('blanche-blogthumb'); ?>
    <?php the_excerpt(); ?>
  </div>
</div>
