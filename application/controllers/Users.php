<?php
	class Users extends CI_Controller{
		public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('users/login', $data);
			}else{
				//Get Username
				$username = $this->input->post('username');
				//Misahin antara bod dan rim
				$rim = false;
				$key = substr($username,-4);
				if($key == '@rim'){
					$rim = true;
				}
				//Get and encrypt the password
				$password = md5($this->input->post('password'));

				//Login User -> get id
				$user_id = $this->user_model->login($username, $password, $rim);

				if($user_id){
					$name = $this->user_model->get_name($user_id, $rim);
					//Create session
					$user_data = array(
						'user_id' => $user_id,
						'rim' => $rim,
						'name' => $name,
						'username' => $username,
						'admin' => false,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					//Set Message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					redirect('pages/index');
				}else{
					//Set Message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('users/login');
				}
			}
		}

		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('rim');

			redirect('users/login');
		}
		
		public function change_password(){
			if($this->session->userdata['logged_in'] != true){
				redirect('users/login');
			}
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
			$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_old_password');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/change_password');
				$this->load->view('templates/footer');
			}else{
				$enc_password = md5($this->input->post('password'));

				$this->user_model->change_password($enc_password);

				redirect('admins/index');
			}
		}
		
		public function check_old_password($old_password){
			$old_password = md5($old_password);
			$this->form_validation->set_message('check_old_password', 'That is not your old password. Please enter the right one');
			if($old_password === $this->user_model->check_old_password($old_password)){
				return true;
			}else{
				return false;
			}
		}
	}