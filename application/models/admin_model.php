<?php
	class Admin_model extends CI_Model{
		public function login($username, $password){
			$result = $this->db->query("SELECT id FROM rim_dashboard.dbo.admins WHERE username = '".$username."' AND password = '".$password."' ;");
			if($result->num_rows() == 1){
				return $result->row(0)->id;
			}else{
				return false;
			}
			
		}
		
		public function check_old_password($old_password){
			$result = $this->db->query("SELECT password FROM dbo.admins WHERE id = ".$this->session->userdata['user_id']." AND password = '".$old_password."';");
			if($result->num_rows() == 1){
				return $result->row(0)->password;
			}else{
				return false;
			}
		}
		
		public function change_password($enc_password){
			return $this->db->query("UPDATE dbo.admins SET password = '".$enc_password."' WHERE id = ".$this->session->userdata['user_id']." ;");
		}
	}