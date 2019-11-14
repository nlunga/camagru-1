<?php

class PostController extends Controller {
	
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this->view->setLayout('default');
		$this->load_model('Users');
		$this->load_model('Posts');
		$this->load_model('Comments');
		$this->load_model('Likes');
	}

	public function indexAction() {
		echo "hello world";
		$this->view->render('post/index');
	}

}
?>
