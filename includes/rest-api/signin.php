<?php

function up_rest_api_signin_handler($request) {
    $response = ['status' => 1];
    $params = $request->get_json_params(); 

    // if neither of the paramaters are set
    // or if we receive empty values
    // return the fail response
    if(!isset($params['user_login'], $params['password'])||
        empty($params['user_login']) ||
        empty($params['password'])        
        ) {
        return $response;
    }

    // authenticating the user
    // authenticating a user based on email is more reliable than by username
    $email = sanitize_email($params['user_login']);
    $password = sanitize_text_field($params['password']);

    // this will add a cookie to the user's browser
    // to indicate the user has been logged in
    // we did not use this for registration because 
    // this function does not work well for first time users
    // wp_signon returns the user object on succes,
    // otherwise it will return an error which we catch
    // with the is_wp_error() function below
    $user = wp_signon([
        'user_login' => $email,
        'user_password' => $password,
        'remember' => true
    ]);

    if(is_wp_error($user)) {
        return $response;
    }

    $response['status'] = 2;
    return $response;
}
