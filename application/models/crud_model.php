<?php

	class CRUD_model extends CI_Model 
	{

		protected $_table = null;
		protected $_primary_key = null;

	// ------------------------------------------------------------------------------

		public function __construct()
		{
			parent::__construct();
			
		}

	// ------------------------------------------------------------------------------

	// ALL: $this->user_model->get(); SINGLE: // $this->user_model->get(2); CUSTOM: // $this->user_model->get(array('age' => '28', 'gender' => 'male'))
	public function get($id = null, $order_by = null)
	{	

		if (is_numeric($id)) {
			$this->db->where($this->_primary_key, $id);
		}

		if (is_array($id)) {
			foreach ($id as $_key => $value) {
				$this->db->where($_key, $value);
			}
		}
		
		$q = $this->db->get($this->_table);		
		return $q->result_array();
	}

	// ------------------------------------------------------------------------------

	// array $data
	// $result = $this->user_model->insert(array('login' => 'fernanda'));
	public function insert($data)
	{
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}

	// ------------------------------------------------------------------------------

	// $result = $this->user_model->update(array('login' => 'valesca'), 3);
	public function update($data, $user_id)
	{
		$this->db->where(array('$user_id' => $user_id));
		$this->db->update('user', $data);
		return $this->db->affected_rows();
	}

	// ------------------------------------------------------------------------------
	
	// $result = $this->user_model->delete(5);
	// NEW MODEL = $this->user_model->delete(array('name' => 'Ral'));
	public function delete($id)
	{
		if (is_numeric($id)) {
			$this->db->where($this->_primary_key, $id);
		}
		elseif (is_array($id)) {
			foreach ($id as $_key => $value) {
				$this->db->where($_key, $value);
			}
		}
		else {
			die("Você deve informar o parâmetro para o método DELETAR()");
		}

		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}

}

/* End of file crud.php */
/* Location: ./application/models/crud.php */