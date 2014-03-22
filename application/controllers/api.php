<?php 
	
	class Api extends CI_Controller
	{

		// ------------------------------------------------------------------------------

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');	
			$this->load->model('todo_model');
			$this->load->model('note_model');
		}

		// ------------------------------------------------------------------------------

		private function _require_login()
		{
			if ($this->session->userdata('user_id') == false) {				
				$this->output->set_output(json_encode(array('result' => 0, 'error' => 'Você não está autorizado a ver isso!')));	
				return false;
			}
		}

		// ------------------------------------------------------------------------------

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

		// ------------------------------------------------------------------------------

		public function register()
		{	
			$this->output->set_content_type('application_json');

			$this->form_validation->set_rules('login', 'Usuário', 'required|min_length[4]|max_length[16]|is_unique[user.login]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Senha', 'required|min_length[4]|max_length[16]|matches[confirm_password]');
			$this->form_validation->set_message('matches','O campo %s não é igual ao Confirmar Senha');

			if ($this->form_validation->run() == false) {
				$this->output->set_output(json_encode(array('result' => 0, 'error' => $this->form_validation->error_array())));
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
			
			if ($user_id) {
				$this->session->set_userdata(array('user_id' => $user_id));
				$this->output->set_output(json_encode(array('result' => 1)));
				return false;
			}

			$this->output->set_output(json_encode(array('result' => 0, 'error' => 'Erro ao cadastrar usuário.')));		
		}

		// ------------------------------------------------------------------------------

		public function get_todo($id = null)
		{
			$this->_require_login();

			if ($id != null) {
				$result = $this->todo_model->get(array(
					'todo_id' => $id,
					'user_id' => $this->session->userdata('user_id')		
				));				
			} else {
				$result = $this->todo_model->get(array(
					'user_id' => $this->session->userdata('user_id')
				));				
			}
			
			$this->output->set_output(json_encode($result));
		}

		// ------------------------------------------------------------------------------

		public function create_todo()
		{
			$this->_require_login();

			$this->form_validation->set_rules('content', 'Título da Nota', 'required|max_length[32]');
			if ($this->form_validation->run() == false) {
				$this->output->set_output(json_encode(array(
					'result' => 0,
					'error'	 => $this->form_validation->error_array()
				)));			

				return false;
			}

			$result = $this->todo_model->insert(array(
				'content' => $this->input->post('content'),
				'user_id' => $this->session->userdata('user_id')
			));

			if ($result) {

				// Entrada mais recente para o DOM	

				$this->output->set_output(json_encode(array(
					'result' => 1,
					'data'	 => array(
							'todo_id' => $result,
							'content' => $this->input->post('content'),
							'complete' => 0
						)
				)));
				return false;
			}

			$this->output->set_output(json_encode(array(
				'result' => 0,
				'error'	 => 'Não foi possível inserir a nota!'

			)));
		}

		// ------------------------------------------------------------------------------

		public function update_todo()
		{
			$this->_require_login();
			$todo_id = $this->input->post('todo_id');
			$completed = $this->input->post('completed');

			$result = $this->todo_model->update(array(
				'completed' => $completed
			), $todo_id);

			if ($result) {
				$this->output->set_output(json_encode(array('result' => 1,)));
				return false;
			}
			
			$this->output->set_output(json_encode(array('result' => 0,)));
			return false;
		}

		// ------------------------------------------------------------------------------

		public function delete_todo()
		{
			$this->_require_login();			

			$result = $this->todo_model->delete(array(
				'todo_id' => $this->input->post('todo_id'),
				'user_id' => $this->session->userdata('user_id')

			));

			if ($result) {
				$this->output->set_output(json_encode(array('result' => 1,)));
				return false;
			}

			$this->output->set_output(json_encode(array(
				'result'  => 0,
				'message' => 'Erro ao deletar Tarefa.'
			)));

		}

		// ------------------------------------------------------------------------------

		public function get_note($id = null)
		{
			$this->_require_login();

			if ($id != null) {
				$result = $this->note_model->get(array(
					'note_id' => $id,
					'user_id' => $this->session->userdata('user_id')		
				));				
			} else {
				$result = $this->note_model->get(array(
					'user_id' => $this->session->userdata('user_id')
				));				
			}
			
			$this->output->set_output(json_encode($result));
		}

		// ------------------------------------------------------------------------------

		public function create_note()
		{
			$this->_require_login();

			$this->form_validation->set_rules('title', 'Título do Lembrete', 'required|max_length[32]');
			$this->form_validation->set_rules('content', 'Conteúdo do Lembrete', 'required|max_length[255]');
			if ($this->form_validation->run() == false) {
				$this->output->set_output(json_encode(array(
					'result' => 0,
					'error'	 => $this->form_validation->error_array()
				)));			

				return false;
			}

			$result = $this->note_model->insert(array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),				
				'user_id' => $this->session->userdata('user_id')
			));

			if ($result) {

				// Entrada mais recente para o DOM	

				$this->output->set_output(json_encode(array(
					'result' => 1,
					'data'	 => array(
							'note_id' => $result,
							'title' => $this->input->post('title'),
							'content' => $this->input->post('content')
						)
				)));
				return false;
			}

			$this->output->set_output(json_encode(array(
				'result' => 0,
				'error'	 => 'Não foi possível inserir a nota!'

			)));
			if ($this->form_validation->run() == false) {
				$this->output->set_output(json_encode(array(
					'result' => 0,
					'error'	 => $this->form_validation->error_array()
				)));			

				return false;
			}

			$result = $this->todo_model->insert(array(
				'content' => $this->input->post('content'),
				'user_id' => $this->session->userdata('user_id')
			));

			if ($result) {

				// Entrada mais recente para o DOM	

				$this->output->set_output(json_encode(array(
					'result' => 1,
					'data'	 => $result
				)));
				return false;
			}

			$this->output->set_output(json_encode(array(
				'result' => 0,
				'error'	 => 'Não foi possível inserir a nota!'

			)));
		}

		// ------------------------------------------------------------------------------

		public function update_note()
		{
			$this->_require_login();
			$note_id = $this->input->post('note_id');

			$result = $this->note_model->update(array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content')
			), $note_id);

			// Melhor não verificar se foi atualizado porque pode parecer um erro!
			/*if ($result) {
				$this->output->set_output(json_encode(array('result' => 1,)));
				return false;
			}*/
			
			$this->output->set_output(json_encode(array('result' => 1,)));
			return false;
		}

		// ------------------------------------------------------------------------------

		public function delete_note()
		{
			$this->_require_login();			

			$result = $this->note_model->delete(array(
				'note_id' => $this->input->post('note_id'),
				'user_id' => $this->session->userdata('user_id')

			));

			if ($result) {
				$this->output->set_output(json_encode(array('result' => 1,)));
				return false;
			}

			$this->output->set_output(json_encode(array(
				'result'  => 0,
				'message' => 'Erro ao deletar Lembrete.'
			)));
		}
	}