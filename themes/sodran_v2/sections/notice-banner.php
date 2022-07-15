<?php if( !empty($section['notice_txt']) ) : ?>
 
   <section id="<?= $secitonId ?>" class="scroll-to">

  	<?php if( !empty($section['notice_url']) ) : ?>

    	<a href="<?= $section['notice_url'] ?>" class="scroll-to__btn js-scroll-to">
				<span class="scroll-to__txt"><?= $section['notice_txt'] ?></span>
			</a>

  	<?php else: ?>

			<span class="scroll-to__txt"><?= $section['notice_txt'] ?></span>

  	<?php endif; ?>

	</section>

<?php endif; ?>
