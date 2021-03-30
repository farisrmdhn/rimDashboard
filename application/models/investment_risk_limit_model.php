<?php
	class Investment_risk_limit_model extends CI_Model{

		//Get data per component from query
		public function get_component_data($component, $month, $year){
			//Score
			$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE [component] = '".$component."' AND [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->row_array();
			$score = $query['score'] + 0; // Biar jadi int

			//Precentage
			$query = $this->db->query("SELECT SUM([score]) AS sum FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->row_array();

			$total_score = $query['sum'] + 0; // Biar jadi int

			if($total_score == 0){
				$prec = $total_score;
			}else{
				//Dibuletin jadi 1 angka belakang koma
				$prec = round((($score / $total_score) * 100), 1);
			}

			//Limit
			$query = $this->db->query("SELECT [limit] FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE [component] = '".$component."' AND [month] = '".$month."' AND [year] = '".$year."';");
			$query = $query->row_array();
			$limit = $query['limit'] + 0;

			//Bulb color( score > limit = red, yellow <= score < red)
			$yellow = ($limit * 90) / 100;

			//tahun 2018 keatas limitnya dibandingin sama presentase
			if(($year == 2016) || ($year == 2017)){
				if($score > $limit){
					$color = 'red';
				}elseif (($score >= $yellow) and ($score < $limit)){
					$color = 'orange';
				}else{
					$color = 'green';
				}
			}else{
				//diatas 2018
				$prec2 = $prec / 100;
				if($prec2 > $limit){
					$color = 'red';
				}elseif (($prec2 >= $yellow) and ($prec2 < $limit)){
					$color = 'orange';
				}else{
					$color = 'green';
				}
			}


			$result = array(
				$score, $prec, $color
			);

			return $result;
		}

		public function get_bulb_data($month, $year){
			//stock = stock score, idr = idr fixed income score, dst...
			//tahun 2016 & 2017 component-nya ada yg beda dengan 2018 dst
			//compo 1 = stock, compo 2 = IDR FI / Time Deposit, compo 3 = USD Ex / Bonds, compo 4 = corpor bond / mutual funds
			//ini juga buat investment assets - irl

			$compo1 = $this->investment_risk_limit_model->get_component_data('1. Stock', $month, $year);

			if(($year == 2016) || ($year == 2017)){
				$compo2 = $this->investment_risk_limit_model->get_component_data('2. IDR fixed income', $month, $year);
				$compo3 = $this->investment_risk_limit_model->get_component_data('3. USD exposure', $month, $year);
				$compo4 = $this->investment_risk_limit_model->get_component_data('4. Corporate Bond', $month, $year);
			}else{
				$compo2 = $this->investment_risk_limit_model->get_component_data('2. Time Deposit', $month, $year);
				$compo3 = $this->investment_risk_limit_model->get_component_data('3. Bonds', $month, $year);
				$compo4 = $this->investment_risk_limit_model->get_component_data('4. Mutual Fund', $month, $year);
			}

			$result = array(
				$compo1, $compo2, $compo3, $compo4
			);

			return $result;
		}

		public function get_irl_chart_data($component, $year){
			$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE [component] = '".$component."' AND [year] = '".$year."' ORDER BY id ASC;");
			$query = $query->result_array();$result = array();
			$result =  array();
			foreach ($query as $row) {
				array_push($result, $row['score'] + 0);
			}

			return $result;
		}

		public function update($update_data){
			$limit_name = 'limit';
			for($i = 0;$i<sizeof($update_data);$i++){
				$component = $update_data[$i]['A'];
				$month = $update_data[$i]['B'];
				$year = $update_data[$i]['C'];
				$limit = $update_data[$i]['D'];
				$score = $update_data[$i]['E'];

				$query = $this->db->query("SELECT [score] FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE month = '".$month."' AND year = '".$year."' AND component = '".$component."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[investment_risk_limit] ([component], [month], [year], [limit], [score], created_by, created_at) VALUES ('".$component."', '".$month."', '".$year."', ".$limit." , ".$score.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[investment_risk_limit] SET score = ".$score.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE component = '".$component."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE year != '2018' ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[investment_risk_limit] WHERE year = '".$year."' ;");
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
