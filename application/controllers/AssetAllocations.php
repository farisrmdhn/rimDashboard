<?php
	class AssetAllocations extends CI_Controller{
		//views
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->asset_allocation_model->get_year_selector();

			$this->load->view('templates/header');
			$this->load->view('assetAllocations/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->asset_allocation_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('equity', 'Equity Amount', 'required');
			$this->form_validation->set_rules('time_deposit', 'Time Deposit Amount', 'required');
			$this->form_validation->set_rules('bonds', 'Bonds Amount', 'required');
			$this->form_validation->set_rules('mutual_fund', 'Mutual Fund Amount', 'required');
			$this->form_validation->set_rules('mutual_fund2', 'MF(All Underlying Gov Bond) Amount', 'required');
			$this->form_validation->set_rules('direct_investment', 'Direct Investment Amount', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('assetAllocations/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$equity = $this->input->post('equity');
				$time_deposit = $this->input->post('time_deposit');
				$bonds = $this->input->post('bonds');
				$mutual_fund = $this->input->post('mutual_fund');
				$mutual_fund2 = $this->input->post('mutual_fund2');
				$direct_investment = $this->input->post('direct_investment');

				$amount_array = [$equity, $time_deposit, $bonds, $mutual_fund, $mutual_fund2, $direct_investment];
				$asset_array = ['Equity', 'Time Deposit', 'Bonds', 'Mutual Fund', 'Mutual Fund (All underlying Gov bond)', 'Direct Investment'];

				for($k = 0; $k < sizeof($amount_array); $k++){

					$update_data[$k]['A'] = $asset_array[$k];
					$update_data[$k]['B'] = 'value';
					$update_data[$k]['C'] = $month;
					$update_data[$k]['D'] = $year;
					$update_data[$k]['E'] = $amount_array[$k];
				}

				$this->asset_allocation_model->update($update_data);

				redirect('assetAllocations');
			}
		}

		public function add_limit(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('equity', 'Equity Amount', 'required');
			$this->form_validation->set_rules('time_deposit', 'Time Deposit Amount', 'required');
			$this->form_validation->set_rules('bonds', 'Bonds Amount', 'required');
			$this->form_validation->set_rules('mutual_fund', 'Mutual Fund Amount', 'required');
			$this->form_validation->set_rules('direct_investment', 'Direct Investment Amount', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('assetAllocations/add_limit');
				$this->load->view('templates/footer');
			}else{
				$year =  $this->input->post('year');
				$equity = $this->input->post('equity');
				$time_deposit = $this->input->post('time_deposit');
				$bonds = $this->input->post('bonds');
				$mutual_fund = $this->input->post('mutual_fund');
				$direct_investment = $this->input->post('direct_investment');

				$amount_array = [$equity, $time_deposit, $bonds, $mutual_fund, $direct_investment];
				$asset_array = ['Equity', 'Time Deposit', 'Bonds', 'Mutual Fund', 'Direct Investment'];

				for($k = 0; $k < sizeof($amount_array); $k++){

					$update_data[$k]['A'] = $asset_array[$k];
					$update_data[$k]['B'] = 'limit';
					$update_data[$k]['C'] = 'Jan';
					$update_data[$k]['D'] = $year;
					$update_data[$k]['E'] = $amount_array[$k];
				}

				$this->asset_allocation_model->update($update_data);

				redirect('assetAllocations');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/asset_allocation/'.$file_name;
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
			
			$this->asset_allocation_model->update($update_data);

			redirect('assetAllocations');
		}

		//Asset Allocation
		public function ia_aa_show_year(){
			$years = $this->asset_allocation_model->get_year();

			echo json_encode($years);
		}

		public function ia_aa_show_table($month, $year){
			$table_data = $this->asset_allocation_model->get_table_data($month, $year);

			echo json_encode($table_data);
		}
	}