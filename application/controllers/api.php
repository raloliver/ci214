<?php 

	class Api extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// $user_id = $this->session->userdata('user_id');
			// if (!$user_id) {
			// 	$this->logout();
			// }
		}

		public function login()
		{
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			
			$this->load->model('user_model');
			$result = $this->user_model->get(array(
					'login' => $login,
					'password' => hash('sha256', $password . VESPER)
				));

			$this->output->set_content_type('application_json');

			if ($result) {
				$this->session->set_userdata(array('user_id' => $result[0]['user_id']));
				$this->output->set_output(json_encode(array('result' => 1)));
				return false;
			}
			$this->output->set_output(json_encode(array('result' => 0)));		
		}
		public function register()
		{	
			$this->output->set_content_type('application_json');

			$this->form_validation->set_rules('login', 'Usuário', 'required|min_length[4]|max_length[16]|is_unique[user.login]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Senha', 'required|min_length[4]|max_length[16]|matches[confirm_password]');

			if ($this->form_validation->run() == false) {
				$this->output->set_output(json_encode(array('result' => 0, 'error' => $this->form_validation->error_array())));
				return false;
			}


			$login = $this->input->post('login');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');

			$this->load->model('user_model');
			$user_id = $this->user_model->insert(array(
				'login' => $login,
				'password' => hash('sha256', $password . VESPER),
				'email' => $email
			));
			
			if ($user_id) {
				$this->session->set_userdata(array('user_id' => $user_id));
				$this->output->set_output(json_encode(array('result' => 1)));
				return false;
			}

			$this->output->set_output(json_encode(array('result' => 0, 'error' => 'Erro ao cadastrar usuário.')));		
		}
	}