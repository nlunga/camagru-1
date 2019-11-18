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
			//$this->view->data['post'] = ($this->PostsModel->query("SELECT * FROM posts WHERE post_id = ?", [$p]));
			//var_dump($this->view->data['post']);
			//$fields = ['conditions' => 'post_id = ?', 'bind'=>[$p]];
			$post = $this->PostsModel->findFirst(['conditions' => "post_id = ?", 'bind' => [$p]]);//['result'];
			$this->view->data['post'] = $post;
			//$post = $this->PostsModel->findPost($p);
		} catch (Exception $e){
			
		}
		
		//dnd($post);

		$users = $this->UsersModel->getUsers();
		$result = $this->PostsModel->getPosts();
		$comments = $this->CommentsModel->getComments();
		$_SESSION['comments'] = $comments;
		$_SESSION['posts'] = $result;
		$_SESSION['users'] = $users;
		$countlikes = $this->LikesModel->countLikes($post->post_id);
		$_SESSION['countLike'] = $countlikes;

		$validation = new Validate();

		if($_POST){
			
			if(array_key_exists('delcomm', $_POST)){
				$user_id = $this->UsersModel->currentLoggedInUser()->user_id;
				$comm_id = $_POST['commid'];
				$this->CommentsModel->delComment($comm_id, $user_id);
				header("Refresh:0");
			}

			if(array_key_exists('likebtn', $_POST)){
				//echo"here";
				$user_id = $this->UsersModel->currentLoggedInUser()->user_id;
				$post_id = $_POST['postid'];
				//echo $user_id." ".$post_id."\n";
				$this->LikesModel->like($post_id, $user_id);
				$this->likeMail($post_id, $user_id);
				header("Refresh:0");
			}

			else if (array_key_exists('addcomm', $_POST)) {
				$posted_values = posted_values($_POST);
				$validation->check($posted_values, [
					'addcomm' => [
						'display' => "Comment",
						'required' => true
					]
				]);
				if($validation->passed()) {
					echo "here";
					$user_id = $this->UsersModel->currentLoggedInUser()->user_id;
					$post_id = $posted_values['postid'];
					$comment = htmlspecialchars($posted_values['addcomm']);
					$this->CommentsModel->uploadComment($post_id, $user_id, $comment);
					$this->commentMail($post_id, $user_id, $comment);
					header("Refresh:0");
				}
			}	
		}

		$this->view->render('post/index');
	}

	public function likeMail($post_id, $user_id) {
		$user = $this->PostsModel->findFirst(['conditions' => 'post_id = ?', 'bind' => [$post_id]]);
		$user = $this->UsersModel->findFirst(['conditions' => 'user_id = ?', 'bind' => [$user->user_id]]);
		$poster = $this->UsersModel->findFirst(['conditions' => '`user_id` = ?', 'bind' => [$user_id]]);
		if($user && $user->notify == 1) {
			$message = '<p>'.ucwords($poster->fname).' liked on your post</p>';
			$this->UsersModel->sendMail($user->email, "Someone liked on your post", $message);
		}
	}

	public function commentMail($post_id, $user_id, $comment){
		$user = $this->PostsModel->findFirst(['conditions' => 'post_id = ?', 'bind' => [$post_id]]);
		$user = $this->UsersModel->findFirst(['conditions' => 'user_id = ?', 'bind' => [$user->user_id]]);
		$poster = $this->UsersModel->findFirst(['conditions' => '`user_id` = ?', 'bind' => [$user_id]]);
		if($user && $user->notify == 1) {
			$message = '<p>'.ucwords($poster->fname).' commented on your post:</p> <br> <p>"'.$comment.'"</p>';
			$this->UsersModel->sendMail($user->email, "Someone commented on your post", $message);
		}
	}

}
?>
