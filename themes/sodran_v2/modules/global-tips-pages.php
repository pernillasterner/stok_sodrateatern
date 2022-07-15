<?php

  $tips = papi_get_option('tips_page');

  foreach($tips as $tip){

    include(locate_template('modules/card-page.php'));

  }
?>
