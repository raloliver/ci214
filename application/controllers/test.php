<?php
	class Test extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
			$result = $this->user_model->get();
			// $result = $this->user_model->get(array(
			// 	'login' => 'israeloliveira',
			// 	'user_id'	=> 10
			// 	'login !=' => 'raloliver'
			// ));

			// $result = $this->user_model->insert(array('login' => 'lucas'));

			// $result = $this->user_model->delete(11);

			echo '<pre>';
			print_r($result);
			echo '</pre>';


		}	

		public function index()
			{
				$this->output->enable_profiler(TRUE);
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