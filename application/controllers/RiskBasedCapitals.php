<?php
	class RiskBasedCapitals extends CI_Controller{
		//views
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->rbc_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('riskBasedCapitals/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->rbc_model->get_month($year);
			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('riskBasedCapitals/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');

				$component_array = [/*RBC Convent*/'.RBC', '1. Solvability', '1. Solvability', '1a. Admitted Asset', '1a. Admitted Asset', '1b. Liabilities', '1b. Liabilities', '2. MMBR', '2. MMBR', '2. MMBR', '2. MMBR', '2. MMBR', '2a. Credit Risk', '2a. Credit Risk', '2a. Credit Risk', '2b. Liquidity Risk', '2b. Liquidity Risk', '2c. Market Risk', '2c. Market Risk', '2c. Market Risk', '2d. Insurance Risk', '2d. Insurance Risk', '2d. Insurance Risk', '2d. Insurance Risk', '2e. Operational Risk', '2e. Operational Risk'/*RBC Sharia Tabarru*/, '.RBC', '1. Solvability', '1. Solvability', '1a. Admitted Asset', '1b. Liabilities', '2. MMBR', '2. MMBR', '2. MMBR', '2. MMBR', '2. MMBR', '2a. Credit Risk', '2a. Credit Risk', '2a. Credit Risk', '2b. Liquidity Risk', '2c. Market Risk', '2c. Market Risk', '2c. Market Risk', '2d. Insurance Risk', '2d. Insurance Risk', '2d. Insurance Risk', '2d. Insurance Risk', '2e. Operational Risk'/*RBC Sharia SHF*/, '.RBC', '1. Solvability', '1. Solvability', '1a. Admitted Asset', '1b. Liabilities', '2. MMBR', '2. MMBR', '2. MMBR', '2. MMBR', '2. MMBR', '2a. Credit Risk', '2a. Credit Risk', '2a. Credit Risk', '2b. Liquidity Risk', '2c. Market Risk', '2c. Market Risk', '2c. Market Risk', '2e. Operational Risk'];

				$detail_array = [/*RBC Convent*/'RBC', 'Admittted Asset', 'Liabilities', 'traditional', 'PAYDI', 'traditional', 'PAYDI', 'Credit Risk', 'Liquidity Risk', 'Market Risk', 'Insurance Risk', 'Operational Risk', 'Asset Investment Default Risk', 'Asset Non Investment Default Risk', 'Reinsurance Risk', 'Asset Liability Mismatch Risk', 'Premium Reserve PAYDI', 'Asset Default Risk', 'Currency Mismatch Risk', 'Interest Rate Changes', 'Premium Reserve', 'Unearned Premium Reserve', 'Claim Reserve', 'Catastrophic Reserve', 'Operational Risk', 'Operational Risk PAYDI'/*RBC Sharia Tabarru*/, 'RBC Tabarru', 'Admittted Asset', 'Liabilities', 'Admittted Asset', 'Liabilities', 'Credit Risk', 'Liquidity Risk', 'Market Risk', 'Insurance Risk', 'Operational Risk', 'Asset Investment Default Risk', 'Asset Non Investment Default Risk', 'Reinsurance Risk', 'Asset Liability Mismatch Risk', 'Asset Default Risk', 'Currency Mismatch Risk', 'Interest Rate Changes', 'Premium Reserve', 'Unearned Premium Reserve', 'Claim Reserve', 'Catastrophic Reserve', 'Operational Risk Tabarru'/*RBC Sharia SHF*/, 'RBC SHF', 'Admittted Asset', 'Liabilities', 'Admittted Asset', 'Liabilities', 'Credit Risk', 'Liquidity Risk', 'Market Risk', 'Insurance Risk', 'Operational Risk', 'Asset Investment Default Risk', 'Asset Non Investment Default Risk', 'Reinsurance Risk', 'Asset Liability Mismatch Risk', 'Asset Default Risk', 'Currency Mismatch Risk', 'Interest Rate Changes', 'Operational Risk'];

				$score_array = $this->input->post('score_array');

				// $component_array2 = array();
				// $detail_array2 = array();
				// $score_array2 = array();
				$count = 0;
				for($i = 0; $i < sizeof($score_array); $i++){
					if($score_array[$i] != null){
						// array_push($component_array2, $component_array[$i]);
						// array_push($detail_array2, $detail_array[$i]);
						// array_push($score_array2, $score_array[$i]);

						if($i <= 25){
							$rbc_array[$count] = '1. RBC Conventional';
						}elseif ($i > 25 && $i <= 47) {
							$rbc_array[$count] = '2. RBC Sharia Tabarru';
						}else{
							$rbc_array[$count] = '3. RBC Sharia SHF';
						}
						$component_array2[$count] = $component_array[$i];
						$detail_array2[$count] = $detail_array[$i];
						$score_array2[$count] = $score_array[$i];
						$count++;
					}
				}

				for($k = 0; $k < sizeof($score_array2); $k++){
					$update_data[$k]['A'] = "New Regulation
(since Aug17)";
					$update_data[$k]['B'] = $rbc_array[$k];
					$update_data[$k]['C'] = $component_array2[$k];
					$update_data[$k]['D'] = $detail_array2[$k];
					$update_data[$k]['E'] = $month;
					$update_data[$k]['F'] = $year;
					$update_data[$k]['G'] = $score_array2[$k];	
				}

				$this->rbc_model->update($update_data);

				redirect('riskBasedCapitals');
			}
		}

		public function add_note(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('note', 'Note', 'required');;

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('riskBasedCapitals/add_note');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$note = $this->input->post('note');

				$update_data[0]['A'] = $month;
				$update_data[0]['B'] = $year;
				$update_data[0]['C'] = $note;

				$this->rbc_model->update_note($update_data);

				redirect('riskBasedCapitals');
			}
		}

		public function update($file_name){

			$file = './assets/uploads/rbc/'.$file_name;
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

			$this->rbc_model->update($update_data);

			redirect('riskBasedCapitals');
		}

		public function update_note($file_name){

			$file = './assets/uploads/rbc_note/'.$file_name;
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

			$this->rbc_model->update_note($update_data);

			redirect('riskBasedCapitals');
		}

		//AJAX
		public function rbc_monitoring_show_selector($rbc, $month, $year){//dr parameter - 1
			$rbc_array = ['1. RBC Conventional', '2. RBC Sharia Tabarru', '3. RBC Sharia SHF'];
			$rbc = $rbc_array[$rbc - 1];
			$selector_data = $this->rbc_model->get_distinct_component($rbc, $month, $year);

			echo json_encode($selector_data);
		}

		public function rbc_monitoring_show_score($month, $year, $regulation){
			$rbc_score = $this->rbc_model->rbc_scores($month, $year, $regulation);

			echo json_encode($rbc_score);
		}

		public function rbc_monitoring_show_chart($rbc, $year, $regulation, $component){
			//Balikin format component
			$component = str_replace('-', ' ', $component);
			$component = str_replace('%' , '.', $component);
			//Kalo regulasi ga sesuai
			if($year == '2016'){
				$regulation = 'old';
			}
			if($year == '2018'){
				$regulation = 'new';
			}

			//Dari angka, ke nama kolom rbc di tabel rbc
			//dr parameter - 1
			$rbc_array = ['1. RBC Conventional', '2. RBC Sharia Tabarru', '3. RBC Sharia SHF'];
			if($regulation == 'old'){
				if($rbc > 2){
					$rbc = 1;
				}
			}
			if($rbc > 3){
				$rbc = 1;
			}

			$rbc = $rbc_array[$rbc - 1];

			if($component == '.RBC'){
				$chart_data = $this->rbc_model->rbc_chart($rbc, $year);

			}elseif ($component == '1. Solvability') {
				$chart_data = $this->rbc_model->rbc_chart_solvability($rbc, $year, $regulation);

			}elseif ($component == '1a. Admitted Asset') {
				$chart_data = $this->rbc_model->rbc_chart_admitted_asset($rbc, $year, $regulation);

			}elseif ($component == '1b. Liabilities') {
				$chart_data = $this->rbc_model->rbc_chart_liabilities($rbc, $year, $regulation);

			}elseif ($component == '2. MMBR') {
				$chart_data = $this->rbc_model->rbc_chart_mmbr($rbc, $year, $regulation);

			}elseif ($component == '2a. Credit Risk') {
				$chart_data = $this->rbc_model->rbc_chart_credit_risk($rbc, $year);

			}elseif ($component == '2b. Liquidity Risk') {
				$chart_data = $this->rbc_model->rbc_chart_liquidity_risk($rbc, $year);

			}elseif ($component == '2c. Market Risk') {
				$chart_data = $this->rbc_model->rbc_chart_market_risk($rbc, $year);

			}elseif ($component == '2d. Insurance Risk') {
				$chart_data = $this->rbc_model->rbc_chart_insurance_risk($rbc, $year);

			}elseif ($component == '2e. Operational Risk') {
				$chart_data = $this->rbc_model->rbc_chart_operational_risk($rbc, $year);

			}

			echo json_encode($chart_data);

		}

		public function rbc_monitoring_show_note($month, $year){
			$note = $this->rbc_model->get_note($month, $year);

			echo json_encode($note);
		}
	}
?>
