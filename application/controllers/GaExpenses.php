<?php
	class GaExpenses extends CI_Controller{
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->rbc_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('gaExpenses/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->ga_expense_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('ga_allowable', 'GA Allowable Score', 'required');
			$this->form_validation->set_rules('ga_actual', 'GA Actual Score', 'required');
			$this->form_validation->set_rules('ga_ou_run', 'Ga Over/Under Run Score', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('gaExpenses/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$ga_allowable = $this->input->post('ga_allowable');
				$ga_actual = $this->input->post('ga_actual');
				$ga_ou_run = $this->input->post('ga_ou_run');

				$score_array = [$ga_allowable, $ga_actual, $ga_ou_run];
				$component_array = ['GA Allowable', 'GA Actual', 'GA Over/Under Run'];

				for($k = 0; $k < sizeof($score_array); $k++){

					$update_data[$k]['A'] = $component_array[$k];
					$update_data[$k]['B'] = $month;
					$update_data[$k]['C'] = $year;
					$update_data[$k]['D'] = $score_array[$k];
				}

				$this->ga_expense_model->update($update_data);

				redirect('gaExpenses');
			}
		}

		//AJAX
		public function ga_expense_monitoring_show_gauge($month, $year){

			//Score RBC/UW/GAE, tahun dan bulan(3 huruf pertama) dari page
			$ga_expense_gauge = $this->ga_expense_model->ga_expense_score($month, $year);

			$ga_expense_gauge = round($ga_expense_gauge, 2);

			$gauge_data = $ga_expense_gauge;

			echo json_encode($gauge_data);
		}

		public function ga_expense_monitoring_show_amounts($month, $year){
			$amounts = $this->ga_expense_model->ga_amounts($month, $year);

			echo json_encode($amounts);
		}

		//fungsi update pada kontroler ini dipisah per tabel
		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/ga_expense/'.$file_name;
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

			$this->ga_expense_model->update($update_data);

			redirect('gaExpenses');
		}
	}
