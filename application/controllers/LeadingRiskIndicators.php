<?php
	class LeadingRiskIndicators extends CI_Controller{
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->leading_risk_indicator_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('leadingRiskIndicators/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->leading_risk_indicator_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('uw_ratio', 'Underwriting Ratio Score', 'required');
			$this->form_validation->set_rules('rbc', 'RBC Score', 'required');
			$this->form_validation->set_rules('rbc_sharia', 'RBC Sharia Score', 'required');
			$this->form_validation->set_rules('bond_a', 'Proportion of Bond A Rating Score', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('leadingRiskIndicators/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$uw_ratio = $this->input->post('uw_ratio');
				$rbc = $this->input->post('rbc');
				$rbc_sharia = $this->input->post('rbc_sharia');
				$bond_a = $this->input->post('bond_a');

				$score_array = [$uw_ratio, $rbc, $rbc_sharia, $bond_a];
				$lri_array = ['1. Underwriting Ratio', '2. RBC Convent', '3. RBC Sharia', '4. Proportion of Bond A Rating'];

				for($k = 0; $k < sizeof($score_array); $k++){

					$update_data[$k]['A'] = $lri_array[$k];
					$update_data[$k]['B'] = $month;
					$update_data[$k]['C'] = $year;
					$update_data[$k]['D'] = $score_array[$k];
				}

				$this->leading_risk_indicator_model->update($update_data);

				redirect('leadingRiskIndicators');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/lri/'.$file_name;
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
			$this->leading_risk_indicator_model->update($update_data);

			redirect('leadingRiskIndicators');
		}

		//AJAX
		public function lri_show_gauges($month, $year){
			//uwratio, rbc conv, rbc sharia, bond a
			$gauge_data = $this->leading_risk_indicator_model->get_all_scores($month, $year);

			echo json_encode($gauge_data);
		}

		public function lri_show_chart($lri, $year){
			$lri_array = ['1. Underwriting Ratio', '2. RBC Convent', '3. RBC Sharia', '4. Proportion of Bond A Rating'];
			$lri = $lri_array[$lri - 1];

			$chart_data = $this->leading_risk_indicator_model->get_lri_chart($lri, $year);

			echo json_encode($chart_data);
		}
	}
