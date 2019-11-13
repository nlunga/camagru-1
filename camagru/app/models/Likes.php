<?php

class Likes extends Model {

	public function __construct() {
		$table = 'likes';
		parent::__construct($table);
	}
}

?>
