<?php

class ProfileController extends Controller {
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this->load_model('Users');
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

	public function changepassAction() {
		$validation = new Validate();
		$posted_values = ['oldpass' => '', 'newpass' => '',  'confirm' => ''];

		if($_POST) {
			//form validation
			$validation->check($_POST, [
				'oldpass' => [
					'display' => "Old Password",
					'required' => true
				],
				'password' => [
					'display' => 'New Password',
					'required' => true,
					'min' => 6,
					'lcase' => false
				],
				'confirm' => [
					'display' => 'Confirm Password',
					'required' => true,
					'matches' => 'password'
				]
			]);
			
			if($user = currentUser()) {
				if ($user && password_verify(Input::get('oldpass'), $user->password)) {
					$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$this->UsersModel->update($user->id, ['password' => $password]);
				}
				else {
					$validation->addError(["Old password is incorrect", ""]);
				}
			}
			else {
				$validation->addError(["You are not authorised to perform this action", ""]);
			}
		}

		$this->view->post = $posted_values;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('profile/changepass');
	}

}
?>
