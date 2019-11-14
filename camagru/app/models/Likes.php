<?php

class Likes extends Model {

	public function __construct() {
		$table = 'likes';
		parent::__construct($table);
	}

	public function findByLike($post_id, $user_id) {
		return $this->find(['conditions' => 'post_id = ? AND `user_id` = ?', 'bind' => [$post_id, $user_id]]);
		// $fields = ['conditions' => "user_id = ? AND post_id = ?", 'bind' => [$user_id, $post_id]];
		// $result = $this->findFirst($fields);
		// if ($result) {
		// 	return true;
		// }
		// return false;
	}

	public function like($post_id, $user_id) {
		$fields = ['post_id' => $post_id, 'user_id' => $user_id];

		if ($this->findByLike($fields['post_id'], $fields['user_id'])) {
			$this->query("DELETE FROM likes WHERE post_id = {$fields['post_id']} AND `user_id` = {$fields['user_id']}");
		} else {
			$this->assign($fields);
			$this->save($fields);
		}
	}
}

?>
