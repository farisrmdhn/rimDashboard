<?php

	class InvestmentRiskLimits extends CI_Controller{
		//VIEW
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->investment_risk_limit_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('investmentRiskLimits/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->investment_risk_limit_model->get_month($year);

			echo json_encode($months);
		}

		//Tidak ada fungsi add karena katanya udah gaperlu

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/irl/'.$file_name;
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

			$this->investment_risk_limit_model->update($update_data);

			redirect('investmentRiskLimits');
		}

		//AJAX
		public function ia_irl_show_score($month, $year){
			$scores = $this->investment_risk_limit_model->get_bulb_data($month, $year);

			echo json_encode($scores);
		}

		public function ia_irl_show_chart($component, $year){
			$component_array = ['1. Stock', '2. IDR fixed income', '3. USD exposure', '4. Corporate Bond'];
			$component = $component_array[$component - 1];

			$chart_data = $this->investment_risk_limit_model->get_irl_chart_data($component, $year);

			echo json_encode($chart_data);
		}
	}