<?php

function up_save_cuisine_meta($termID) {
	if(!isset($_POST['up_more_info_url'])) {
		return;
	}

	// if the meta data does not already exist for a term
	// this function will also add it.
	update_term_meta( $termID, 'more_info_url', sanitize_url($_POST['up_more_info_url']));
}