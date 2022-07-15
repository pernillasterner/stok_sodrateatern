
<?php if( !empty($section['persons']) ) : ?>

	<section id="<?= $secitonId ?>" class="section bg--lightest">
		<div class="entry__wrapper">
			<?php foreach($section['persons'] as $item ) : ?>
				<div class="contact-person">
					<?php if( !empty($item['person_img']) ) : ?>
						<div class="contact-person__img">
							<img src="<?= $item['person_img']->sizes['thumbnail']['url']; ?>" alt="<?= $item['person_img']->alt; ?>">
						</div>
					<?php endif; ?>
					<div class="contact-person__editor">
						<?php echo apply_filters('the_content', $item['person_content']); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</section>

<?php endif; ?>