<?php

class LikeController extends Controller {

	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this->view->setLayout('default');
		$this->load_model('Users');
		$this->load_model('Posts');
		$this->load_model('Comments');
		$this->load_model('Likes');
	}

	// public function likeAction($params) {
	// 	$arr = array('post_id' => $params, 'user_id' => currentUser()->user_id);
	// 	$this->LikesModel->like($arr);
	// 	Router::redirect('');
	// }

}
?>
