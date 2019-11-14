<?php $this->setSiteTitle(MENU_BRAND.' | Post'); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Post</h1>
</div>

<?php $result = $_SESSION['posts']?>
<?php $comments = $_SESSION['comments']?>
<?php $users = $_SESSION['users']?>
<?php $post = $_SESSION['post_id']?>

<div class="col-md-4 col-md-offset-4 well">

  <div class="thumbnail">
    <img  src="<?=PROOT.'/imgs/'. ($post->img)?>" alt="" >
  </div>

  <div class="panel panel-default" style="padding: 20px">

    <p><span class="glyphicon glyphicon-heart"> </span>
      <?php if(currentUser()) :?>
        <form action="" method="post">
          <input type="hidden" id="postid" name="postid" value="<?=($post->post_id)?>">
          <input class="btn btn-danger btn-xs" type="submit" name="likebtn" id="likebtn" value="Like">
        </form>
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
          <input type="hidden" id="postid" name="postid" value="<?=($post->post_id)?>">
        </div>
        <div class="form-group text-center">
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add">
        </div>
      </form>
  <?php endif;?>

  </div>

</div>

<script src="<?=PROOT?>/js/likes.js"></script>


<?php $this->end(); ?>
