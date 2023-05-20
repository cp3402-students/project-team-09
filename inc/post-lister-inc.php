<?php
function add_category_chooser() {
	global $post;
	if ( 'post-lister.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
		add_meta_box( 'category_chooser', 'Post list Template Category', "meta_box_callback", 'page', 'side' );
	}
}

add_action( 'add_meta_boxes', 'add_category_chooser' );

function meta_box_callback() {
	global $post;
	$field = 'chosen_category';
	?>
	<p>
		<?php $saved_chosen_category = get_post_meta( $post->ID, $field, true ) ?? null ?>
		<select name="<?php echo $field; ?>" id="post-list-category-select">
			<option value="" <?php echo $saved_chosen_category == null ? 'selected' : '' ?>>-- None</option>
			<?php
			foreach ( get_categories( array( 'hide_empty' => 0, 'type' => 'post' ) ) as $category ) {
				echo '<option value="' . $category->name . '" '
				     . ( isset( $saved_chosen_category ) && $saved_chosen_category == $category->name ? 'selected>' : '>' )
				     . $category->name
				     . '</option>';
			}
			?>
		</select>
	</p>
	<?php
}

function save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$field = 'chosen_category';
	if ( isset( $_POST[ $field ] ) ) {
		update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
	}
}

add_action( 'save_post', 'save_meta_box' );
