<?php
	class KpmmRatios extends CI_Controller{
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->kpmm_ratio_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('kpmmRatios/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->kpmm_ratio_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('actual_capital', 'Actual Capital Score', 'required');
			$this->form_validation->set_rules('min_capital', 'Minimum Capital Score', 'required');
			$this->form_validation->set_rules('kpmm', 'KPMM Integrated Ratio Score', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('kpmmRatios/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$actual_capital = $this->input->post('actual_capital');
				$min_capital = $this->input->post('min_capital');
				$kpmm = $this->input->post('kpmm');

				$score_array = [$actual_capital, $min_capital, $kpmm];
				$component_array = ['1.Actual Capital', '2.Minimum Capital', '3.KPMM Integrated Ratio'];

				for($k = 0; $k < sizeof($score_array); $k++){

					$update_data[$k]['A'] = $component_array[$k];
					$update_data[$k]['B'] = $month;
					$update_data[$k]['C'] = $year;
					$update_data[$k]['D'] = $score_array[$k];
				}

				$this->kpmm_ratio_model->update($update_data);

				redirect('kpmmRatios');
			}
		}

		//AJAX
		public function kpmm_ratio_show_score($month, $year){
			$scores = $this->kpmm_ratio_model->get_kpmm_score($month, $year);

			echo json_encode($scores);
		}

		public function kpmm_ratio_show_chart($component){
			$component_array = ['1.Actual Capital', '2.Minimum Capital', '3.KPMM Integrated Ratio'];
			$component = $component_array[$component - 1];
			$chart_data[0] = $this->kpmm_ratio_model->get_kpmm_chart($component);
			$chart_data[1] = $this->kpmm_ratio_model->get_kpmm_months($component);

			echo json_encode($chart_data);
		}


		public function update($file_name){

			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$file = './assets/uploads/kpmm_ratio/'.$file_name;
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
			// print_r($update_data);
			// die();
			$this->kpmm_ratio_model->update($update_data);

			redirect('kpmmRatios');
		}
	}
