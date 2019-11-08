<?php $this->setSiteTitle(MENU_BRAND.' | Home'); ?>

<?php //$this->start('head'); ?>
	<!-- <meta content="test" /> -->
<?php //$this->end(); ?>

<?php $this->start('body'); ?>

<!-- <h1 class="text-center text-muted"> Welcome to Modo MVC Framework</h1> -->

<div class="page-header text-center">
  <h1>Camagru<br>
  	<small>Welcome to your feed</small></h1>
</div>

<div class="container row">
  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="<?=PROOT?>app/imgs/placeholder.jpg" alt="Placeholder">
    </a>
  </div>

  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="<?=PROOT?>app/imgs/placeholder.jpg" alt="Placeholder">
    </a>
  </div>

  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="<?=PROOT?>app/imgs/placeholder.jpg" alt="Placeholder">
    </a>
  </div>

  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="<?=PROOT?>app/imgs/placeholder.jpg" alt="Placeholder">
    </a>
  </div>

  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="<?=PROOT?>app/imgs/placeholder.jpg" alt="Placeholder">
    </a>
  </div>

  <div class="col-xs-6 col-md-4">
    <a href="#" class="thumbnail">
      <img src="<?=PROOT?>app/imgs/placeholder.jpg" alt="Placeholder">
    </a>
  </div>

</div>



<!-- <?//= inputBlock('text', 'Favourite Color', 'favourite_color', 'red', ['class'=>'form-control'], ['class'=>'form-group']); ?>
<?//= submitBlock("Save", ['class' => 'btn btn-primary'], ['class'=>'text-right']); ?> -->

<?php $this->end(); ?>

