<?php

class RegisterController extends Controller {


	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this->load_model('Users');
		$this->view->setLayout('default');
	}

	public function loginAction() {
		//echo password_hash('admin', PASSWORD_DEFAULT);
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
				if ($user && password_verify(Input::get('password'), $user->password) && $user->verified == 1) {
					$remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
					$user->login($remember);
					Router::redirect('');
				}
				else if ($user && password_verify(Input::get('password'), $user->password) && $user->verified == 0) {
					$validation->addError(["Please verify your account before you can log in.", ""]);
				}
				else {
					$validation->addError(["There is an error with your username or password.", ""]);
				}
			}
		}

		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('register/login');
	}

	public function logoutAction() {
		if(currentUser()) {
			currentUser()->logout();
		}
		Router::redirect('register/login');
	}

	public function registerAction() {
		$validation = new Validate();
		$posted_values = ['fname' => '', 'lname' => '', 'username' => '', 'email' => '', 'password' => '', 'confirm' => ''];

		if($_POST) {
			$posted_values = posted_values($_POST);
			$validation->check($_POST, [
				'fname' => [
					'display' => 'First Name',
					'required' => true
				],
				'lname' => [
					'display' => 'Last Name',
					'required' => true
				],
				'username' => [
					'display' => 'Username',
					'required' => true,
					'unique' => 'users',
					'min' => 6,
					'max' => 150
				],
				'email' => [
					'display' => 'Email',
					'required' => true,
					'unique' => 'users',
					'max' => 150,
					'valid_email' => true
				],
				'password' => [
					'display' => 'Password',
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

			if($validation->passed()) {
				$newUser = new Users();
				$token = bin2hex(random_bytes(20));
				$newUser->registerNewUser($_POST, $token);
				$message = "<a href='http://localhost:8080/camagru/camagru/register/verify?token=$token'>Click here to verify your account.</a>";
				$this->UsersModel->sendMail($_POST['email'],"Camagru Validation Request", $message);
				Router::redirect('register/login');
			}
		}

		$this->view->post = $posted_values;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('register/register');
	}

	public function verifyAction(){
		$token = $_GET['token'];
		$result = $this->UsersModel->findFirst(['conditions' => "token = ?", 'bind' => [$token]]);
		if($result->email){
			if ($result->token){
				$this->UsersModel->update($result->id, ['verified' => 1]);
				$this->UsersModel->update($result->id, ['token' => '']);
				$this->view->render('register/verify');
			}
		}
		else{
			$this->view->render('restricted');
		}
	}

	public function forgotAction(){
		$validation = new Validate();
		$posted_values = ['email' => ''];

		if($_POST) {
			$posted_values = posted_values($_POST);
			$validation->check($_POST, [
			'email' => [
				'display' => 'Email',
				'required' => true,
				'max' => 150,
				'valid_email' => true
			]
		]);
		}

		if($validation->passed()) {
			$result = $this->UsersModel->findFirst(['conditions' => 'email = ?', 'bind' => [$posted_values['email']]]);
			if($result->email) {
				if ($result->token == '' && $result->verified == 1) {
					$token = bin2hex(random_bytes(20));
					$this->UsersModel->update($result->id, ['token' => $token]);
					$message = "<a href='http://localhost:8080/camagru/camagru/register/resetpass?token=$token'>Click here to reset your pasword.</a>";
					$this->UsersModel->sendMail($_POST['email'], "Camagru Password Reset Request", $message);
					Router::redirect('register/login');
				}
				else {
					$validation->addError("Please verify your account before changing passwords");
				}
			}
			else {
				$validation->addError("Email not found. Please register");
			}
		}

		$this->view->post = $posted_values;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('register/forgot');
		
	}

	public function resetpassAction() {

		$validation = new Validate();
		$posted_values = ['password' => '', 'confirm' => ''];
		
		if($_POST) {
			$posted_values = posted_values($_POST);
			$validation->check($_POST, [
				'password' => [
					'display' => 'Password',
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
		}

		if($validation->passed()) {
			$token = $_GET['token'];
			$result = $this->UsersModel->findFirst(['conditions' => "token = ?", 'bind' => [$token]]);
			if ($result->email) {
				if ($result->token == $token && $result->verified == 1) {
					$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$this->UsersModel->update($result->id, ['password' => $password]);
					$this->UsersModel->update($result->id, ['token' => '']);
					Router::redirect('register/login');
				}
				else{
					$validation->addError("Please verify your account before changing passwords");
				}
			}
			else {
				$validation->addError("Email not found. Please register");
			}
		}
		$this->view->post = $posted_values;
		$this->view->displayErrors = $validation->displayErrors();
		$this->view->render('register/resetpass');
		
	}

}
