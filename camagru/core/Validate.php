<?php

class Validate {
	private $_passed = false, $_errors = [], $_db = NULL;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = []) {
		$this->_errors = [];
		foreach($items as $item => $rules) {
			$item = Input::sanitize($item);
			$display = $rules['display'];
			foreach ($rules as $rule => $rule_value) {
				$value = Input::sanitize(trim($source[$item]));

				if ($rule === 'required' && empty($value)) {
					$this->addError(["{$display} is required", $item]);
				}
				else if (!empty($value)) {
					switch ($rule) {

						case 'min':
						if(strlen($value) < $rule_value) {
							$this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
						}
						break;

						case 'max':
						if(strlen($value) > $rule_value) {
							$this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
						}
						break;

						case 'matches':
						if($value != $source[$rule_value]) {
							$matchDisplay = $items[$rule_value]['display'];
							$this->addError(["{$matchDisplay} and {$display} must match.", $item]);
						}
						break;

						case 'unique':
						$check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);
						if ($check->count()) {
							$this->addError(["{$display} already exists. Please choose another {$display}", $item]);
						}
						break;

						case 'unique_update':
						$t = explode(',', $rule_value);
						$table = $t[0];
						$user_id = $t[1];
						$query = $this->_db->query("SELECT * FROM {$table} WHERE `user_id` != ? AND {$item} = ?", [$user_id, $value]);
						if ($query->count()) {
							$this->addError(["{$display} already exists. Please choose another {$display}.", $item]);
						}
						break;

						case 'is_numeric':
						if(!is_numeric($value)) {
							$this->addError(["{$display} has to be a number. Please use a numeric value.", $item]);
						}
						break;

						case 'valid_email':
						if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
							$this->addError(["{$display} must be a valid email address.", $item]);
						}
						break;

						case 'lcase':
						// if(ctype_alpha($value)){
						// 	if (strtolower($value) == $value){
						if(!preg_match("/^(?=.*?[0-9])(?=.*[A-Z]).{6,}$/", $value)) {
							$this->addError(["{$display} must have atleast 1 uppercase character, 1 lower case, and 1 digit.", $item]);
						}
						break;

						case 'chars':
						if(!preg_match("/^\S+\w{8,32}\S{1,}/", $value)) {
							$this->addError(["{$display} must not contain special characters or spaces", $item]);
						}
						break;

					}
				}
			}
		}

		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		return $this;
	}

	public function addError($error) {
		$this->_errors[] = $error;
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		else {
			$this->_passed = false;
		}
	}

	public function errors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}

	public function displayErrors() {
		$html = '<ul class="bg-danger">';
		foreach ($this->_errors as $error) {
			
			if(is_array($error)) {
				$html .= '<li class="text-danger">'.$error[0].'</li>';
			}
			else {
				$html .= '<li class="text-danger"'.$error.'</li>';
			}
		}
		$html .='</ul>';
		
		return $html;
	}

}
