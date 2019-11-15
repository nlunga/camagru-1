<?php

class Model {
	protected $_db, $_table, $_modelName, $_softDelete = false, $_columnNames = [];
	public $user_id;
	
	public function __construct($table){
		$this->_db = DB::getInstance();
		$this->_table = $table;
		$this->_setTableColumns();
		$this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->_table)));
	}

	protected function _setTableColumns() {
		$columns = $this->get_columns();
		foreach($columns as $column) {
			$columnName = $column->Field;
			$this->_columnNames[] = $column->Field;
			$this->{$columnName} = null;
		}
	}

	public function get_columns() {
		return $this->_db->get_columns($this->_table);
	}

	protected function _softDeleteParams($params) {
		if($this->_softDelete) {
			if(array_key_exists('conditions', $params)) {
				if(is_array($params['conditions'])) {
					$params['conditions'][] = "deleted != 1";
				}
				else {
					$params['conditions'] .= "AND deleted != 1";
				}
			}
			else {
				$params['conditions'] = "deleted != 1";
			}
		}
		return $params;
	}

	public function find($params = []) {
		$params = $this->_softDeleteParams($params);
		$results = [];
		$resultsQuery = $this->_db->find($this->_table, $params);
		if (!empty($resultsQuery)) {
			foreach($resultsQuery as $result) {
				$obj = new $this->_modelName($this->_table);
				$obj->populateObjData($result);
				$results[] = $obj;
			}
		}
		return $results;
	} 

	public function findFirst($params = []) {
		$params = $this->_softDeleteParams($params);
		$resultQuery = $this->_db->findFirst($this->_table, $params);
		$result = new $this->_modelName($this->_table);
		if ($resultQuery){
			$result->populateObjData($resultQuery);
		}
		return $result;
	}

	public function findById($user_id) {
		return $this->findFirst(['conditions' => "user_id = ?", 'bind' => [$user_id]]);
	}

	public function save() {
		$fields = [];
		foreach($this->_columnNames as $column) {
			$fields[$column] = $this->$column;
		}

		//determine whethere to update or insert
		if(property_exists($this, 'user_id') && $this->user_id != '') {
			return $this->update($this->user_id, $fields);
		}
		else {
			return $this->insert($fields);
		}
	}

	public function insert($fields) {
		if(empty($fields)) return false;
		return $this->_db->insert($this->_table, $fields);
		
	}

	// public function remove($fields) {
	// 	if(empty($fields)) return false;
	// 	$this->query()
		
	// }

	public function update($user_id, $fields) {
		if(empty($fields) || $user_id == '') return false;
		return $this->_db->update($this->_table, $user_id, $fields);
	}

	public function delete($user_id = '') {
		if ($user_id == '' && $this->user_id == '') return false;
		$user_id = ($user_id == '') ? $this->user_id : $user_id;
		if ($this->_softDelete) {
			return $this->update($user_id, ['deleted' => 1]);
		}
		return $this->_db->delete($this->_table, $user_id);
	}

	public function query($sql, $bind = []) {
		return $this->_db->query($sql, $bind);
	}

	public function data() {
		$data = new stdClass();
		foreach($this->_columnNames as $column) {
			$data->column = $this->column;
		}
		return $data;
	}

	public function assign($params) {
		if(!empty($params)) {
			foreach($params as $key => $val) {
				if(in_array($key, $this->_columnNames)) {
					$this->$key = sanitize($val);
				}
			}
			return true;
		}
		return false;
	}

	protected function populateObjData($result) {
		foreach($result as $key => $val) {
			$this->$key = $val;
		}
	}

	public function getData($user = []){
		if ($user){
			return $this->query("SELECT * FROM {$this->_table} WHERE `user_id`='$user' ORDER BY creation_date DESC")->results();
		}
		return $this->query("SELECT * FROM {$this->_table} ORDER BY creation_date DESC")->results();
	}


}
