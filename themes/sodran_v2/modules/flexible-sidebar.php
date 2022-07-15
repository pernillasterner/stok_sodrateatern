<div class="sidebar__wrapper">
  <div class="sidebar__section sidebar__section--double sidebar__section--gradient hide--mbp-max">
    <div class="sidebar__section__wrapper sidebar__section__wrapper--padding scrollable--lbp">
      <?php if( !empty($asideSidebarContent['sidebar_title']) ) : ?>
        <h2 class="title title--small"><?= $asideSidebarContent['sidebar_title'] ?></h2>
      <?php endif; ?>

      <?php if( !empty($asideSidebarContent['sidebar_text']) ) : ?>
        <?= wpautop($asideSidebarContent['sidebar_text']); ?>
      <?php endif; ?>
    </div>
  </div>

  <?php if( !empty($asideSidebarContent['sidebar_btn']) ) : ?>
    <div class="sidebar__section sidebar__section--button hide--mbp-max table">
      <div class="sidebar__section__wrapper sidebar__section__wrapper--padding scrollable--lbp cell cell--bottom txt-c">
        <?= do_shortcode($asideSidebarContent['sidebar_btn']) ?>
      </div>
    </div>
  <?php endif; ?>
</div>