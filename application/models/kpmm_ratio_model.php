<?php
	class Kpmm_ratio_model extends CI_Model{

		public function get_kpmm_score($month, $year){
			$query = $this->db->query("SELECT [score], component FROM [rim_dashboard].[dbo].[kpmm_ratio] WHERE month = '".$month."' AND year = '".$year."';");
			$query = $query->result_array();
			$result = array();
			foreach ($query as $row) {
				if($row['component'] == '3.KPMM Integrated Ratio'){
					array_push($result, $row['score'] * 100);
					
				}else{
					array_push($result, round($row['score'], 2));
				}
				//array_push($result, $row['score']);
			}
			return $result;
		}

		public function get_kpmm_chart($component){
			$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[kpmm_ratio] WHERE component = '".$component."';");
			$query = $query->result_array();
			$result = array();
			if($component == '3.KPMM Integrated Ratio'){
				foreach ($query as $row) {
					array_push($result, $row['score'] * 100);
				}
			}else{
				foreach ($query as $row) {
					array_push($result, $row['score']);
				}
			}

			return $result;
		}

		public function get_kpmm_months($component){
			$query = $this->db->query("SELECT [month], [year] FROM [rim_dashboard].[dbo].[kpmm_ratio] WHERE component = '".$component."';");
			$query = $query->result_array();
			$months = array();
			foreach ($query as $row) {
				$period = $row['month'].'-'.substr($row['year'], 2, 2);
				array_push($months, $period);
			}
			$result = array();
			for($i = (sizeof($months) - 12); $i < sizeof($months); $i++){
				array_push($result, $months[$i]);
			}

			return $result;
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$component = $update_data[$i]['A'];
				$month = $update_data[$i]['B'];
				$year = $update_data[$i]['C'];
				$score = $update_data[$i]['D'];

				$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[kpmm_ratio] WHERE month = '".$month."' AND year = '".$year."' AND component = '".$component."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[kpmm_ratio] ([component], [month], [year], [score], created_by, created_at) VALUES ('".$component."', '".$month."', '".$year."', ".$score.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[kpmm_ratio] SET score = ".$score.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE component = '".$component."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[kpmm_ratio] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[kpmm_ratio] WHERE year = '".$year."' ;");
			$query = $query->result_array();
			$result = array();
			foreach ($query as $row) {
				array_push($result, $row['month']);
			}
			$length = 0;
			for($k = 0; $k < sizeof($result); $k++){
				if($result[$k] == 'Mar'){
					$fix[0]='Mar';
					$length++;
				}
				if($result[$k] == 'Jun'){
					$fix[1]='Jun';
					$length++;
				}
				if($result[$k] == 'Sep'){
					$fix[2]='Sep';
					$length++;
				}
				if($result[$k] == 'Dec'){
					$fix[3]='Dec';
					$length++;
				}
			}
			$result = array($fix,$length);
			return $result;
		}


	}
 ?>
