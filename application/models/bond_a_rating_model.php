<?php
	class Bond_a_rating_model extends CI_Model{
		public function get_actual_value($bond_a, $component, $month, $year){
			//actual = pasar
			$query = $this->db->query("SELECT pasar FROM rim_dashboard.dbo.bond_a_rating WHERE bond_a = '".$bond_a."' AND component = '".$component."' AND month = '".$month."' AND year = '".$year."' ;");
			$result = $query->row_array()['pasar'];

			return $result;
		}

		public function get_unrealized_value($bond_a, $component, $month, $year){
			//unrealized = pasar - beli
			$query = $this->db->query("SELECT beli FROM rim_dashboard.dbo.bond_a_rating WHERE bond_a = '".$bond_a."' AND component = '".$component."' AND month = '".$month."' AND year = '".$year."' ;");
			$query = $query->row_array()['beli'];

			$result = $this->bond_a_rating_model->get_actual_value($bond_a, $component, $month, $year) - $query;

			return $result;
		}

		public function get_score($bond_a, $component, $month, $year){
			//unrealized / beli
			$query = $this->db->query("SELECT beli FROM rim_dashboard.dbo.bond_a_rating WHERE bond_a = '".$bond_a."' AND component = '".$component."' AND month = '".$month."' AND year = '".$year."' ;");
			$query = $query->row_array()['beli'];
			if($query == 0){
				return 0;
			}else{
				$result = round((($this->bond_a_rating_model->get_unrealized_value($bond_a, $component, $month, $year) / $query) * 100), 2);

				return $result;
			}
		}

		public function get_total_bond_a($month, $year){
			//portofolio, DB + MF
			$query = $this->db->query("SELECT SUM(pasar) AS sum FROM rim_dashboard.dbo.bond_a_rating WHERE bond_a = 'Accounting Method' AND month = '".$month."' AND year = '".$year."' ;");
			$result = $query->row_array()['sum'];

			return $result;
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$bond_a = $update_data[$i]['A'];
				$component = $update_data[$i]['B'];
				$month = $update_data[$i]['C'];
				$year = $update_data[$i]['D'];
				$beli = $update_data[$i]['E'];
				$pasar = $update_data[$i]['F'];

				$query = $this->db->query("SELECT [beli] FROM [rim_dashboard].[dbo].[bond_a_rating] WHERE month = '".$month."' AND year = '".$year."' AND bond_a = '".$bond_a."' AND component = '".$component."';");
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[bond_a_rating] ([bond_a], [component], [month], [year], [beli], [pasar], created_by, created_at) VALUES ('".$bond_a."', '".$component."', '".$month."', '".$year."', ".$beli." , ".$pasar.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP);");
				}else{
					$this->db->query("UPDATE [dbo].[bond_a_rating] SET beli = ".$beli.", pasar = ".$pasar.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE bond_a = '".$bond_a."' AND component = '".$component."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[bond_a_rating] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[bond_a_rating] WHERE year = '".$year."' ;");
			$query = $query->result_array();
			$result = array();
			foreach ($query as $row) {
				array_push($result, $row['month']);
			}
			$length = 0;
			for($k = 0; $k < sizeof($result); $k++){
				if($result[$k] == 'Jan'){
					$fix[0]='Jan';
					$length++;
				}
				if($result[$k] == 'Feb'){
					$fix[1]='Feb';
					$length++;
				}
				if($result[$k] == 'Mar'){
					$fix[2]='Mar';
					$length++;
				}
				if($result[$k] == 'Apr'){
					$fix[3]='Apr';
					$length++;
				}
				if($result[$k] == 'May'){
					$fix[4]='May';
					$length++;
				}
				if($result[$k] == 'Jun'){
					$fix[5]='Jun';
					$length++;
				}
				if($result[$k] == 'Jul'){
					$fix[6]='Jul';
					$length++;
				}
					if($result[$k] == 'Aug'){
					$fix[7]='Aug';
					$length++;
				}
				if($result[$k] == 'Sep'){
					$fix[8]='Sep';
					$length++;
				}
				if($result[$k] == 'Oct'){
					$fix[9]='Oct';
					$length++;
				}
				if($result[$k] == 'Nov'){
					$fix[10]='Nov';
					$length++;
				}
				if($result[$k] == 'Dec'){
					$fix[11]='Dec';
					$length++;
				}
			}
			$result = array($fix,$length);
			return $result;
		}


	}
?>
