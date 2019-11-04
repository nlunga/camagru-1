<?php

class SettingsController extends Controller {
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
	}

	public function indexAction() {
		// $db = DB::getInstance();
		//dnd($_SESSION);
		
		$this->view->render('settings/index');
	}
}
?>
