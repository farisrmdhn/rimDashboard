<?php
	class Bpp_model extends CI_Model{
		public function get_sum_of_cek($unit, $month, $year){
			$query = $this->db->query("SELECT SUM([cek]) AS sum_of_cek FROM [rim_dashboard].[dbo].[bpp] WHERE unit = '".$unit."' AND month = '".$month."' AND year = '".$year."';");
			return $query->row_array()['sum_of_cek'] + 0;
		}

		public function get_all_sum($month, $year){
			$query = $this->db->query("SELECT SUM([cek]) AS sum FROM [rim_dashboard].[dbo].[bpp] WHERE month = '".$month."' AND year = '".$year."';");
			return $query->row_array()['sum'] + 0;
		}

		//hasil
		// unit  | sum  |
		// CCHU  | 1    |
		//dst
		public function get_bpp_chart($month,$year){
			$query = $this->db->query("SELECT DISTINCT [unit] FROM [rim_dashboard].[dbo].[bpp] WHERE [month] = '".$month."' AND [year] = '".$year."';");
			$unit = array();
			for($i = 0;$i < sizeof($query->result_array()); $i++){
				array_push($unit, $query->result_array()[$i]['unit']);
			}
			$sum = array();
			for($i = 0;$i < sizeof($query->result_array()); $i++){
				array_push($sum, $this->bpp_model->get_sum_of_cek($unit[$i], $month, $year));
			}
			$result = array();
			for($i = 0;$i < sizeof($sum); $i++){
				array_push($result, array(
					'unit' => $unit[$i],
					'sum' =>$sum[$i]
				));
				// array_push($result, $unit[$i]);
				// array_push($result, $sum[$i]);
			}

			return $result;

		}

		//hasil
		//bpp | no_sertifikasi
		// x  | xxxxxxx.xxxxx
		public function get_bpp_table($unit, $month,$year){
			$query = $this->db->query("SELECT [bpp], [no_sertifikasi] FROM [rim_dashboard].[dbo].[bpp] WHERE [unit] = '".$unit."' AND [month] = '".$month."' AND [year] = '".$year."';");
			return $query->result_array();
		}

		public function get_bpp_distinct_unit($month, $year){
			$query = $this->db->query("SELECT DISTINCT [unit] FROM [rim_dashboard].[dbo].[bpp] WHERE [month] = '".$month."' AND [year] = '".$year."';");
			return $query->result_array();
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$unit = $update_data[$i]['A'];
				$bpp = $update_data[$i]['B'];
				$date = $update_data[$i]['C'];
				$no_sertifikasi = $update_data[$i]['D'];
				$month = $update_data[$i]['E'];
				$year = $update_data[$i]['F'];
				$cek = $update_data[$i]['G'];

				$this->db->query("INSERT INTO [dbo].[bpp] ([unit], [bpp], [date], [no_sertifikasi], [month], [year], [cek], created_by, created_at) VALUES ('".$unit."', '".$bpp."', '".$date."', '".$no_sertifikasi."', '".$month."' , '".$year."', ".$cek.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[bpp] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[bpp] WHERE year = '".$year."' ;");
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
