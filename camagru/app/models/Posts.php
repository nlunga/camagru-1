<?php

class Posts extends Model {

	public function __construct() {
		$table = 'posts';
		parent::__construct($table);
	}

	public function uploadImage($img, $user_id) {
		$fields = ['img' => $img, 'user_id' => $user_id];
		$this->insert($fields);
	}

	public function getPosts(){
		return $this->getData();
	}

	public function getUserPosts($user) {
		return $this->getData($user);
	}

	public function findPost($p) {
		$fields = ['conditions' => 'post_id = ?', 'bind'=>[$p]];
		return $this->findFirst($fields);
	}

	public function delPost($post_id, $user_id) {
		$fields = ['post_id' => $post_id, 'user_id' => $user_id];
		$this->query("DELETE FROM posts WHERE post_id = {$post_id} AND `user_id` = {$user_id}");
	}

	public function totPosts() {
		return count($this->find(['order' => 'creation_date DESC']));
	}

}
