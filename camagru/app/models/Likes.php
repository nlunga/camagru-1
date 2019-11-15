<?php

class Likes extends Model {

	public function __construct() {
		$table = 'likes';
		parent::__construct($table);
	}


	public function like($post_id, $user_id) {
		$result = $this->findFirst(['conditions' => 'post_id = ? AND `user_id` = ?', 'bind' => [$post_id, $user_id]]);
		$fields = ['post_id' => $post_id, 'user_id' => $user_id];
		
		if ($result->user_id == $user_id) {
			$this->query("DELETE FROM likes WHERE post_id = {$fields['post_id']} AND `user_id` = {$fields['user_id']}");
		}
		else {
			$this->insert($fields);
		}

	}

	public function countLikes($post_id) {
		return count($this->find(['conditions' => 'post_id = ?', 'bind' => [$post_id]]));
	}
}

?>
