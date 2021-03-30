<?php
	class Unrealized_gain_loss_model extends CI_Model{

		//dashboard = nama kolom di tabel ugl.
		public function get_dashboard_prec($dashboard, $week, $month, $year){
			$query = $this->db->query("SELECT [closing], [unrealized] FROM [rim_dashboard].[dbo].[unrealized_gain_loss] WHERE [dashboard] = '".$dashboard."' AND [component] = '".$week."' AND [month] = '".$month."' AND [year] = '".$year."';");
			$closing = $query->row_array()['closing'];
			$unrealized = $query->row_array()['unrealized'];

			if($closing == 0){
				return 0;
			}else{
				$result = round((($unrealized / $closing) * 100), 2);

				return $result;
			}
		}
		
		public function prec_color($prec){
			if($prec >= 0){
				$color = 'green';
			}elseif($prec >= -5 && $prec < 0){
				$color = 'orange';
			}else{
				$color = 'red';
			}

			return $color;
		}

		public function get_gain_loss_prec($week, $month, $year){
			$equities = $this->unrealized_gain_loss_model->get_dashboard_prec('Equities', $week, $month, $year) + 0;
			$bonds = $this->unrealized_gain_loss_model->get_dashboard_prec('Bonds', $week, $month, $year) + 0;
			$mutual_funds = $this->unrealized_gain_loss_model->get_dashboard_prec('Mutual Funds', $week, $month, $year) + 0;

			$equities_color = $this->unrealized_gain_loss_model->prec_color($equities);
			$bonds_color = $this->unrealized_gain_loss_model->prec_color($bonds);
			$mutual_funds_color = $this->unrealized_gain_loss_model->prec_color($mutual_funds);


			return array($bonds, $equities, $mutual_funds, $bonds_color, $equities_color, $mutual_funds_color);
		}

		public function get_all_gain_loss($week, $month, $year){
			$dashboards = ['Equities', 'Bonds', 'Mutual Funds'];

			$result = array();

			for($i = 0; $i < sizeof($dashboards); $i++){
				array_push($result, $this->unrealized_gain_loss_model->get_dashboard_prec($dashboards[$i], $week, $month, $year));
			}

			// $query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[unrealized_gain_loss] WHERE [component] = '".$week."' AND [month] = '".$month."' AND [year] = '".$year."';");
			// $query = $query->result_array();
			//
			// $result = array();
			// foreach ($query as $row){
			// 	array_push($result, substr($row['score'], 0, -1));
			// }

			return $result;

		}

		public function get_all_gain_loss_bio($week, $month, $year){
			$query = $this->db->query("SELECT [dashboard], [actual], [unrealized] FROM [rim_dashboard].[dbo].[unrealized_gain_loss] WHERE component = '".$week."' AND month = '".$month."' AND year = '".$year."' ;");
			$query = $query->result_array();

			$result = array();

			foreach ($query as $row) {
				$result[$row['dashboard']] = [round(($row['actual'] / 1000000000), 2), round(($row['unrealized'] / 1000000000), 2)];
			}

			return $result;
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$dashboard = $update_data[$i]['A'];
				$component = $update_data[$i]['B'];
				$month = $update_data[$i]['C'];
				$year = $update_data[$i]['D'];
				$closing = $update_data[$i]['E'];
				$actual = $update_data[$i]['F'];
				$unrealized = $update_data[$i]['G'];

				$query = $this->db->query("SELECT [closing] FROM [rim_dashboard].[dbo].[unrealized_gain_loss] WHERE month = '".$month."' AND year = '".$year."' AND component = '".$component."' AND dashboard = '".$dashboard."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[unrealized_gain_loss] ([dashboard], [component], [month], [year], [closing], [actual], [unrealized], created_by, created_at) VALUES ('".$dashboard."', '".$component."', '".$month."', '".$year."', ".$closing." , ".$actual.", ".$unrealized.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[unrealized_gain_loss] SET closing = ".$closing.", actual = ".$actual.", unrealized = ".$unrealized.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE dashboard = '".$dashboard."' AND component = '".$component."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[unrealized_gain_loss] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[unrealized_gain_loss] WHERE year = '".$year."' ;");
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
