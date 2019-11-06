<?php

class Posts extends Model {

	public function __construct() {
		$table = 'posts';
		parent::__construct($table);
	}

}
