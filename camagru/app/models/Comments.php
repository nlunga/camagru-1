<?php

class Comments extends Model {

	public function __construct() {
		$table = 'comments';
		parent::__construct($table);
	}

	public function getComments(){
		return $this->getData();
	}

	public function uploadComment($post_id, $user_id, $comment) {
		$fields = ['post_id' => $post_id, 'user_id' => $user_id, 'comment' => $comment];
		$this->insert($fields);
	}

}

?>
