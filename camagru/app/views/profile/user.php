
<?php $this->setSiteTitle(MENU_BRAND.' | User') ?>
<?php $this->start('body'); ?>

<?php $u_posts = $this->data['posts'];?>
<?php $user = $this->data['user'];?>

<div class="page-header text-center">
  <h1><?=ucwords($user->fname)?><br>
  	<small>Profile</small></h1>
</div>

	<div class="container row">
		<?php if(empty($u_posts)) :?>
		<div class="container text-center">
				<h2><small>No posts ಠ_ಠ</small></h2>
				<img src="<?=PROOT?>/imgs/gif/nothing-burger.gif" alt="" class="img-responsive" allowFullScreen>
			</div>
		<?php endif; ?>
		<?php foreach ($u_posts as $post): ?>
			<div class="col-xs-6 col-md-4">
				<a href="<?=PROOT."post?p=".$post->post_id?>" class="thumbnail"> 
					<img src="<?=PROOT."/imgs/". ($post->img)?>" alt="">
				</a>
				
			</div>
		<?php endforeach ?>
			
	</div>
<?php $this->end(); ?>
