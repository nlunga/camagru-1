<?php

class PostController extends Controller {
	
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
		$this->view->setLayout('default');
		$this->load_model('Users');
		$this->load_model('Posts');
		$this->load_model('Comments');
		$this->load_model('Likes');
	}

	public function indexAction() {

		$p = $_GET['p'];
		try {
			$post = $this->PostsModel->findPost($p);
		} catch (Exception $e){
			
		}
		
		$_SESSION['post_id'] = $post;
		//dnd($post);

		$users = $this->UsersModel->getUsers();
		$result = $this->PostsModel->getPosts();
		$comments = $this->CommentsModel->getComments();
		$_SESSION['comments'] = $comments;
		$_SESSION['posts'] = $result;
		$_SESSION['users'] = $users;

		$validation = new Validate();

		if($_POST){
			
			if(array_key_exists('delcomm', $_POST)){
				$user_id = $this->UsersModel->currentLoggedInUser()->user_id;
				$comm_id = $_POST['commid'];
				$this->CommentsModel->delComment($comm_id, $user_id);
				header("Refresh:0");
			}

			if(array_key_exists('likebtn', $_POST)){
				$user_id = $this->UsersModel->currentLoggedInUser()->user_id;
				$post_id = $_POST['postid'];
				$this->LikesModel->like($post_id, $user_id);
				header("Refresh:0");
			}

			else if (array_key_exists('addcomm', $_POST)) {
				$validation->check($_POST, [
					'addcomm' => [
						'display' => "Comment",
						'required' => true
					]
				]);
				if($validation->passed()) {
					echo "here";
					$user_id = $this->UsersModel->currentLoggedInUser()->user_id;
					$post_id = $_POST['postid'];
					$comment = htmlspecialchars($_POST['addcomm']);
					$this->CommentsModel->uploadComment($post_id, $user_id, $comment);
					header("Refresh:0");
				}
			}	
		}

		$this->view->render('post/index');
	}

}
?>
