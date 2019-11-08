
<?php $this->setSiteTitle(MENU_BRAND.' | '.ucwords(currentUser()->fname)); ?>
<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Your profile</small></h1>
</div>

<?php $this->end(); ?>
