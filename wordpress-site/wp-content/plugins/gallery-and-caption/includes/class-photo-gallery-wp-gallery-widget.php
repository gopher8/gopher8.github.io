<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Class Photo_Gallery_WP_Widget
 */
class Photo_Gallery_WP_Widget extends WP_Widget {

	/**
	 * Photo_Gallery_WP_Widget constructor.
	 */
	public function __construct() {
		parent::__construct(
			'Photo_Gallery_WP_Widget',
			'Photo Gallery WP',
			array( 'description' => __( 'Photo Gallery WP', 'Photo Gallery WP' ), )
		);
	}

	/**
	 * Print out the Widget by calling shortcode
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( isset( $instance['gallery_id'] ) ) {
			$gallery_id = $instance['gallery_id'];

			$title = apply_filters( 'widget_title', $instance['title'] );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title .$args['after_title'];
			}

			echo do_shortcode( "[photo_gallery_wp id={$gallery_id}]" );
			echo $args['after_widget'];
		}
	}

	/**
	 * Update options
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['gallery_id'] = strip_tags( $new_instance['gallery_id'] );
		$instance['title']        = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Print out the widget's form HTML
	 * @param array $instance
	 */
	public function form( $instance ) {
		$selected_gallery = 0;
		$title              = "";
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		if (isset($instance['gallery_id'])) {
			$selected_gallery = $instance['gallery_id'];
		}

		?>
		<p>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				       value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<label
				for="<?php echo $this->get_field_id( 'gallery_id' ); ?>"><?php _e( 'Select gallery:', 'photo-gallery-wp' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'gallery_id' ); ?>"
			        name="<?php echo $this->get_field_name( 'gallery_id' ); ?>">
				<?php
				global $wpdb;
				$query     = "SELECT * FROM " . $wpdb->prefix . "photo_gallery_wp_gallerys ";
				$rowwidget = $wpdb->get_results( $query );
				foreach ( $rowwidget as $rowwidgetecho ) { ?>
					<option <?php selected( $selected_gallery, $rowwidgetecho->id, true); ?> value="<?php echo $rowwidgetecho->id; ?>"><?php echo $rowwidgetecho->name; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
	}
}