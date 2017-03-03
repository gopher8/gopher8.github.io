<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package resortica-lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="resortica-page-image"><?php the_post_thumbnail( 'full' ); ?></div>
			  <?php
			  	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) {
			  		the_content();
			  	}

			  	else {
				  	$image_url = get_post_gallery_images($post);
				    	if(!empty($image_url)): ?>
				            <div class="resortica-gallery-carousel owl-carousel">
				                <?php foreach( $image_url as $image ) { ?>
				                <div  style="background-image: url(<?php echo esc_url($image) ?>)">
				                </div>
				                <?php } ?>
				            </div>
				         <?php
				         echo strip_shortcodes(wpautop(get_the_content()));

					    else:
						the_content();
					    endif;
				}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'resortica-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'resortica-lite' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->