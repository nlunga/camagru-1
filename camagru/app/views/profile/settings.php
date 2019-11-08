<?php $this->setSiteTitle(MENU_BRAND.' | Settings'); ?>

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

	<form action="<?=PROOT?>profile/changepass" method="post" class="form">
		<div class="center" style="margin: 20px 0;">
			<input type="submit" class="btn btn-primary btn-block" value="Change Password">
		</div>
	</form>
	<hr>

	<form action="#" method="get" class="form">	

		<h4 class="text-center" style="margin: 20px 0;">Email notifications</h4>
		
		<div class="text-center" >
			<div style="margin: 0 20px; display:inline;">
				<input type="radio" class="" name="mail" id="mailOn" value="on"> On
			</div>
			<div style="margin: 0 20px; display:inline;">
				<input type="radio" class="" name="mail" id="mainOff" value="off"> Off
			</div>
		</div>
		<div class="text-center" style="margin: 20px 0;">
			<input type="submit" class="btn btn-primary btn-large" value="Save">
		</div>

	</form>
</div>

<?php $this->end(); ?>

