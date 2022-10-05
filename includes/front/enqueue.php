<?php

function up_enqueue_scripts() {
    // here we defined the custom url using rest_url()
    // eventually there will be more URL's
    // json_encode to send to javascript
    $authURLs = json_encode([
        'signup' => esc_url_raw(rest_url('up/v1/signup')),
        'signin' => esc_url_raw(rest_url('up/v1/signin'))
    ]);

    // define the global variable up_auth_rest
    // which has as its value the rest URL
    wp_add_inline_script(
        // the handle we gave to frontend.js in includes/enqueue.php
        'auth-modal-frontend', 
        // wp will add the script tags
        "const up_auth_rest = ${authURLs}", 
        // add the script before the handle so we have access to the variables
        'before' 
    );
}