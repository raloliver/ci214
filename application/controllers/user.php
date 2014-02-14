<?php
	class User extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
		}

		public function login()
		{
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			
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
				$this->output->set_output(json_encode(array('result' => 0, 'data' => validation_errors())));
				return false;
			}


			$login = $this->input->post('login');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');

			$user_id = $this->user_model->insert(array(
				'login' => $login,
				'password' => hash('sha256', $password . VESPER),
				'email' => $email
			));
			
			echo $user_id;
			die('not yeat ready');

			if ($result) {
				$this->session->set_userdata(array('user_id' => $result[0]['user_id']));
				$this->output->set_output(json_encode(array('result' => 1)));
				return false;
			}
			$this->output->set_output(json_encode(array('result' => 0)));		
		}

		public function test_get()
		{
			$data = $this->user_model->get(2);
			print_r($data);
			// DEBUG
			$this->output->enable_profiler();
		}

		public function test_insert()
		{
			$result = $this->user_model->insert(array(
					'login' => 'fernanda'
				));
				print_r($result);
		}

		public function test_update()
		{
			$result = $this->user_model->update(array(
					'login' => 'valesca'
				), 3);
				print_r($result);
		}

		public function test_delete($user_id)
		{
			$result = $this->user_model->delete($user_id);
			print_r($result);
		}
	}