<?php

class HomeController extends Controller {
	public function __construct($controller, $action) {
		parent::__construct($controller, $action);
	}

	public function indexAction() {
		// $db = DB::getInstance();
		//dnd($_SESSION);
		
		$this->view->render('home/index');

		// $contacts = $db->findFirst('users', [
		// 	'conditions' => 'id = ?',
		// 	'bind' => [1],
		// ]);
		// dnd($contacts);

		//$sql = "SELECT * FROM users";
		// $fields = [
		// 	'fname' => 'Antoinette',
		// 	'lname' => 'Parham',
		// 	'email' => 'anti@blah.com'
		// ];
		//$result = $db->query($sql);
		//dnd($result);
		// $contactsQ = $db->update('users', 7, $fields);
		//$contactsQ = $db->insert('users', $fields);
		//dnd($contactsQ);

		//$contactsQ = $db->delete('users', 7);

		// $contactsQ = $db->query("SELECT * FROM users ORDER BY lname, fname");
		// $contacts = $contactsQ->first();
		// dnd($contacts->fname);

		// $columns = $db->get_columns('users');
		// dnd($columns);

		
	}

	public function discoverAction() {
		$this->view->render('home/discover');
	}
}
