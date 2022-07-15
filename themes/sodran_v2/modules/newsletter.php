<div class="quotation">
	<div class="quotation__wrapper js-popup-no-action">
		<h3 class="strong title"><?= papi_get_option('newsletter_title'); ?></h3>

		<form id="js-newsletter-subscribe" data-url="<?= papi_get_option('newsletter_url'); ?>">
			<p><?= papi_get_option('newsletter_txt'); ?></p>

			<p>
				<?php 
					$lists = papi_get_option('newsletter_lists');

					foreach($lists as $list) :
				?>

					<span class="wpcf7-form-control wpcf7-checkbox">
				    <span class="wpcf7-list-item">
				      <label>
				      	<input class="js-newsletter-list-id" type="checkbox" name="join[]" value="<?=$list['list_id']?>">
				      	<span class="wpcf7-list-item-label"><?=$list['list_name']?></span>
				      </label>
				    </span>
				  </span>
				  <br>
				<?php endforeach; ?>
				
				<br>
				<label><span class="visually-hidden">Ange e-postadress</span><input id="js-newsletter-subscribe-mail" name="email" type="text" placeholder="E-post"></label>
	  		<br><br>
	  		<button id="js-newsletter-subscribe-btn" class="btn btn--primary"><?=papi_get_option('newsletter_btn');?></button>

	  		
			</p>
		</form>

		<div id="js-newsletter-response" class="newsletter-output">
			<div class="newsletter-output-content is-success">
				<?= papi_get_option('newsletter_success'); ?>
			</div>
			<div id="js-newsletter-error" class="newsletter-output-content is-error"></div>
		</div>

	</div>
</div>	
