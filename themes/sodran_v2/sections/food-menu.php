<?php
  $menu_heading = $section['menu_heading'];
  $menu = $section['menu'];
?>

<?php if(!empty($menu)) : ?>

	<section id="<?= $secitonId ?>" class="section bg--lightest">
		<div class="entry__wrapper">
			<?php if(!empty($menu_heading)) : ?>
				<h2 class="title"><?= $menu_heading; ?></h2>
			<?php endif; ?>

			<?php 
				$outputString = "";

		    foreach ($menu as $menu_item) {
		      $outputString .=  '<p>';
		      if(!empty($menu_item['title'])){
		        $outputString .= '<strong class="txt-uc">' . $menu_item['title'] . '</strong><br/>';
		      }
		      if(!empty($menu_item['text'])){
		        $outputString .= $menu_item['text'] . '<br/>';
		      }
		      if(!empty($menu_item['text'])){
		        $outputString .= '<span class="txt-subtle">' . $menu_item['text_sub'] . '</span>';
		      }
		      $outputString .=  '</p>';
		    }
		    echo $outputString;
		   ?>
		</div>
	</section>

<?php endif; ?>
