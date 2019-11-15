
<?php $this->setSiteTitle(MENU_BRAND.' | User') ?>
<?php $this->start('body'); ?>

<?php //$user = $_SESSION['browse']?>
<?php $u_posts = $this->data['posts'];?>
<?php $user = $this->data['user'];?>

<div class="page-header text-center">
  <h1><?=ucwords($user->fname)?><br>
  	<small>Profile</small></h1>
</div>

<?php //$u_posts = $_SESSION['u_posts']?>

	<div class="container row">
		<?php foreach ($u_posts as $post): ?>
			<div class="col-xs-6 col-md-4">
				<a href="<?=PROOT."post?p=".$post->post_id?>" class="thumbnail"> 
					<img src="<?=PROOT."/imgs/". ($post->img)?>" alt="">
				</a>
				<?php if(currentUser() && currentUser()->user_id == $post->user_id):?>
				<form action="" method="post" class="form">
					<div class="form-group text-center">
						<input type="hidden" id="postid" name="postid" value="<?=($post->post_id)?>">
						<input class="btn btn-default btn-sm btn-block"type="submit" id="delete" name="delete" value="Delete">
					</div>
				</form>
				<hr>
				<?php endif ?>
			</div>
		<?php endforeach ?>
			
	</div>
<?php $this->end(); ?>
