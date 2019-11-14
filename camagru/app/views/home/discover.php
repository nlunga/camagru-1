<?php $this->setSiteTitle(MENU_BRAND.' | Discover'); ?>

<?php $this->start('body'); ?>

<div class="page-header text-center">
  <h1>Discover</h1>
</div>

<?php $result = $_SESSION['posts']?>
<?php $comments = $_SESSION['comments']?>
<?php $users = $_SESSION['users']?>


<div class="container row">
  <?php foreach ($users as $u): ?>
    <div class="col-xs-6 col-md-4 text-center">
      <a href="#" class="thumbnail"> 
        <p class="btn btn-large"><?=$u->username?></p> <br>
      </a>
    </div>
  <?php endforeach;?>


</div>


<?php $this->end(); ?>
