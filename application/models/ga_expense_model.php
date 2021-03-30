<?php

	class Ga_expense_model extends CI_Model{

		//Rumus G&A Expense
		// ((1 + GA OverUnder Run) / GA Allowable) * 100%
		public function ga_expense_score($month, $year){
			$query1 = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[ga_expense] WHERE [month] = '".$month."' AND [year] = ".$year." AND [component] = 'GA Over/Under Run' ;");
			$ga_over_under = $query1->row_array();

			$query2 = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[ga_expense] WHERE [month] = '".$month."' AND [year] = ".$year." AND [component] = 'GA Allowable' ;");
			$ga_allowable = $query2->row_array();

			//Menghindari division by zero
			if($ga_over_under['score'] == 0){
				return 0;
			}else{
				$result = (1 + $ga_over_under['score'] / $ga_allowable['score']) * 100 ;
			}

			return $result;
		}

		public function ga_amounts($month, $year){
			$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[ga_expense] WHERE [month] = '".$month."' AND [year] = ".$year." ;");
			$query = $query->result_array();
			$result = array();

			foreach ($query as $row) {
				array_push($result, round($row['score'], 2));
			}

			return $result;
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$component = $update_data[$i]['A'];
				$month = $update_data[$i]['B'];
				$year = $update_data[$i]['C'];
				$score = $update_data[$i]['D'];

				$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[ga_expense] WHERE month = '".$month."' AND year = '".$year."' AND component = '".$component."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[ga_expense] ([component], [month], [year], [score], created_by, created_at) VALUES ('".$component."', '".$month."', '".$year."', ".$score.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[ga_expense] SET score = ".$score.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE component = '".$component."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[ga_expense] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[ga_expense] WHERE year = '".$year."' ;");
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
