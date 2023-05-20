<?php
/**
 * Set ninja forms processing callback function to insert new event
 */

function new_event_form_callback( $form_data ) {

	$form_fields = array();
	foreach ( $form_data['fields'] as $field ) {
		$keys = array(
			'title',
			'description',
			'excerpt',
			'datetime',
			'location',
			'cost'
		);
		if ( in_array( $field['key'], $keys ) ) {
			$form_fields[ $field['key'] ] = $field['value'];
		}
	}

//	wp_insert_post( array(
//		'post_title'   => 'tester',
//		'post_content' => json_encode( $form_fields ),
//	), true );

	$descr_len = strlen( $form_fields['description'] );
	if ( ! empty( $form_fields['excerpt'] ) ) {
		$excerpt = $form_fields['excerpt'];
	} else if ( $descr_len < 250 ) {
		$excerpt = $form_fields['description'];
	} else {
		$excerpt = mb_substr( $form_fields['description'], 0, 250 ) . "... ";
	}

	$time      = event_form_build_time( $form_fields['datetime'] );
	$content   = event_form_build_content(
		$form_fields['description'],
		$form_fields['datetime']['date'],
		$time,
		$form_fields['location'],
		$form_fields['cost']
	);
	$post_date = event_form_build_date( $form_fields['datetime'] );
//	$new_event_post = array(
//		'post_title'   => 'got here',
//		'post_content' => 'content?',
//		'post_date'    => $post_date
//	);
	$new_event_post = array(
		'post_title'   => $form_fields['title'],
		'post_content' => $content,
		'post_date'    => $post_date,
		'post_excerpt' => $excerpt,
		'post_status'  => 'publish'
	);

	wp_insert_post( $new_event_post, true );
}

function event_form_build_content( $description, $date, $time, $location, $cost ) {
	return "Date: " . $date
	       . "Time: " . $time
	       . "Location: " . $location
	       . "Cost: " . $cost
	       . $description;
}

function event_form_build_date( $datetime ) {
	return $datetime['date'] . " " . $datetime['hour'] . ":" . $datetime['minute'] . ":" . "00";
}

function event_form_build_time( $datetime ) {
	return $datetime['hour']
	       . ":"
	       . $datetime['minute']
	       . $datetime['ampm'];
}

add_action( 'new_event_form_hook', 'new_event_form_callback' );
