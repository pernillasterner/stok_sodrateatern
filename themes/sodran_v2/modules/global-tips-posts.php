<?php

  $tips = papi_get_option('tips_post');

  foreach($tips as $tip){

    global $post;

    // Assign your post details to $post (& not any other variable name!!!!)
    $post = $tip;
    setup_postdata( $post );

    include(locate_template('modules/box-highlight.php'));

    wp_reset_postdata();

  }
?>
