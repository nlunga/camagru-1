<?php $this->setSiteTitle('Settings'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Settings</small></h1>
</div>

<div class="col-md-4 col-md-offset-4 well">
	<form action="<?=PROOT?>profile/moduser" method="post" class="form">
		<div class="center" style="margin: 20px 0;">
			<input type="submit" class="btn btn-primary btn-block" value="Change Username">
		</div>
	</form>

	<form action="<?=PROOT?>profile/modemail" method="post" class="form">
		<div class="center" style="margin: 20px 0;">
			<input type="submit" class="btn btn-primary btn-block" value="Change Email">
		</div>
	</form>

	<form action="<?=PROOT?>profile/modpass" method="post" class="form">
		<div class="center" style="margin: 20px 0;">
			<input type="submit" class="btn btn-primary btn-block" value="Change Password">
		</div>
	</form>
</div>

<?php $this->end(); ?>

