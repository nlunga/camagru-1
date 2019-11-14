<?php $this->setSiteTitle(MENU_BRAND.' | Post'); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Post</h1>
</div>

<?php $result = $_SESSION['posts']?>
<?php $comments = $_SESSION['comments']?>
<?php $users = $_SESSION['users']?>
<?php $post = $_SESSION['post_id']?>

<div class="col-md-6 col-md-offset-3 well">

  <div class="thumbnail">
    <img  src="<?=PROOT.'/imgs/'. ($post->img)?>" alt="" >
  </div>

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
      <?php if($comm->post_id == $post->post_id):?>
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




<?php $this->end(); ?>
