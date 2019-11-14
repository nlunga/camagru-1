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

		public function submitAction() {
			
			if(isset($_POST['img'])) {
				$data = $_POST['img'];
				$data = str_replace('data:image/png;base64,', '', $data);
				$data = str_replace(' ', '+', $data);
				$data = base64_decode($data);
				$image = imagecreatefromstring($data);

				$filter = $_POST['filter'];
				if ($filter == 'invert(100%)'){
					imagefilter($image, IMG_FILTER_NEGATE);
				}
				else if ($filter == 'grayscale(100%)'){
					imagefilter($image, IMG_FILTER_GRAYSCALE);
				}
				else if ($filter == 'contrast(200%)'){
					imagefilter($image, IMG_FILTER_CONTRAST, -50);
				}
				else if ($filter == 'blur(10px)'){
					imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR, 1000);
				}
				else if($filter == 'sepia(100%)'){
					imagefilter($image, IMG_FILTER_GRAYSCALE);
					imagefilter($image, IMG_FILTER_COLORIZE, 100, 50, 0);
				}

				$user = $this->UsersModel->currentLoggedInUser()->user_id;

				$file_name = time().rand().".jpg";
				imagejpeg($image, ROOT."/imgs/".$file_name);
				$this->PostsModel->uploadImage($file_name, $user);
			}
			else
			{
				http_response_code(400);
				echo "thing went wrong";
			}
		}

	}
