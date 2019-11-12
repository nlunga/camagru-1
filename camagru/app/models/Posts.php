<?php

class Posts extends Model {

	public function __construct() {
		$table = 'posts';
		parent::__construct($table);
	}

	public function uploadImage($img, $username) {
		$fields = ['img' => $img, 'username' => $username];
		$this->insert($fields);
	}

	public function getPosts(){
		return $this->getData();
	}

	public function getUserPosts($user) {
		return $this->getData($user);
	}

}
