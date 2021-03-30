<?php
	class Asset_allocation_model extends CI_Model{
		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[asset_allocation];");
			$query = $query->result_array();
			$result = array();
			foreach ($query as $row) {
				array_push($result, $row['year']);
			}

			return $result;
		}

		public function get_component_data($asset, $month, $year){
			//Score
			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[asset_allocation] WHERE [aset] = '".$asset."' AND [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->row_array();
			$score = $query['amount'] + 0; // Biar jadi int

			//Precentage
			$query = $this->db->query("SELECT SUM([amount]) AS sum FROM [rim_dashboard].[dbo].[asset_allocation] WHERE [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->row_array();

			$total_score = $query['sum'] + 0; // Biar jadi int

			if($total_score == 0){
				$prec = $total_score;
			}else{
				//Dibuletin jadi 1 angka belakang koma
				$prec = round((($score / $total_score) * 100), 1);
			}

			//Limit
			if($asset == 'Equity'){
				$limit = 20;
			}elseif($asset == 'Time Deposit'){
				$limit = 20;
			}elseif($asset == 'Bonds'){
				$limit = 55;
			}else{
				$limit = 50;
			}

			//Bulb color( score > limit = red, yellow <= score < red)
			$yellow = ($limit * 90) / 100;

			//tahun 2018 keatas limitnya dibandingin sama presentase
			if($prec > $limit){
				$color = 'red';
			}elseif (($prec >= $yellow) and ($prec < $limit)){
				$color = 'orange';
			}else{
				$color = 'green';
			}

			$result = array(
				round(($score / 1000000000), 2), $prec, $color
			);

			return $result;
		}

		public function get_bulb_data($month, $year){
			$asset1 = $this->asset_allocation_model->get_component_data('Equity', $month, $year);
			$asset2 = $this->asset_allocation_model->get_component_data('Time Deposit', $month, $year);
			$asset3 = $this->asset_allocation_model->get_component_data('Bonds', $month, $year);
			$asset4 = $this->asset_allocation_model->get_component_data('Mutual Fund', $month, $year);

			$result = array(
				$asset1, $asset2, $asset3, $asset4
			);

			return $result;
		}

		public function get_amount($asset, $month, $year){
			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[asset_allocation] WHERE aset= '".$asset."' AND month = '".$month."' AND year = '".$year."' AND component = 'value';");
			$result = $query->row_array()['amount'];

			return $result;
		}

		public function get_prec($asset, $month, $year){
			$query = $this->db->query("SELECT SUM([amount]) AS sum FROM [rim_dashboard].[dbo].[asset_allocation] WHERE month = '".$month."' AND year = '".$year."' AND component = 'value';");
			$total = $query->row_array()['sum'];
			$amount = $this->asset_allocation_model->get_amount($asset, $month, $year);
			$result = ($amount / $total) * 100;

			return $result;
		}

		public function get_table_data($month, $year){
			$assets = ['Time Deposit', 'Bonds', 'Mutual Fund', 'Equity'];
			$amounts = array();
			for($i = 0; $i < sizeof($assets); $i++){
				//dibagi 1 bio, round 2 angka
				$amount = $this->asset_allocation_model->get_amount($assets[$i], $month, $year);
				$amounts[$assets[$i]] = round(($amount / 1000000000), 2);
			}
			$precs = array();
			for($i = 0; $i < sizeof($assets); $i++){
				//round 2 angka
				$prec = $this->asset_allocation_model->get_prec($assets[$i], $month, $year);
				$precs[$assets[$i]] = round($prec, 2);
			}

			$result = array(
				$assets[0] => [$amounts[$assets[0]], $precs[$assets[0]]],
				$assets[1] => [$amounts[$assets[1]], $precs[$assets[1]]],
				$assets[2] => [$amounts[$assets[2]], $precs[$assets[2]]],
				$assets[3] => [$amounts[$assets[3]], $precs[$assets[3]]]
			);

			return $result;
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$aset = $update_data[$i]['A'];
				$component = $update_data[$i]['B'];
				$month = $update_data[$i]['C'];
				$year = $update_data[$i]['D'];
				$amount = $update_data[$i]['E'];

				$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[asset_allocation] WHERE month = '".$month."' AND year = '".$year."' AND component = '".$component."' AND aset = '".$aset."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[asset_allocation] ([aset], [component], [month], [year], [amount], created_by, created_at) VALUES ('".$aset."', '".$component."', '".$month."', '".$year."', ".$amount.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[asset_allocation] SET amount = ".$amount.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE aset = '".$aset."' AND component = '".$component."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year_selector(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[asset_allocation] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[asset_allocation] WHERE year = '".$year."' ;");
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
