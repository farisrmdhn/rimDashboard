<?php
	class Admins extends CI_Controller{
		public function login(){
			$data['title'] = 'Admin Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admins/login', $data);
			}else{
				//Get Username
				$username = $this->input->post('username');
				//Get and encrypt the password
				$password = md5($this->input->post('password'));

				//Login User -> get id
				$user_id = $this->admin_model->login($username, $password);

				if($user_id){
					//Create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'admin' => true,
						'name' => $username,
						'rim' => false,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					redirect('admins/index');
				}else{
					//Set Message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('admins/login');
				}
			}
		}

		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('admin');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('rim');

			redirect('admins/login');
		}

		public function change_password(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
			$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_old_password');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/admin_header');
				$this->load->view('admins/change_password');
				$this->load->view('templates/footer');
			}else{
				$enc_password = md5($this->input->post('password'));

				$this->admin_model->change_password($enc_password);

				redirect('admins/index');
			}
		}

		public function index(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}

			$data['bod_array'] = $this->user_model->get_all_bod();
			$data['rim_array'] = $this->user_model->get_all_rim();

			//Load tampilan index
			$this->load->view('templates/admin_header');
			$this->load->view('admins/index', $data);
			$this->load->view('templates/footer');
		}

		public function create_bod(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_bod_exist');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/admin_header');
				$this->load->view('admins/create_bod');
				$this->load->view('templates/footer');
			}else{
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->user_model->register($enc_password, 1);

				redirect('admins/manage_bod');
			}
		}

		public function create_rim(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_rim_exist');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/admin_header');
				$this->load->view('admins/create_rim');
				$this->load->view('templates/footer');
			}else{
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->user_model->register($enc_password, 2);

				redirect('admins/manage_rim');
			}
		}

		public function manage_bod(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}

			$data['bod_array'] = $this->user_model->get_all_bod();

			//Load tampilan index
			$this->load->view('templates/admin_header');
			$this->load->view('admins/manage_bod', $data);
			$this->load->view('templates/footer');
		}

		public function manage_rim(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}

			$data['rim_array'] = $this->user_model->get_all_rim();

			//Load tampilan index
			$this->load->view('templates/admin_header');
			$this->load->view('admins/manage_rim', $data);
			$this->load->view('templates/footer');
		}

		public function edit_bod($id){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_edit_bod_exist');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'callback_check_password_matches');

			$data['bod'] = $this->user_model->get_user_by_id($id, 1);

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/admin_header');
				$this->load->view('admins/edit_bod', $data);
				$this->load->view('templates/footer');
			}else{
				$enc_password = $this->input->post('default_password');

				if($this->input->post('password') != NULL){
					$enc_password = md5($this->input->post('password'));
				}

				$this->user_model->update($enc_password);

				$key = $this->input->post('key');
				if($key == 1){
					redirect('admins/manage_bod');
				}else{
					redirect('admins/manage_rim');
				}
			}
		}

		public function edit_rim($id){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_edit_rim_exist');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'callback_check_password_matches');

			$data['rim'] = $this->user_model->get_user_by_id($id, 2);

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/admin_header');
				$this->load->view('admins/edit_rim', $data);
				$this->load->view('templates/footer');
			}else{
				$enc_password = $this->input->post('default_password');

				if($this->input->post('password') != NULL){
					$enc_password = md5($this->input->post('password'));
				}

				$this->user_model->update($enc_password);

				$key = $this->input->post('key');
				if($key == 1){
					redirect('admins/manage_bod');
				}else{
					redirect('admins/manage_rim');
				}
			}
		}

		public function delete(){
			if($this->session->userdata['logged_in'] != true && $this->session->userdata['admin'] != true){
				redirect('users/login');
			}
			if($this->session->userdata['logged_in'] == true && $this->session->userdata['admin'] != true){
				redirect('pages/index');
			}
			$key = $this->input->post('key');
			$id = $this->input->post('id');

			$this->user_model->delete($id, $key);

			if($key == 1){
				redirect('admins/manage_bod');
				}else{
				redirect('admins/manage_rim');
			}
		}

		public function check_username_bod_exist($username){
			$this->form_validation->set_message('check_username_bod_exist', 'That username is already taken. Please choose a diffrent one');

			if($this->user_model->check_username_exist($username, 1)){
				return true;
			} else{
				return false;
			}
		}

		public function check_username_edit_bod_exist($username){
			if($this->input->post('username') === $this->input->post('default_username')){
				return true;
			}
			$this->form_validation->set_message('check_username_edit_bod_exist', 'That username is already taken. Please choose a diffrent one');

			if($this->user_model->check_username_exist($username, 1)){
				return true;
			} else{
				return false;
			}
		}


		public function check_username_rim_exist($username){
			$this->form_validation->set_message('check_username_rim_exist', 'That username is already taken. Please choose a diffrent one');

			if($this->user_model->check_username_exist($username, 2)){
				return true;
			} else{
				return false;
			}
		}

		public function check_username_edit_rim_exist($username){
			if($this->input->post('username') === $this->input->post('default_username')){
				return true;
			}
			$this->form_validation->set_message('check_username_edit_rim_exist', 'That username is already taken. Please choose a diffrent one');

			if($this->user_model->check_username_exist($username, 2)){
				return true;
			} else{
				return false;
			}
		}

		public function check_password_matches($password2){
			if($this->input->post('password2') == null){
				return true;
			}

			$this->form_validation->set_message('check_password_matches', 'Password did not match');
			if($this->input->post('password2') === $this->input->post('password')){
				return true;
			}else{
				return false;
			}
		}
		
		public function check_old_password($old_password){
			$old_password = md5($old_password);
			$this->form_validation->set_message('check_old_password', 'That is not your old password. Please enter the right one');
			if($old_password === $this->admin_model->check_old_password($old_password)){
				return true;
			}else{
				return false;
			}
		}
	}