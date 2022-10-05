<?php

// enqueue the backend script
// in src/blocks/auth-modal/blocks.json we register a viewScript
// however this script does not get enqueued because we also have a callback function
// so this function is the workaround
// this could have also been solved by changing the viewScript property to script
// the difference is that the script property will load on both front and backend of the site
// this solution is better but much more code
function udemy_plus_enqueue_if_block_is_present() {
 
    if ( has_block( 'udemy-plus/auth-modal' ) ) {
        wp_enqueue_script(
            'auth-modal-frontend',
            UP_PLUGINS_URL . 'build/blocks/auth-modal/frontend.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action( 'enqueue_block_assets', 'udemy_plus_enqueue_if_block_is_present' );