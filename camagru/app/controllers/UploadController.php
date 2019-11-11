<?php
	
	class UploadController extends Controller{
		
		public function __construct($controller, $action){
			parent::__construct($controller, $action);
			$this->view->setLayout('default');
			$this->load_model('Posts') ;
			$this->load_model('Users') ;
		}

		public function indexAction() {
			$this->view->render('upload/index');
		}

	}
