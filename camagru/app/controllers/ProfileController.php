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

	public function modpassAction() {
		$validation = new Validate();
		if($_POST) {
			//form validation
			$validation->check($_POST, [
				'username' => [
					'display' => "Username",
					'required' => true
				],
				'password' => [
					'display' => 'Password',
					'required' => true
				]
			]);
			if($validation->passed()) {
				$user = $this->UsersModel->findByUsername($_POST['username']);
				//dnd($user);
				if ($user && password_verify(Input::get('password'), $user->password)) {
					$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
					$user->login($remember);
					Router::redirect('');
				}
				else {
					$validation->addError(["There is an error with your username or password.", ""]);
				}
			}
		}

		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('register/login');
	}

}
?>
