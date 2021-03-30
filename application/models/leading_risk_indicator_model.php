<?php

	class Leading_risk_indicator_model extends CI_Model{

		//hasil masih array, walaupun isinya 1
		public function uw_ratio_score($month, $year){
			$result = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [month] = '".$month."' AND [year] = ".$year." AND [leading_risk_indicator] = '1. Underwriting Ratio' ;");
			return $result->row_array();
		}

		//untuk rcpReport - lri
		public function get_all_scores($month, $year){
			// $query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [month] = '".$month."' AND [year] = '".$year."' ORDER BY id ASC;");
			// $query = $query->result_array();
			// $result = array();
			// foreach ($query as $row){
			// 	array_push($result, round(($row['score'] * 100), 1));
			// }
			// karna berantakan,  cara diatas gabisa

			$uw_ratio = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [month] = '".$month."' AND [year] = ".$year." AND [leading_risk_indicator] = '1. Underwriting Ratio' ;");
			$rbc_conventional = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [month] = '".$month."' AND [year] = ".$year." AND [leading_risk_indicator] = '2. RBC Convent' ;");
			$rbc_sharia = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [month] = '".$month."' AND [year] = ".$year." AND [leading_risk_indicator] = '3. RBC Sharia' ;");
			$bond_a = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [month] = '".$month."' AND [year] = ".$year." AND [leading_risk_indicator] = '4. Proportion of Bond A Rating' ;");

			$uw_ratio = round((($uw_ratio->row_array()['score']) * 100), 1);
			$rbc_conventional = round((($rbc_conventional->row_array()['score']) * 100), 1);
			$rbc_sharia = round((($rbc_sharia->row_array()['score']) * 100), 1);
			$bond_a = round((($bond_a->row_array()['score']) * 100), 1);

			$result = [$uw_ratio, $rbc_conventional, $rbc_sharia, $bond_a];


			return $result;
		}

		public function get_lri_chart($lri, $year){
			$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE [year] = '".$year."' AND [leading_risk_indicator] = '".$lri."';");
			$query = $query->result_array();

			$result = array();
			foreach ($query as $row){
				array_push($result, round(($row['score'] * 100), 1));
			}

			return $result;
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$leading_risk_indicator = $update_data[$i]['A'];
				$month = $update_data[$i]['B'];
				$year = $update_data[$i]['C'];
				$score = $update_data[$i]['D'];

				$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE month = '".$month."' AND year = '".$year."' AND leading_risk_indicator = '".$leading_risk_indicator."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[leading_risk_indicator] ([leading_risk_indicator], [month], [year], [score], created_by, created_at) VALUES ('".$leading_risk_indicator."', '".$month."', '".$year."', ".$score.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[leading_risk_indicator] SET score = ".$score.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE leading_risk_indicator = '".$leading_risk_indicator."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[leading_risk_indicator] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[leading_risk_indicator] WHERE year = '".$year."' ;");
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
