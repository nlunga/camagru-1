<?php
	
	class UploadController extends Controller{
		
		public function __construct($controller, $action){
			parent::__construct($controller, $action);
			$this->view->setLayout('default');
			$this->load_model('Posts') ;
			$this->load_model('Users') ;
		}

		public function indexAction() {
			if(isset($_POST)){
				$data = $_POST['imgData'];
				$data = str_replace('data:image/png;base64,', '', $data);
				$data = str_replace(' ', '+', $data);
				$data = base64_decode($data);
			}
			$this->view->render('upload/index');
		}

	}
