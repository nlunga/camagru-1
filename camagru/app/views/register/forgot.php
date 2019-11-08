<?php $this->setSiteTitle(MENU_BRAND.' | Forgot Password'); ?>
<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Oh noes<br>
  	<small>Forgot your password?</small></h1>
</div>

<div class="col-md-6 col-md-offset-3 well">
	<form class="form" action="" method="post">
	<div class="bg-danger"><?=$this->displayErrors ?></div>
		<h3 class="text-center">Reset Password</h3>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" class="form-control" value="<?=$this->post['email']?>" required="">
		</div>
		<div class="text-right">
			<input type="submit" value="Reset Password" class="btn btn-large btn-primary">
		</div>
	</form>
</div>

<?php $this->end(); ?>
