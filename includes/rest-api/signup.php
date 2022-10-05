<?php

function up_rest_api_signup_handler($request) {
    $response = ['status' => 1];
    $params = $request->get_json_params();

    // if neither of the paramaters are set
    // or if we receive empty values
    // return the fail response
    if(!isset($params['email'], $params['username'], $params['password'])||
        empty($params['email']) ||
        empty($params['username']) ||
        empty($params['password'])        
        ) {
        return $response;
    }

    $email = sanitize_email( $params['email'] );
    $username = sanitize_text_field( $params['username'] );
    $password = sanitize_text_field( $params['password'] );

    if(
        username_exists($username) ||  // wp function to check if username already exists
        !is_email($email) || // wp function to check if email is a valid email address
        email_exists($email) // wp function to check if email already exists

    ) {
        return $response;
    }

    $userID = wp_insert_user([
        'user_login' => $username,
        'user_email' => $email,
        'user_pass' => $password
    ]);

    if(is_wp_error($userID)) {
        return $response;
    }

    wp_new_user_notification( $userID, null, 'user' ); // send notificattion email to user that their acct was created
    wp_set_current_user( $userID ); // log the new user in
    wp_set_auth_cookie( $userID ); // will log the user back into their account when they come back

    // get the user object to pass along with our do_action function
    // for notifying other plugins in case they need to perform an action
    // after a new user logs in
    $user = get_user_by('id', $userID );

    // call this fuction to allow other plugins to know a new user was logged in
    // from the user object, we pass in the username
    // and also pass the entire user object so other plugins can use what they need
    // this allows plugins to extend our custom user registration
    do_action('wp_login', $user->user_login, $user);

    $response['status'] = 2;
    return $response;
}
