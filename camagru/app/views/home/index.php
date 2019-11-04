<?php //$this->setSiteTitle('Home'); ?>

<?php //$this->start('head'); ?>
	<!-- <meta content="test" /> -->
<?php //$this->end(); ?>

<?php $this->start('body'); ?>
<h1 class="text-center red">Welcome to Modo MVC Framework</h1>

<?= inputBlock('text', 'Favourite Color', 'favourite_color', 'red', ['class'=>'form-control'], ['class'=>'form-group']); ?>
<?= submitBlock("Save", ['class' => 'btn btn-primary'], ['class'=>'text-right']); ?>

<?php $this->end(); ?>
