<?php

class Likes extends Model {

	public function __construct() {
		$table = 'likes';
		parent::__construct($table);
	}

	

	public function like($params = []) {
		if ($this->findByLike($params['post_id'], $params['user_id'])) {
			$this->query("DELETE FROM likes WHERE post_id = {$params['post_id']} AND user_id = {$params['user_id']}");
		} else {
			$this->assign($params);
			$this->save($params);
		}
}
}

?>
