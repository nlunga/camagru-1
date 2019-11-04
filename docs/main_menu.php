<?php
	$menu = Router::getMenu('menu_acl');
	$currentPage = currentPage();

?>

<nav  class="navbar is-light">
    <!-- Bootstrap - class="navbar navbar-default" -->
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

   
    <div class="navbar-brand">
      <a class="navbar-brand" href="<?=PROOT?>home"><?=MENU_BRAND?></a>
        <div class="navbar-burger burger" data-target="#main_menu">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      
      <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> -->
      
    </div>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-menu" id="main_menu">

      <div class="navbar-start">

      <ul>
		 <?php foreach($menu as $key => $val): 
			$active = ''; ?>
			<?php if(is_array($val)): ?>

			<li class="navbar-item">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$key?><span class="caret"></span></a>
					<ul class="dropdown-menu">

						<?php foreach($val as $k => $v): 
							$active = ($v == $currentPage) ? 'active' : ''; ?>
							<?php if($k == 'separator'): ?>
								<li role="separator" class="divider"></li>
							<?php else: ?>
								<li><a class="<?=$active?>" href="<?=$v?>" ><?=$k?></a></li>
							<?php endif; ?>

						<?php endforeach; ?>
					</ul>
       		</li>

		<?php else: 
			$active = ($val == $currentPage) ? 'active' : ''; ?>
				<li><a class="<?=$active?>" href="<?=$val?>" ><?=$key?></a></li>
		<?php endif; ?>
		<?php endforeach; ?>
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li> -->
       
      </ul>


      </div>


      <ul class="nav navbar-nav">
		 <?php foreach($menu as $key => $val): 
			$active = ''; ?>
			<?php if(is_array($val)): ?>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$key?><span class="caret"></span></a>
					<ul class="dropdown-menu">

						<?php foreach($val as $k => $v): 
							$active = ($v == $currentPage) ? 'active' : ''; ?>
							<?php if($k == 'separator'): ?>
								<li role="separator" class="divider"></li>
							<?php else: ?>
								<li><a class="<?=$active?>" href="<?=$v?>" ><?=$k?></a></li>
							<?php endif; ?>

						<?php endforeach; ?>
					</ul>
       		</li>

		<?php else: 
			$active = ($val == $currentPage) ? 'active' : ''; ?>
				<li><a class="<?=$active?>" href="<?=$val?>" ><?=$key?></a></li>
		<?php endif; ?>
		<?php endforeach; ?>
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li> -->
       
      </ul>
      <!-- <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        
		<?php if(currentUser()) :?>
			<li><a href="#">Hello <?=currentUser()->fname?> </a></li>
		<?php endif; ?>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
