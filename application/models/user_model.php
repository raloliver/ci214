<?php
	class User_model extends CI_Model
	{
		// ALL: $this->user_model->get(); SINGLE: // $this->user_model->get(2);
		public function get($user_id = null)
		{	
			if($user_id === null){
				$q = $this->db->get('user');
			} else {
				$q = $this->db->get_where('user', array('user_id' => $user_id));
			}
			return $q->result_array();
		}
		// array $data
		// $result = $this->user_model->insert(array('login' => 'fernanda';));
		public function insert($data)
		{
			$this->db->insert('user', $data);
			return $this->db->insert_id();
		}
		// $result = $this->user_model->update(array('login' => 'valesca'), 3);
		public function update($data, $user_id)
		{
			$this->db->where(array('user_id' => $user_id));
			$this->db->update('user', $data);
			return $this->db->affected_rows();
		}
		// $result = $this->user_model->delete(5);
		public function delete($user_id)
		{
			$this->db->delete('user', array('user_id' => $user_id));
			return $this->db->affected_rows();
		}
	}

