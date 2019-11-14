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
  <?php foreach ($result as $res): ?>
    <div class="col-xs-6 col-md-4">
      
      <a href="<?=PROOT."post?p=".$res->post_id?>" class="thumbnail"> 
        <img src="<?=PROOT."/imgs/". ($res->img)?>" alt="">
      </a>

      <div class="panel">

      <p><span class="glyphicon glyphicon-heart"> How many?</span>
      
      <?php if(currentUser()) :?>
          <button type="button" id="likebtn" class="btn btn-default btn-sm" onclick="like()">
            <span class=""></span> Like
          </button>
          <?php endif;?>
      </p> 

          <h4 class=""><small>Comments</small></h4>

        <?php foreach ($comments as $comm): ?>
          <?php if($comm->post_id == $res->post_id):?>
            <div>
              <?php foreach ($_SESSION['users'] as $user):?>
                  <?php if ($comm->user_id == $user->user_id):?>
										<a href="#"><?=$user->username?></a>
									<?php endif;?>

                <?php endforeach;?>

                <?php if(currentUser() && currentUser()->user_id == $comm->user_id) :?>
                <form action="" method="post">
                  <input type="hidden" id="commid" name="commid" value="<?=($comm->comment_id)?>">
                  <input type="submit" id="delcomm" name="delcomm" class="btn btn-primary btn-xs pull-right" value="Delete">
                </form>
                <?php endif;?>
              <p class="comments"><?=htmlspecialchars($comm->comment)?></p>
              

            </div>
          <?php endif;?>
        <?php endforeach;?>

        <?php if(currentUser()) :?>
            <form action="" method="post">
              <div class="form-group">
                <label for="addcomm">Add Comment</label> 
                <input type="text" id="addcomm" name="addcomm" class="form-control" value="">
                <input type="hidden" id="postid" name="postid" value="<?=($res->post_id)?>">
              </div>
              <div class="form-group text-center">
                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add">
              </div>
            </form>
        <?php endif;?>

      </div>

    </div>
  <?php endforeach;?>
</div>



<!-- <?//= inputBlock('text', 'Favourite Color', 'favourite_color', 'red', ['class'=>'form-control'], ['class'=>'form-group']); ?>
<?//= submitBlock("Save", ['class' => 'btn btn-primary'], ['class'=>'text-right']); ?> -->

<?php $this->end(); ?>

