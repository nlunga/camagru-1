<?php $this->setSiteTitle(MENU_BRAND.' | Create'); ?>


<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Lets create shit</small></h1>
</div>

<div class="col-md-4 col-md-offset-4 well text-center">

	<video class="thumbnail" id="video">Stream not available.</video>

		<div class="center" style="margin: 10px 20px;">
			<button id="photo-button" class="btn btn-primary btn-block" >
				Snap
			</button>
		</div>

		<div class="btn-group">
				<button id="photo-button" class="btn btn-primary" onclick="vidOn()" >
					Audio On
				</button>
				<button id="photo-button" class="btn btn-primary" onclick="vidOff()" >
					Audio Off
				</button>

		</div>


	<div class="center" style="margin: 10px 20px;">
		<select class="select btn-block" id="photo-filter" >
			<option value="none">Normal</option>
			<option value="grayscale(100%)">Grayscale</option>
			<option value="sepia(100%)">Sepia</option>
			<option value="invert(100%)">Invert</option>
			<option value="hue-rotate(90deg)">Hue</option>
			<option value="blur(10px)">Blur</option>
			<option value="contrast(200%)">Contrast</option>
		</select>
	</div>



	<div class="center" style="margin: 10px 20px;">
		<button id="clear-button" class="btn btn-primary btn-block">Clear</button>	
	</div>

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
