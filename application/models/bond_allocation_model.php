<?php
	class Bond_allocation_model extends CI_Model{
		public function get_total_bond($month, $year){
			//DB + MF
			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = 'Total Bond' AND allocation = 'Direct Bond + MF'");
			$result = $query->row_array()['amount'];

			return $result;
		}

		public function get_internal_corp_bond($month, $year){
			//presentase internal corporate bonds
			//corporate non soe, db + mf / totalbond, db+mf
			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = 'Corporate non SOE' AND allocation = 'Direct Bond + MF'");
			$corporate_non_soe = $query->row_array()['amount'];

			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = 'Total Bond' AND allocation = 'Direct Bond + MF'");
			$total = $query->row_array()['amount'];

			$result = ($corporate_non_soe / $total) * 100;

			return round($result, 2);
		}

		public function get_internal_gov_bond($month, $year){
			//presentase internal gov bond + soe
			//sum semua kecuali corporate on soe dan total / total
			$query = $this->db->query("SELECT SUM([amount]) AS sum FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND allocation = 'Direct Bond + MF' AND bond != 'Corporate non SOE' AND bond != 'Total Bond' AND bond != 'Total Investment Portfolio Traditional & SHF'");
			$sum = $query->row_array()['sum'];

			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = 'Total Bond' AND allocation = 'Direct Bond + MF'");
			$total = $query->row_array()['amount'];

			$result = ($sum / $total) * 100;

			return round($result, 2);
		}

		public function get_regulator_corp_bond($month,$year){
			//direct bond, corp non soe + SOE bukan infra / total
			$query = $this->db->query("SELECT SUM([amount]) AS sum FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND allocation = 'Direct Bond' AND bond != 'Government IDR' AND bond!= 'Government USD' AND bond != 'Total Bond' AND bond != 'Total Investment Portfolio Traditional & SHF'");
			$sum = $query->row_array()['sum'];

			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = 'Total Investment Portfolio Traditional & SHF' AND allocation = 'Direct Bond'");
			$total = $query->row_array()['amount'];

			$result = ($sum / $total) * 100;

			return round($result, 2);
		}

		public function get_regulator_gov_bond($month, $year){
			//GOV IDR & USD + SOE infra di db+mf
			$query = $this->db->query("SELECT SUM([amount]) AS sum FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND allocation = 'Direct Bond + MF' AND bond != 'Corporate non SOE' AND bond != 'SOE IDR' AND bond!= 'SOE USD' AND bond != 'Total Bond' AND bond != 'Total Investment Portfolio Traditional & SHF'");
			$sum = $query->row_array()['sum'];

			$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = 'Total Bond' AND allocation = 'Direct Bond + MF'");
			$total = $query->row_array()['amount'];

			$result = ($sum / $total) * 100;

			return round($result, 2);
		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$bond = $update_data[$i]['A'];
				$allocation = $update_data[$i]['B'];
				$month = $update_data[$i]['C'];
				$year = $update_data[$i]['D'];
				$amount = $update_data[$i]['E'];

				$query = $this->db->query("SELECT [amount] FROM [rim_dashboard].[dbo].[bond_allocation] WHERE month = '".$month."' AND year = '".$year."' AND bond = '".$bond."' AND allocation = '".$allocation."';");
				//Jika data tidak ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[bond_allocation] ([bond], [allocation], [month], [year], [amount], created_by, created_at) VALUES ('".$bond."', '".$allocation."', '".$month."', '".$year."', ".$amount.", ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika data sudah ada maka replace
					$this->db->query("UPDATE [dbo].[bond_allocation] SET amount = ".$amount.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE bond = '".$bond."' AND allocation = '".$allocation."' AND month = '".$month."' AND year = '".$year."';");
				}
			}
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[bond_allocation] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function get_month($year){
			$query = $this->db->query("SELECT DISTINCT month FROM [rim_dashboard].[dbo].[bond_allocation] WHERE year = '".$year."' ;");
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
