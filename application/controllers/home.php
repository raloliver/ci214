<?php 
	class Home extends CI_Controller 
	{
		public function index()
		{
			$this->load->view('home/inc/header_view');
			$this->load->view('home/home_view');
			$this->load->view('home/inc/footer_view');
		}
		public function test()
		{
			$this->db->select('user_id, login')
					 ->from('user')
					 ->order_by('user_id DESC');

			$q = $this->db->get();
			print_r($q->result());

			// $this->db->insert('user', array(
			// 		'login' => 'raloliver'
			// 	));

			// $this->db->where(array('user_id' => 4));
			// $this->db->update('user', array(
			// 		'login' => 'israel'
			// 	));

			// $this->db->where(array('user_id' => 4));
			// $this->db->delete('user')

			// $this->db->delete('user', array('user_id' => 3));

		}
	}