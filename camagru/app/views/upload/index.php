<?php $this->setSiteTitle(MENU_BRAND.' | Create'); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Sup <?=ucwords(currentUser()->fname)?><br>
  	<small>Lets create shit</small></h1>
</div>

<div class="col-md-6 col-md-offset-3 well text-center">

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

	<h1>
  	<small>Preview</small></h1>

 <hr>

	<div class="center" style="margin: 10px auto;">

		<div class="" style="margin: 10px auto; position: relative; height:375px; width: 500px;">
			<canvas id="canvas" style="position: absolute; top: 0; left: 0; width: 100% ;"></canvas>
			<canvas id="sticker" style="position: absolute; top: 0; left: 0; width: 100% ;"></canvas>
		</div>

		<div id="stickers" class='btn-group' style="overflow-x: auto;">

		<?php
            if ($handle = opendir('imgs/stickers')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        echo "<div style='display: inline-block;' class='btn btn-block' onclick='addSticker(\"$entry\")'><figure class=''><img  height='30px' class='' src='".PROOT."imgs/stickers/".$entry."'></figure></div>";
                    }
                }
                closedir($handle);
            }
        ?>

		</div>

		<div>
			<button id="photo-save" class="btn btn-primary btn-block">
				Save
			</button>
		</div>
		<div class="custom-file" style="margin: 10px auto;">
			<input type="file" id="upload" value="upload" class="btn btn-primary btn-block"/>
		</div>

		<!-- <div id="photos" style="margin: 10px 0;">
		</div> -->
	</div>
</div>

<script src="<?=PROOT?>/js/upload.js"></script>

<?php $this->end(); ?>
