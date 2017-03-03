<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wpdb;
$gallery_wp_nonce                 = wp_create_nonce( 'huge_it_gallery_nonce' );
$photo_gallery_wp_nonce_add_galery = wp_create_nonce( 'photo_gallery_wp_nonce_add_galery' );
$huge_it_gallery_nonce_remove_galery = wp_create_nonce( 'huge_it_gallery_nonce_remove_galery' );
?>
<div class="wrap">
	<?php $path_site = plugins_url( "../images", __FILE__ ); ?>
	<div style="clear: both;"></div>
	<div id="poststuff">
		<div id="ph-gallery-wp-gallerys-list-page">
			<h2>Huge-IT <?php echo __( 'Galleries', 'photo-gallery-wp' ); ?>
				<a onclick="window.location.href='admin.php?page=photo_gallery_wp_gallery&task=add_cat&photo_gallery_wp_nonce_add_galery=<?php echo $photo_gallery_wp_nonce_add_galery; ?>'"
				   class="add-new-h2"><?php echo __( 'Add New Gallery', 'photo-gallery-wp' ); ?></a>
			</h2>
			<div class="photo_gallery_wp_search_pagination_banner">
				<form name="photo_gallery_wp_search_gallery" action="admin.php" method="GET">
					<div class="photo_gallery_wp_search" style="vertical-align: middle; display: inline-block">
						<input type="hidden" name="page" value="photo_gallery_wp_gallery">
						<label style="vertical-align: top;" for="search_input">Search: </label>
						<?php if(isset($_GET['search_keyword']) && $_GET['search_keyword'] != ""): ?>
							<input id="search_input" type="text" name="search_keyword" value="<?php echo $_GET['search_keyword'] ?>">
						<?php else: ?>
							<input id="search_input" type="text" name="search_keyword">
						<?php endif; ?>

						<button style="vertical-align: middle;" class="add-new-h2" type="submit">Search</button>
						<a style="display: inline-block; vertical-align: middle;" class="add-new-h2" href="admin.php?page=photo_gallery_wp_gallery">Reset</a>
					</div>
					<?php if($pagination['enable']): ?>
						<div class="tablenav" style="display: inline">
							<div class="tablenav-pages">
								<span class="displaying-num"><?php echo $pagination['pagination_links_count'] ?> items</span>
								<span class="pagination-links">
										<?php if($pagination['current'] > 2): ?>
											<a class="next-page" href="<?php echo $pagination['links'].'&paged=1'; ?>">
												<span class="screen-reader-text">First page</span>
												<span>«</span>
											</a>
										<?php else: ?>
											<span class="tablenav-pages-navspan" >«</span>
										<?php endif; ?>
									<?php if($pagination['current'] > 1): ?>
										<a class="next-page" href="<?php echo $pagination['links'].'&paged='.($pagination['current'] - 1); ?>">
												<span class="screen-reader-text">Prev page</span>
												<span>‹</span>
											</a>
									<?php else: ?>
										<span class="tablenav-pages-navspan" >‹</span>
									<?php endif; ?>
									<span class="paging-input">
											<label for="current-page-selector" class="screen-reader-text">Current Page</label>
											<input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo $pagination['current'] ?>" size="1">
											<span class="tablenav-paging-text"> of
												<span class="total-pages"><?php echo $pagination['pagination_links_count'] ?></span>
											</span>
										</span>
									<?php if($pagination['pagination_links_count'] - $pagination['current'] >= 1): ?>
										<a class="next-page" href="<?php echo $pagination['links'].'&paged='.($pagination['current'] + 1); ?>">
											<span class="screen-reader-text">Next page</span>
											<span >›</span>
										</a>
									<?php else: ?>
										<span class="tablenav-pages-navspan" >›</span>
									<?php endif; ?>
									<?php if($pagination['pagination_links_count'] - $pagination['current'] >= 2): ?>
										<a class="next-page" href="<?php echo $pagination['links'].'&paged='.$pagination['pagination_links_count']; ?>">
											<span class="screen-reader-text">Last page</span>
											<span >»</span>
										</a>
									<?php else: ?>
										<span class="tablenav-pages-navspan" >»</span>
									<?php endif; ?>
									</span>
							</div>
						</div>
					<?php endif; ?>
				</form>
			</div>
			<table class="wp-list-table widefat fixed pages" style="width:95%">
				<thead>
				<tr>
					<th scope="col" id="id" style="width:30px">
						<span><?php echo __( 'ID', 'photo-gallery-wp' ); ?></span><span
							class="sorting-indicator"></span></th>
					<th scope="col" id="name" style="width:85px">
						<span><?php echo __( 'Name', 'photo-gallery-wp' ); ?></span><span
							class="sorting-indicator"></span></th>
					<th scope="col" id="prod_count" style="width:40px;">
						<span><?php echo __( 'Images', 'photo-gallery-wp' ); ?></span><span
							class="sorting-indicator"></span></th>
					<th style="width:40px"><span><?php echo __('Duplicate', 'gallery-images' ); ?></span><span
							class="sorting-indicator"></span></th>
					<th style="width:40px"><span><?php echo __( 'Delete', 'gallery-images' ); ?></span><span
							class="sorting-indicator"></span></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($galleries as $k => $item): ?>
					<tr <?php if($k % 2 == 0) { echo "class='has-background'"; }?>>
						<td><?= $k + 1 ?></td>
						<td>
							<a href="admin.php?page=photo_gallery_wp_gallery&task=edit_cat&id=<?= $item->id ?>&huge_it_gallery_nonce=<?= wp_create_nonce('huge_it_gallery_nonce') ?>"><?= esc_html( stripslashes( $item->name ) ); ?></a>
						</td>
						<td> (<?= $item->images_count ?>) </td>
						<td>
							<a href="admin.php?page=photo_gallery_wp_gallery&task=duplicate_photo_gallery_wp_image&id=<?= $item->id ?>&photo_gallery_wp_duplicate_nonce=<?= wp_create_nonce('photo_gallery_wp_nonce_duplicate_gallery'.$item->id) ?>" class="ph-gallery-wp-duplicate-link">
								<span class="ph-gallery-wp-duplicate-icon"></span>
							</a>
						</td>
						<td>
							<a href="admin.php?page=photo_gallery_wp_gallery&task=remove_photo_gallery_wp&id=<?= $item->id ?>&photo_gallery_wp_nonce_remove_gallery=<?= wp_create_nonce('photo_gallery_wp_nonce_remove_gallery'.$item->id)?>" class="ph-gallery-wp-delete-link" ><span class="ph-gallery-wp-delete-icon"></span></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>