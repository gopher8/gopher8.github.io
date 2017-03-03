<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package resortica-lite
 */

get_header(); ?>
<div class="sec-content page-not-found">
	<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <header class="page-header">
                    <h2><?php echo __('4', 'resortica-lite'); ?><span><?php echo __('0', 'resortica-lite'); ?></span><?php echo __('4', 'resortica-lite'); ?></h2>
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'resortica-lite' ); ?></h1>
                </header><!-- .page-header -->

				<div class=" content-list">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'resortica-lite' ); ?></p>
				</div>
                <div class="not-found-search">
    				<?php
    					get_search_form();
    				?>
                </div>
			</div>
    	</div>
    </div>
</div>
<?php
get_footer();
