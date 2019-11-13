<?php

class Comments extends Model {

	public function __construct() {
		$table = 'comments';
		parent::__construct($table);
	}

	public function getComments(){
		return $this->getData();
	}
}

?>
