<?php
	class User_model extends CI_Model{
		public function login($username, $password, $rim = false){
			if($rim == true){
				$result = $this->db->query("SELECT id FROM rim_dashboard.dbo.users_rim WHERE username = '".$username."' AND password = '".$password."' ;");
				if($result->num_rows() == 1){
					$this->db->query("UPDATE [dbo].[users_rim] SET last_login = CURRENT_TIMESTAMP WHERE id = ".$result->row(0)->id.";");
					return $result->row(0)->id;
				}else{
					return false;
				}
			}else{
				$result = $this->db->query("SELECT id FROM rim_dashboard.dbo.users_bod WHERE username = '".$username."' AND password = '".$password."' ;");
				if($result->num_rows() == 1){
					$this->db->query("UPDATE [dbo].[users_bod] SET last_login = CURRENT_TIMESTAMP WHERE id = ".$result->row(0)->id.";");
					return $result->row(0)->id;
				}else{
					return false;
				}
			}
		}

		public function get_name($id, $rim = false){
			if($rim == true){
				$result = $this->db->query("SELECT name FROM rim_dashboard.dbo.users_rim WHERE id = ".$id." ;");
				return $result->row_array()['name'];
			}else{
				$result = $this->db->query("SELECT name FROM rim_dashboard.dbo.users_bod WHERE id = ".$id." ;");
				return $result->row_array()['name'];
			}
		}

		public function get_all_bod(){
			$result = $this->db->query("SELECT id, username, name, last_login FROM rim_dashboard.dbo.users_bod");
			$result = $result->result_array();

			return $result;
		}


		public function get_all_rim(){
			$result = $this->db->query("SELECT id, username, name, last_login FROM rim_dashboard.dbo.users_rim");
			$result = $result->result_array();

			return $result;
		}

		public function register($enc_password, $key){
			// User data array
			$name = $this->input->post('name');
			$username = $this->input->post('username');
			$table = null;
			if($key == 1){
				$table = '[users_bod]';
			}else{
				$username = $this->input->post('username').'@rim';
				$table = '[users_rim]';
			}
			//Insert user
			return $this->db->query("INSERT INTO [dbo].".$table." ([name], [username], [password]) VALUES ('".$name."', '".$username."', '".$enc_password."')");
		}

		public function check_username_exist($username, $key){
			$table = null;
			if($key == 1){
				$table = '[dbo].[users_bod]';
			}else{
				$username = $username.'@rim';
				$table = '[dbo].[users_rim]';
			}
			$query = $this->db->query("SELECT * FROM ".$table." WHERE username = '".$username."'");
			if(empty($query->row_array())){
				return true;
			} else{
				return false;
			}
		}

		public function delete($id, $key){
			$table = null;
			if($key == 1){
				$table = '[dbo].[users_bod]';
			}else{
				$table = '[dbo].[users_rim]';
			}
			return $this->db->query("DELETE FROM ".$table." WHERE id = ".$id." ;");
		}

		public function update($enc_password){
			$key = $this->input->post('key');
			$id = $this->input->post('id');
			$username = $this->input->post('username');
			$name = $this->input->post('name');

			$table = null;
			if($key == 1){
				$table = '[dbo].[users_bod]';
			}else{
				$username = $this->input->post('username').'@rim';
				$table = '[dbo].[users_rim]';
			}

			return $this->db->query("UPDATE ".$table." SET [username] = '".$username."' ,[password] = '".$enc_password."' ,[name] = '".$name."' WHERE id = ".$id." ;");
		}

		public function get_user_by_id($id, $key){
			$table = null;
			if($key == 1){
				$table = '[dbo].[users_bod]';
			}else{
				$table = '[dbo].[users_rim]';
			}
			$result = $this->db->query("SELECT * FROM ".$table." WHERE id = ".$id." ;");

			return $result->row_array();
		}
		
		public function check_old_password($old_password){
			$table = null;
			if($this->session->userdata['rim'] == false){
				$table = '[dbo].[users_bod]';
			}else{
				$table = '[dbo].[users_rim]';
			}
			$result = $this->db->query("SELECT password FROM ".$table." WHERE id = ".$this->session->userdata['user_id']." AND password = '".$old_password."';");
			if($result->num_rows() == 1){
				return $result->row(0)->password;
			}else{
				return false;
			}
		}
		
		public function change_password($enc_password){
			$table = null;
			if($this->session->userdata['rim'] == false){
				$table = '[dbo].[users_bod]';
			}else{
				$table = '[dbo].[users_rim]';
			}
			return $this->db->query("UPDATE ".$table." SET password = '".$enc_password."' WHERE id = ".$this->session->userdata['user_id']." ;");
		}
	}