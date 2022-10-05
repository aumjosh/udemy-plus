<?php

function up_header_tools_render_cb($atts) {

    // wp_get_current_user will authenticate the user and return the user object
    // if auth passes
    $user = wp_get_current_user();
    // display user_login if user exists, otherwise prompt to sign in 
    $name = $user->exists() ? $user->user_login : 'Sign in';
    // we want to remove the open-modal class if the user is logged in
    $openClass = $user->exists() ? '' : 'open-modal';

    ob_start();

    ?>


    <div class="wp-block-udemy-plus-header-tools">
    <?php 
    if($atts['showAuth']) { ?>
        <a class="signin-link <?php echo $openClass; ?>" href="#">
            <div class="signin-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="signin-text">
                <small>Hello, <?php echo $name; ?></small>
                My Account
            </div>
        </a>
    <?php
    }
    ?>
    </div>

    <?php

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
   
}