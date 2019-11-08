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
					Router::redirect('profile/settings');
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

	public function changemailAction() {
		$validation = new Validate();
		$posted_values = ['email' => ''];

		if($_POST) {
			$posted_values = posted_values($_POST);
			$validation->check($_POST, [
				'email' => [
					'display' => 'Email',
					'required' => true,
					'unique' => 'users',
					'max' => 150,
					'valid_email' => true
				]
			]);

			if($validation->passed()) {
				$user = currentUser();
				$this->UsersModel->update($user->id, ['email' => $_POST['email']]);
				Router::redirect('profile/settings');
			}

		}

		$this->view->post = $posted_values;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('profile/changemail');
	}

	public function changeusernameAction() {
		$validation = new Validate();
		$posted_values = ['username' => ''];

		if($_POST) {
			$posted_values = posted_values($_POST);
			$validation->check($_POST, [
				'username' => [
					'display' => 'Username',
					'required' => true,
					'unique' => 'users',
					'min' => 6,
					'max' => 150
				]
			]);

			if($validation->passed()) {
				$user = currentUser();
				$this->UsersModel->update($user->id, ['username' => $_POST['username']]);
				Router::redirect('profile/settings');
			}

		}

		$this->view->post = $posted_values;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('profile/changeusername');
	}

}
?>
