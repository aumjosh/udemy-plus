<?php

// our custom endpoint
function up_rest_api_init() {
    //example.com/wp-json/up/v1/signup
    register_rest_route('up/v1', '/signup', [
        // use of static properties in case WP updates their methods
        'methods' => WP_REST_Server::CREATABLE, // POST
        'callback' => 'up_rest_api_signup_handler', // function is in signup.php
        'permission_callback' => '__return_true'
    ]);

    register_rest_route('up/v1', '/signin', [
        'methods' => WP_REST_Server::EDITABLE, // POST, PUT, OR PATCH
        'callback' => 'up_rest_api_signin_handler', // function is in signin.php
        'permission_callback' => '__return_true'
    ]);

}