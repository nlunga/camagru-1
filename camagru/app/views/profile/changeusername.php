<?php $this->setSiteTitle(MENU_BRAND.' | Change Username'); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Settings</small></h1>
</div>


<div class="col-md-6 col-md-offset-3 well">
	<form class="form" action="" method="post">
	<div class="bg-danger"><?=$this->displayErrors ?></div>
		<h3 class="text-center">Change Username</h3>
		<div class="form-group" >
			<label for="username">New username</label>
			<input type="username" id="username" name="username" class="form-control" required="">
		</div>
		<div class="text-right">
			<input type="submit" value="Change Username" class="btn btn-large btn-primary">
		</div>
	</form>
</div>

<?php $this->end(); ?>
