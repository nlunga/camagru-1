<?php $this->setSiteTitle(MENU_BRAND.' | Create'); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Lets create shit</small></h1>
</div>

<div class="col-md-4 col-md-offset-4 well text-center">

<div id="photos" style="margin: 10px 0;">
		<canvas id="canvas"></canvas>

		<div class="center" style="margin: 10px 20px;">
			<button id="photo-save" class="btn btn-primary btn-block">
				Save
			</button>
		</div>
		
	</div>

</div>

<script src="<?=PROOT?>/js/upload.js"></script>

<?php $this->end(); ?>
