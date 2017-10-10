<?php

/**
 * Get information about attachments.
 *
 * @package wp-cli
 */
class WPAttachA11y_Command extends \WP_CLI_Command {

	protected $obj_fields = array(
		'ID',
		'post_title',
		'post_name',
		'post_date',
		'post_status',
	);

	/**
	 * Get all the attachments on a given site with their alt text.
	 *
	 * ## OPTIONS
	 *
	 * [--fields=<fields>]
	 * : Limit the output to specific object fields.
	 *
	 * [--format=<format>]
	 * : Render output in a particular format.
	 * ---
	 * default: table
	 * options:
	 *   - table
	 *   - csv
	 *   - ids
	 *   - json
	 *   - count
	 *   - yaml
	 * ---
	 */
	public function list( $args, $assoc_args ) {
		$fields = $this->obj_fields;
		if ( isset( $assoc_args['fields'] ) ) {
			$fields = explode( ',', $assoc_args['fields'] );
		}
		$fields[] = '_wp_attachment_image_alt';

		$posts = get_posts(
			array(
				'numberposts' => -1,
				'post_type' => 'attachment',
			)
		);

		// Get the alt text for each image.
		foreach ( $posts as $post ) {
			$post->_wp_attachment_image_alt = get_post_meta( $post->ID, '_wp_attachment_image_alt', true );
		}

		$formatter = new \WP_CLI\Formatter( $assoc_args, $fields );
		$formatter->display_items( $posts );
	}
}

WP_CLI::add_command( 'attach11y', 'WPAttachA11y_Command' );
