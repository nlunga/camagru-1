<?php

class ProfileController extends Controller {
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
	}

	public function indexAction() {
		$this->view->render('profile/index');
	}

	public function settingsAction() {
		$this->view->render('profile/settings');
	}

	public function uploadAction() {
		$this->view->render('profile/upload');
	}

}
?>
