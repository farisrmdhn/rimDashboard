<?php
	class Rbc_model extends CI_Model{
		//Hasil masih array, walaupun cuman 1
		//Ini buat yg di dashboard
		public function rbc_sum_score($month, $year){
			$result = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[rbc] WHERE [month] = '".$month."' AND [year] = ".$year." AND [detail] = 'RBC';");
			return $result->row_array();
		}

		public function rbc_score($rbc, $component, $month, $year, $detail = FALSE){
			if($detail == FALSE){
				$result = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[rbc] WHERE [rbc] = '".$rbc."' AND [component_rbc] = '".$component."' AND [month] = '".$month."' AND [year] = '".$year."';");

				return floatval($result->row_array()['score']);
			}else{
				$result = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[rbc] WHERE [rbc] = '".$rbc."' AND [component_rbc] = '".$component."' AND [month] = '".$month."' AND [year] = '".$year."' AND [detail] = '".$detail."';");

				return floatval($result->row_array()['score']);
			}

		}

		public function rbc_scores($month, $year, $regulation){
			$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[rbc] WHERE [component_rbc] = '.RBC' AND [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->result_array();
			$score1 = round((($query[0]['score'] + 0) * 100), 1);
			$score2 = round((($query[1]['score'] + 0) * 100), 1);
			$result = [$score1, $score2];
			if($regulation == 'new'){
				$score3 = round((($query[2]['score'] + 0) * 100), 1);
				$result = [$score1, $score2, $score3];
			}


			return $result;
		}

		public function get_distinct_component($rbc, $month, $year){
			$query = $this->db->query("SELECT DISTINCT [component_rbc] FROM [rim_dashboard].[dbo].[rbc] WHERE [rbc] = '".$rbc."' AND [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->result_array();
			$result = array();
			for($i = 0; $i < sizeof($query); $i++){
				array_push($result, $query[$i]['component_rbc']);
			}
			return $result;
		}

		//Untuk component .RBC
		public function rbc_chart($rbc, $year){
			$component = '.RBC';
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			$result = array();
			for($i = 0; $i < sizeof($month); $i++){
				array_push($result, ($this->rbc_model->rbc_score($rbc, $component, $month[$i], $year) * 100));
				//$result[$month[$i]] = array($this->rbc_model->rbc_score($rbc, $component, $month[$i], $year));
			}
			return $result;
		}

		//Component solvability (total Assets & total Liability)
		public function rbc_chart_solvability($rbc, $year, $regulation){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($regulation == 'old'){
				if($year == 2017){
					$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
				}
				$result = array();
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '1. Solvability', $month[$i], $year, 'Total Asset'),
						$this->rbc_model->rbc_score($rbc, '1. Solvability', $month[$i], $year, 'Total Liability')
					);
				}
			}elseif ($regulation == 'new') {
				if($year == 2017){
					$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				}
				$result = array();
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '1. Solvability', $month[$i], $year, 'Admittted Asset'),
						$this->rbc_model->rbc_score($rbc, '1. Solvability', $month[$i], $year, 'Liabilities')
					);
				}
			}else{
				return 0;
			}

			return $result;
		}

		//Admitted Asset
		public function rbc_chart_admitted_asset($rbc, $year, $regulation){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($regulation == 'old'){
				if($year == 2017){
					$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
				}
				$result = array();
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '1a. Admitted Asset', $month[$i], $year, 'Investment'),
						$this->rbc_model->rbc_score($rbc, '1a. Admitted Asset', $month[$i], $year, 'Non Investment')
					);
				}
			}elseif ($regulation == 'new') {
				if($year == 2017){
					$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				}
				$result = array();
				if($rbc == '2. RBC Sharia Tabarru' || $rbc == '3. RBC Sharia SHF'){
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '1a. Admitted Asset', $month[$i], $year, 'Admitted Asset')
						);
					}
				}else{
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '1a. Admitted Asset', $month[$i], $year, 'traditional'),
							$this->rbc_model->rbc_score($rbc, '1a. Admitted Asset', $month[$i], $year, 'PAYDI')
						);
					}
				}
			}else{
				return 0;
			}

			return $result;
		}

		//Liabilities
		public function rbc_chart_liabilities($rbc, $year, $regulation){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($regulation == 'old'){
				if($year == 2017){
					$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
				}
				$result = array();
				if($rbc == '1. RBC Conventional'){
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Estimated claim liabilities'),
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Future policy benefits'),
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Unearned premium')
						);
					}
				}else{
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Contribution reserve'),
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Unrealized contribution'),
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Claim  reserves')
						);
					}
				}
			}elseif ($regulation == 'new') {
				if($year == 2017){
					$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				}
				$result = array();
				if($rbc == '2. RBC Sharia Tabarru' || $rbc == '3. RBC Sharia SHF'){
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'Liabilities')
						);
					}
				}else{
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'traditional'),
							$this->rbc_model->rbc_score($rbc, '1b. Liabilities', $month[$i], $year, 'PAYDI')
						);
					}
				}
			}else{
				return 0;
			}

			return $result;
		}

		//MMBR
		public function rbc_chart_mmbr($rbc, $year, $regulation){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($regulation == 'old'){
				if($year == 2017){
					$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
				}
				$result = array();
				if($rbc == '1. RBC Conventional'){
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule A'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule B'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule C'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule D'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule E'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule F'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule G'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule H')
						);
					}
				}else{
					for($i = 0; $i < sizeof($month); $i++){
						$result[$month[$i]] = array(
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule A'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule B'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule C'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule D'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule E'),
							$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Schedule F')
						);
					}
				}
			}elseif ($regulation == 'new') {
				if($year == 2017){
					$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
				}
				$result = array();
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Credit Risk'),
						$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Liquidity Risk'),
						$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Market Risk'),
						$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Insurance Risk'),
						$this->rbc_model->rbc_score($rbc, '2. MMBR', $month[$i], $year, 'Operational Risk')
					);
				}
			}else{
				return 0;
			}

			return $result;
		}

		//Hanya di new regulation
		//Credit Risk
		public function rbc_chart_credit_risk($rbc, $year){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($year == 2017){
				$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			}
			$result = array();
			for($i = 0; $i < sizeof($month); $i++){
				$result[$month[$i]] = array(
					$this->rbc_model->rbc_score($rbc, '2a. Credit Risk', $month[$i], $year, 'Asset Investment Default Risk'),
					$this->rbc_model->rbc_score($rbc, '2a. Credit Risk', $month[$i], $year, 'Asset Non Investment Default Risk'),
					$this->rbc_model->rbc_score($rbc, '2a. Credit Risk', $month[$i], $year, 'Reinsurance Risk')
				);
			}
			return $result;
		}

		//Liquidity Risk
		public function rbc_chart_liquidity_risk($rbc, $year){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($year == 2017){
				$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			}
			$result = array();
			if($rbc == '1. RBC Conventional'){
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '2b. Liquidity Risk', $month[$i], $year, 'Asset Liability Mismatch Risk'),
						$this->rbc_model->rbc_score($rbc, '2b. Liquidity Risk', $month[$i], $year, 'Premium Reserve PAYDI')
					);
				}
			}else{
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '2b. Liquidity Risk', $month[$i], $year, 'Asset Liability Mismatch Risk')
					);
				}
			}
			return $result;
		}

		//Market Risk
		public function rbc_chart_market_risk($rbc, $year){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($year == 2017){
				$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			}
			$result = array();
			for($i = 0; $i < sizeof($month); $i++){
				$result[$month[$i]] = array(
					$this->rbc_model->rbc_score($rbc, '2c. Market Risk', $month[$i], $year, 'Asset Default Risk'),
					$this->rbc_model->rbc_score($rbc, '2c. Market Risk', $month[$i], $year, 'Currency Mismatch Risk'),
					$this->rbc_model->rbc_score($rbc, '2c. Market Risk', $month[$i], $year, 'Interest Rate Changes')
				);
			}
			return $result;
		}

		//Insurance Risk - Gaada di Sharia SHF eliminasi di controller
		public function rbc_chart_insurance_risk($rbc, $year){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($year == 2017){
				$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			}
			$result = array();
			for($i = 0; $i < sizeof($month); $i++){
				$result[$month[$i]] = array(
					$this->rbc_model->rbc_score($rbc, '2d. Insurance Risk', $month[$i], $year, 'Premium Reserve'),
					$this->rbc_model->rbc_score($rbc, '2d. Insurance Risk', $month[$i], $year, 'Unearned Premium Reserve '),
					$this->rbc_model->rbc_score($rbc, '2d. Insurance Risk', $month[$i], $year, 'Claim Reserve'),
					$this->rbc_model->rbc_score($rbc, '2d. Insurance Risk', $month[$i], $year, 'Catastrophic Reserve')
				);
			}
			return $result;
		}

		//Operational Risk
		public function rbc_chart_operational_risk($rbc, $year){
			$month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if($year == 2017){
				$month = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			}
			$result = array();
			if($rbc == '1. RBC Conventional'){
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '2e. Operational Risk', $month[$i], $year, 'Operational Risk'),
						$this->rbc_model->rbc_score($rbc, '2e. Operational Risk', $month[$i], $year, 'Operational Risk PAYDI')
					);
				}
			}elseif($rbc == '2. RBC Sharia Tabarru'){
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '2e. Operational Risk', $month[$i], $year, 'Operational Risk Tabarru')
					);
				}
			}else {
				for($i = 0; $i < sizeof($month); $i++){
					$result[$month[$i]] = array(
						$this->rbc_model->rbc_score($rbc, '2e. Operational Risk', $month[$i], $year, 'Operational Risk')
					);
				}
			}
			return $result;
		}

		public function get_note($month, $year){
			$result = $this->db->query("SELECT [note] FROM [rim_dashboard].[dbo].[rbc_note] WHERE [month] = '".$month."' AND [year] = ".$year.";");
			return $result->row_array();
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$regulation = $update_data[$i]['A'];
				$rbc = $update_data[$i]['B'];
				$component_rbc = $update_data[$i]['C'];
				$detail = $update_data[$i]['D'];
				$month = $update_data[$i]['E'];
				$year = $update_data[$i]['F'];
				$score = $update_data[$i]['G'];

				$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[rbc] WHERE month = '".$month."' AND year = '".$year."' AND component_rbc = '".$component_rbc."' AND rbc = '".$rbc."' AND detail = '".$detail."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[rbc] ([regulation], [rbc], [component_rbc], [detail], [month], [year], [score], created_by, created_at) VALUES ('".$regulation."', '".$rbc."', '".$component_rbc."', '".$detail."', '".$month."', '".$year."', '".$score."', ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[rbc] SET score = ".$score.", created_by= ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE rbc = '".$rbc."' AND component_rbc = '".$component_rbc."' AND detail = '".$detail."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function update_note($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$month = $update_data[$i]['A'];
				$year = $update_data[$i]['B'];
				$note = $update_data[$i]['C'];

				$query = $this->db->query("SELECT [note] FROM [rim_dashboard].[dbo].[rbc_note] WHERE month = '".$month."' AND year = '".$year."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[rbc_note] ([month], [year], [note], created_by, created_at) VALUES ('".$month."', '".$year."', '".$note."', ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[rbc_note] SET note = '".$note."', created_by= ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[rbc] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[rbc] WHERE year = '".$year."' ;");
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
