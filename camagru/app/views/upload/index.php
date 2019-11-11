<?php $this->setSiteTitle(MENU_BRAND.' | Create'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>


<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Lets create shit</small></h1>
</div>

<div class="col-md-6 col-md-offset-3 well text-center">
	<div>
		<video class="thumbnail" id="video">Stream not available.</video>
		<button id="photo-button" class="btn btn-primary btn-large form-group" style="display: block; margin: 10px auto; width: 350px;">
		Snap
		</button>
		<div class="text-center"  >
			<div style="margin: 0 20px; display:inline;">
				<button id="photo-button" class="btn btn-primary btn-large form-group" onclick="vidOn()" style="margin: 0 auto;">
					Audio On
				</button>
			</div>
			<div style="margin: 0 20px; display:inline;">
				<button id="photo-button" class="btn btn-primary btn-large form-group" onclick="vidOff()" style=" margin: 0 auto; ">
					Audio Off
				</button>
			</div>
		</div>
		<select class="select" id="photo-filter" style="display: block; margin: 10px auto; width: 350px;">
			<option value="none">Normal</option>
			<option value="grayscale(100%)">Grayscale</option>
			<option value="sepia(100%)">Sepia</option>
			<option value="invert(100%)">Invert</option>
			<option value="hue-rotate(90deg)">Hue</option>
			<option value="blur(10px)">Blur</option>
			<option value="contrast(200%)">Contrast</option>

		</select>
		<button id="clear-button" class="btn btn-primary btn-large text-center" style="display: block; margin: 10px auto; width: 350px;">Clear</button>
		
	</div>

	<div id="photos" style="margin: 10px 0;">
		<canvas id="canvas"></canvas>
	</div>
</div>

<script src="<?=PROOT?>/js/upload.js"></script>

<?php $this->end(); ?>
