<?php $this->setSiteTitle(MENU_BRAND.' | Change Password'); ?>
<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="col-md-6 col-md-offset-3 well">
	<form class="form" action="" method="post">
	<div class="bg-danger"><?=$this->displayErrors ?></div>
		<h3 class="text-center">Change Password</h3>
		<div class="form-group" >
			<label for="oldpass">Old Password</label>
			<input type="password" id="oldpass" name="oldpass" class="form-control" required="">
		</div>
		<div class="form-group" >
			<label for="password">New Password</label>
			<input type="password" id="password" name="password" class="form-control" required="">
		</div>
		<div class="form-group" >
			<label for="confirm">Confirm Password</label>
			<input type="password" id="confirm" name="confirm" class="form-control" required="">
		</div>

		<div class="text-right">
			<input type="submit" value="Change Password" class="btn btn-large btn-primary">
		</div>
	</form>
</div>

<?php $this->end(); ?>
