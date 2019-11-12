<?php
	
	class UploadController extends Controller{
		
		public function __construct($controller, $action){
			parent::__construct($controller, $action);
			$this->view->setLayout('default');
			$this->load_model('Posts') ;
			$this->load_model('Users') ;
		}

		public function indexAction() {

			if(isset($_POST['img'])) {
				$data = $_POST['img'];
				$data = str_replace('data:image/png;base64,', '', $data);
				$data = str_replace(' ', '+', $data);
				$data = base64_decode($data);
				$image = imagecreatefromstring($data);

				$user = $this->UsersModel->currentLoggedInUser()->username;
				var_dump($user);
				$file_name = time().rand().".jpg";
				imagejpeg($image, ROOT."/imgs/".$file_name);
				$this->PostsModel->uploadImage($file_name, $user);
			}
			


			$this->view->render('upload/index');
		}

		public function submitAction() {
			$this->view->render('upload/submit');
		}

	}
