<?php
	class RcpStatus extends CI_Controller{

		public function index(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->risk_control_plan_model->get_year();

			//View
			$this->load->view('templates/header');
			$this->load->view('rcpStatus/index', $data);
		}

		public function detail(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->risk_control_plan_model->get_year_detail();

			//View
			$this->load->view('templates/header');
			$this->load->view('rcpStatus/detail', $data);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('done[]', 'All Done Amount', 'required');
			$this->form_validation->set_rules('in_progress[]', 'All In Progress Amount', 'required');
			$this->form_validation->set_rules('not_yet_started[]', 'All Not yet started Amount', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('rcpStatus/add');
				$this->load->view('templates/footer');
			}else{
				$year =  $this->input->post('year');
				$done = $this->input->post('done');
				$in_progress = $this->input->post('in_progress');
				$not_yet_started = $this->input->post('not_yet_started');
				$risk_categories = ['1. Board Management Risk', '2. Governance Risk', '3. Strategy Risk', '4. Operational Risk', '5. Assets & Liabilities Risk', '6. Insurance Risk', '7. Risk of Financial Support (Capital Funding)', '8. Integrated Risk Management'];

				for($k = 0; $k < sizeof($risk_categories); $k++){
					$update_data[$k]['A'] = $year;
					$update_data[$k]['B'] = $risk_categories[$k];
					$update_data[$k]['C'] = $done[$k];
					$update_data[$k]['D'] = $in_progress[$k];
					$update_data[$k]['E'] = $not_yet_started[$k];
				}

				$this->risk_control_plan_model->update($update_data);

				redirect('rcpStatus');
			}
		}

		public function add_detail(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('risk', 'Risk', 'required');
			$this->form_validation->set_rules('project_task', 'Project Task', 'required');
			$this->form_validation->set_rules('task_owner', 'Task Owner', 'required');
			$this->form_validation->set_rules('est_complete_date', 'Est. Complete Date', 'required');
			$this->form_validation->set_rules('actual_complete_date', 'Actual Complete Date', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('comment', 'Status', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('rcpStatus/add_detail');
				$this->load->view('templates/footer');
			}else{
				$year =  $this->input->post('year');
				$risk =  $this->input->post('risk');
				$project_task =  $this->input->post('project_task');
				$task_owner =  $this->input->post('task_owner');
				$est_complete_date =  $this->input->post('est_complete_date');
				$actual_complete_date =  $this->input->post('actual_complete_date');
				$status =  $this->input->post('status');
				$comment =  $this->input->post('comment');

				$update_data[0]['A'] = $risk;
				$update_data[0]['B'] = $project_task;
				$update_data[0]['C'] = $task_owner;
				$update_data[0]['D'] = $est_complete_date;
				$update_data[0]['E'] = $actual_complete_date;
				$update_data[0]['F'] = $status;
				$update_data[0]['G'] = $comment;
				$update_data[0]['H'] = $year;

				$this->risk_control_plan_model->update_detail($update_data);

				redirect('rcpStatus/detail');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/rcp/'.$file_name;
			//load the excel library
			$this->load->library('ExcelLib');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
			    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
			    if ($row != 1) {
			        $update_data[$row-2][$column] = $data_value;
			    }
			}

			$this->risk_control_plan_model->update($update_data);

			redirect('rcpStatus');
		}

		public function update_detail($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/rcp_detail/'.$file_name;
			//load the excel library
			$this->load->library('ExcelLib');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
			    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
			    if ($row != 1) {
			        $update_data[$row-2][$column] = $data_value;
			    }
			}

			$this->risk_control_plan_model->update_detail($update_data);

			redirect('rcpStatus/detail');
		}

		public function edit_detail($id){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('comment', 'Status', 'required');

			$data['detail'] = $this->risk_control_plan_model->get_rcp_detail($id);

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('rcpStatus/edit_detail', $data);
				$this->load->view('templates/footer');
			}else{

				$this->risk_control_plan_model->edit_detail($id);

				redirect('rcpStatus/detail');
			}
		}

		//ajax
		public function rcp_status_show_table($year){
			//tahunnya bisa dapet dari page(ajax)
			$data_table = $this->risk_control_plan_model->rcp_status_table($year);

			echo json_encode($data_table);
		}

		public function rcp_detail_show_table($year){
			//tahunnya bisa dapet dari page(ajax)
			$data_table = $this->risk_control_plan_model->rcp_detail_table($year);

			echo json_encode($data_table);
		}
	}
