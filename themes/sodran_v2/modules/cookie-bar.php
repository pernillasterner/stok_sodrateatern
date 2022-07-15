<?php $btn_txt = papi_get_option('cookie_btn'); ?>
<?php if(!empty($btn_txt)) : ?>

  <div id="cookies" class="cookies">
    <div class="cookies__wrapper table--sbp">
      <div class="cookies__content cell--sbp">
        <?php 
          $content = papi_get_option('cookie_content');
          echo apply_filters('the_content', $content);
        ?>       
      </div>
      <div class="cookies__content cell--sbp">
        <button id="approve-cookies" class="btn btn--small"><?php echo $btn_txt; ?></button>
      </div>
    </div>
  </div>

<?php endif; ?>



