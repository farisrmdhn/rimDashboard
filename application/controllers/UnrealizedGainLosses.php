<?php

	class UnrealizedGainLosses extends CI_Controller{
		//VIEW
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->unrealized_gain_loss_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('unrealizedGainLosses/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->unrealized_gain_loss_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('week', 'Week', 'required');
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('equities_closing', 'Equities - Closing', 'required');
			$this->form_validation->set_rules('equities_actual', 'Equities - Actual', 'required');
			$this->form_validation->set_rules('equities_unrealized', 'Equities - Unrealized', 'required');
			$this->form_validation->set_rules('bonds_closing', 'Bonds - Closing', 'required');
			$this->form_validation->set_rules('bonds_actual', 'Bonds - Actual', 'required');
			$this->form_validation->set_rules('bonds_unrealized', 'Bonds - Unrealized', 'required');
			$this->form_validation->set_rules('mf_closing', 'Mutual Funds - Closing', 'required');
			$this->form_validation->set_rules('mf_actual', 'Mutual Funds - Actual', 'required');
			$this->form_validation->set_rules('mf_unrealized', 'Mutual Funds - Unrealized', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('unrealizedGainLosses/add');
				$this->load->view('templates/footer');
			}else{
				$week =  $this->input->post('week');
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$equities_closing = $this->input->post('equities_closing');
				$equities_actual = $this->input->post('equities_actual');
				$equities_unrealized = $this->input->post('equities_unrealized');
				$bonds_closing = $this->input->post('bonds_closing');
				$bonds_actual = $this->input->post('bonds_actual');
				$bonds_unrealized = $this->input->post('bonds_unrealized');
				$mf_closing = $this->input->post('mf_closing');
				$mf_actual = $this->input->post('mf_actual');
				$mf_unrealized = $this->input->post('mf_unrealized');

				$closing_array = [$bonds_closing, $equities_closing, $mf_closing];
				$actual_array = [$bonds_actual, $equities_actual, $mf_actual];
				$unrealized_array = [$bonds_unrealized, $equities_unrealized, $mf_unrealized];
				$dashboard_array = ['Bonds', 'Equities', 'Mutual Funds'];

				for($k = 0; $k < sizeof($dashboard_array); $k++){

					$update_data[$k]['A'] = $dashboard_array[$k];
					$update_data[$k]['B'] = $week;
					$update_data[$k]['C'] = $month;
					$update_data[$k]['D'] = $year;
					$update_data[$k]['E'] = $closing_array[$k];
					$update_data[$k]['F'] = $actual_array[$k];
					$update_data[$k]['G'] = $unrealized_array[$k];
				}

				$this->unrealized_gain_loss_model->update($update_data);

				redirect('unrealizedGainLosses');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/unrealized_gain_loss/'.$file_name;
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

			$this->unrealized_gain_loss_model->update($update_data);

			redirect('investmentAssets');
		}

		//Unrealized Gain/Loss
		public function ia_uga_show_gauge($week, $month, $year){
			$gauge_data = $this->unrealized_gain_loss_model->get_all_gain_loss($week,$month,$year);

			echo json_encode($gauge_data);
		}

		public function ia_uga_show_bio($week, $month, $year){
			$amounts = $this->unrealized_gain_loss_model->get_all_gain_loss_bio($week, $month, $year);

			echo json_encode($amounts);
		}
	}