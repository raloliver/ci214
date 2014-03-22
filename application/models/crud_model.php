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
			foreach ($id as $_key => $_value) {
				$this->db->where($_key, $_value);
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
	// $result = $this->user_model->update(array('login' => 'fernanda'), array ('date_created' => '0'));
	public function update($new_data, $where)
	{
		if (is_numeric($where)) {
			$this->db->where($this->_primary_key, $where);
		}
		elseif (is_array($where)) {
			foreach ($where as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		}
		else {
			die("Você deve informar o segundo parâmetro para o método ATUALIZAR()");
		}		

		$this->db->update($this->_table, $new_data);
		return $this->db->affected_rows();
	}

	// ------------------------------------------------------------------------------

	// CASA A ATUALIZAÇÃO EXISTA, ATUALIZE, CASO NÃO CRIE
	// $result = insertUpdate(array('name' => 'oliver'), 12)
	public function insertUpdate($data, $id = false)
	{
		if (!$id) {
			die("Você deve informar o segundo parâmetro para o método InserirATUALIZAR()");
		}

		$this->db->select($this->_primary_key);
		$this->db->where($this->_primary_key, $id);
		$q = $this->db->get($this->_table);
		$result = $q->num_rows();

		if ($result == 0) {
			// INSERT
			return $this->insert($data);
		}
		// UPDATE
		return $this->update($data, $id);
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
			foreach ($id as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		}
		else {
			die("Você deve informar o primeiro parâmetro para o método DELETAR()");
		}

		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}

}

/* End of file crud.php */
/* Location: ./application/models/crud.php */