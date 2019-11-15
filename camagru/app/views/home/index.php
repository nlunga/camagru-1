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

<?php $result = $_SESSION['posts']?>
<?php $comments = $_SESSION['comments']?>
<?php $users = $_SESSION['users']?>


<div class="container row">
<?php
				$x = 0;
				if (!empty($result))
					for ($i = 0; $i < $this->postsOD; $i++): ?>
            <div class="col-xs-6 col-md-4">
      
            <a href="<?=PROOT."post?p=".$result[$i]->post_id?>" class="thumbnail"> 
              <img src="<?=PROOT."imgs/". ($result[$i]->img)?>" alt="">
            </a>
      
    </div>
  <?php $x++; endfor;?>
  <input type="hidden" value="<?=$x?>" id="post_count"/>
</div>

<script src="<?=PROOT?>/js/scroll.js"></script>

<!-- <?//= inputBlock('text', 'Favourite Color', 'favourite_color', 'red', ['class'=>'form-control'], ['class'=>'form-group']); ?>
<?//= submitBlock("Save", ['class' => 'btn btn-primary'], ['class'=>'text-right']); ?> -->

<?php $this->end(); ?>

