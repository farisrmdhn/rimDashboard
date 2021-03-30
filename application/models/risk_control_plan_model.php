<?php

	class Risk_control_plan_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		//hasil rcp_progress_chart(year)
		//stat  | % |
		//done	|	|
		//inpro |   |
		//notyet|   |
		public function rcp_progress_chart($year){
			$query = $this->db->query('SELECT [tahun], [done], [in_progress], [not_yet_started] FROM [rim_dashboard].[dbo].[risk_control_plan] WHERE [tahun] = '.$year.';');
			$all_rcp = $query->result_array();
			$done = 0;
			$in_progress = 0;
			$not_yet_started = 0;

			foreach($all_rcp as $row_rcp){
				$done += $row_rcp['done'];
				$in_progress += $row_rcp['in_progress'];
				$not_yet_started += $row_rcp['not_yet_started'];
			}

			$total = $done + $in_progress + $not_yet_started;

			$done = ($done / $total) * 100;
			$in_progress = ($in_progress / $total) * 100;
			$not_yet_started = ($not_yet_started / $total) * 100;

			$result = array(
					'done' => $done,
					'in_progress' => $in_progress,
					'not_yet_started' => $not_yet_started
				);

			return $result;
		}

		public function rcp_status_table($year){
			$query = $this->db->query('SELECT * FROM [rim_dashboard].[dbo].[risk_control_plan] WHERE [tahun] = '.$year.';');
			$all_rcp = $query->result_array();
			$result = array();

			foreach($all_rcp as $row_rcp){
				$total = 0 + $row_rcp['done'] + $row_rcp['in_progress'] + $row_rcp['not_yet_started'];
				$status_precentage = round(($row_rcp['done'] / $total) * 100);
				array_push($result, array(
					'risk_category' => substr($row_rcp['risk_category'], 3),
					'status_precentage' => $status_precentage,
					'status_string' => $row_rcp['done'].' of '.$total
				));

			}

			return $result;

		}

		public function update($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$tahun = $update_data[$i]['A'];
				$risk_category = $update_data[$i]['B'];
				$done = $update_data[$i]['C'];
				$in_progress = $update_data[$i]['D'];
				$not_yet_started = $update_data[$i]['E'];

				$query = $this->db->query("SELECT [done] FROM [rim_dashboard].[dbo].[risk_control_plan] WHERE tahun = '".$tahun."' AND risk_category = '".$risk_category."';");
				//Jika data belum ada maka buat baru
				if(sizeof($query->result_array()) < 1){
					$this->db->query("INSERT INTO [dbo].[risk_control_plan] ([tahun], [risk_category], [done], [in_progress], [not_yet_started], created_by, created_at) VALUES ('".$tahun."', '".$risk_category."', '".$done."', '".$in_progress."', '".$not_yet_started."', ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");
				}else{
				//Jika sudah ada maka replace
					$this->db->query("UPDATE [dbo].[risk_control_plan] SET done = ".$done.", in_progress = ".$in_progress.", not_yet_started = ".$not_yet_started.", created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE tahun = '".$tahun."' AND risk_category = '".$risk_category."';");
				}
			}
		}

		public function update_detail($update_data){
			for($i = 0;$i<sizeof($update_data);$i++){
				$risk = $update_data[$i]['A'];
				$project_task = $update_data[$i]['B'];
				$task_owner = $update_data[$i]['C'];
				$est_complete_date = $update_data[$i]['D'];
				$actual_complete_date = $update_data[$i]['E'];
				$status = $update_data[$i]['F'];
				$comment = $update_data[$i]['G'];
				$year = $update_data[$i]['H'];

				$this->db->query("INSERT INTO [dbo].[annual_rcp] ([risk], [project_task], [task_owner], [est_complete_date], [actual_complete_date], status, comment, year, created_by, created_at) VALUES ('".$risk."', '".$project_task."', '".$task_owner."', '".$est_complete_date."', '".$actual_complete_date."', '".$status."', '".$comment."', '".$year."', ".$this->session->userdata['user_id'].", CURRENT_TIMESTAMP)");								
			}
		}

		public function edit_detail($id){
			$actual_complete_date = $this->input->post('actual_complete_date');
			$status = $this->input->post('status');
			$comment = $this->input->post('comment');
			return $this->db->query("UPDATE [dbo].[annual_rcp] SET actual_complete_date = '".$actual_complete_date."', status = '".$status."', comment = '".$comment."', created_by = ".$this->session->userdata['user_id'].", created_at = CURRENT_TIMESTAMP WHERE id = ".$id.";");
		}

		public function get_year(){
			$query = $this->db->query("SELECT DISTINCT [tahun] FROM [rim_dashboard].[dbo].[risk_control_plan] ORDER BY tahun;");
			$result = $query->result_array();

			return $result;
		}

		public function get_year_detail(){
			$query = $this->db->query("SELECT DISTINCT [year] FROM [rim_dashboard].[dbo].[annual_rcp] ORDER BY year;");
			$result = $query->result_array();

			return $result;
		}

		public function rcp_detail_table($year){
			$query = $this->db->query("SELECT * FROM [rim_dashboard].[dbo].[annual_rcp] WHERE [year] = '".$year."';");
			$all_rcp = $query->result_array();
			$result = array();

			foreach($all_rcp as $row_rcp){
				array_push($result, array(
					'id' => $row_rcp['id'],
					'risk' => $row_rcp['risk'],
					'project_task' => $row_rcp['project_task'],
					'task_owner' => str_replace('(and)', ', ', $row_rcp['task_owner']),
					'est_complete_date' => $row_rcp['est_complete_date'],
					'actual_complete_date' => $row_rcp['actual_complete_date'],
					'status' => $row_rcp['status'],
					'comment' => $row_rcp['comment']
				));

			}

			return $result;
		}

		public function get_rcp_detail($id){
			$query = $this->db->query("SELECT * FROM [rim_dashboard].[dbo].[annual_rcp] WHERE [id] = '".$id."';");
			$result = $query->row_array();

			return $result;
		}

	}
