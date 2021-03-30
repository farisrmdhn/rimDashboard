<?php
	class BondARatings extends CI_Controller{
		//views
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->bond_a_rating_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('bondARatings/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->bond_a_rating_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('beli_afs', 'AFS - Beli', 'required');
			$this->form_validation->set_rules('beli_trd', 'TRD - Beli', 'required');
			$this->form_validation->set_rules('beli_htm', 'HTM - Beli', 'required');
			$this->form_validation->set_rules('beli_db', 'Direct Bond - Beli', 'required');
			$this->form_validation->set_rules('beli_mf', 'Mutual Fund - Beli', 'required');
			$this->form_validation->set_rules('pasar_afs', 'AFS - Pasar', 'required');
			$this->form_validation->set_rules('pasar_trd', 'TRD - Pasar', 'required');
			$this->form_validation->set_rules('pasar_htm', 'HTM - Pasar', 'required');
			$this->form_validation->set_rules('pasar_db', 'Direct Bond - Pasar', 'required');
			$this->form_validation->set_rules('pasar_mf', 'Mutual Fund - Pasar', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('bondARatings/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$beli_afs = $this->input->post('beli_afs');
				$beli_trd = $this->input->post('beli_trd');
				$beli_htm = $this->input->post('beli_htm');
				$beli_db = $this->input->post('beli_db');
				$beli_mf = $this->input->post('beli_mf');
				$pasar_afs = $this->input->post('pasar_afs');
				$pasar_trd = $this->input->post('pasar_trd');
				$pasar_htm = $this->input->post('pasar_htm');
				$pasar_db = $this->input->post('pasar_db');
				$pasar_mf = $this->input->post('pasar_mf');

				$beli_array = [$beli_afs, $beli_trd, $beli_htm, $beli_db, $beli_mf];
				$pasar_array = [$pasar_afs, $pasar_trd, $pasar_htm, $pasar_db, $pasar_mf];
				$bond_a_array = ['Accounting Method', 'Portofolio'];
				$component_array = ['AFS', 'TRD', 'HTM', 'Direct Bond', 'Mutual Fund'];

				for($k = 0; $k < sizeof($beli_array); $k++){
					if($k < 3){
						$update_data[$k]['A'] = $bond_a_array[0];
					}else{
						$update_data[$k]['A'] = $bond_a_array[1];
					}

					$update_data[$k]['B'] = $component_array[$k];
					$update_data[$k]['C'] = $month;
					$update_data[$k]['D'] = $year;
					$update_data[$k]['E'] = $beli_array[$k];
					$update_data[$k]['F'] = $pasar_array[$k];
				}

				$this->bond_a_rating_model->update($update_data);

				redirect('bondARatings');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/bond_a_rating/'.$file_name;
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

			$this->bond_a_rating_model->update($update_data);

			redirect('bondARatings');
		}

		//Bond Allocation
		public function ia_ba_show_chart($month, $year){
			$internal_corp = $this->bond_allocation_model->get_internal_corp_bond($month, $year);
			$internal_gov = $this->bond_allocation_model->get_internal_gov_bond($month, $year);
			$chart_data = [$internal_corp, $internal_gov];

			echo json_encode($chart_data);
		}

		public function ia_ba_show_gauge($month, $year){
			$regulator_corp = $this->bond_allocation_model->get_regulator_corp_bond($month, $year);
			$regulator_gov = $this->bond_allocation_model->get_regulator_gov_bond($month, $year);
			$chart_data = [$regulator_corp, $regulator_gov];

			echo json_encode($chart_data);
		}

		//Bond Rating A
		public function ia_bra_show_gauge($month, $year){
			$bond_a = $this->bond_a_rating_model->get_total_bond_a($month, $year);
			$total_bond = $this->bond_allocation_model->get_total_bond($month, $year);
			if($total_bond == 0){
				$prec = 0;
			}else{
				$prec = ($bond_a / $total_bond) * 100;
				$prec = round($prec, 2);
			}


			$gauge_data = [round(($bond_a / 1000000000), 2), round(($total_bond / 1000000000), 2), $prec];

			echo json_encode($gauge_data);
		}

		public function ia_bra_show_chart($bond_a, $year){
			//1 -> acc meth, 2 -> portofolio
			$bond_a_array = ['Accounting Method', 'Portofolio'];

			$components = [];
			//Menentukan component tergantung bond_a nya
			if($bond_a == 1){
				$components = ['AFS', 'TRD', 'HTM'];
			}else{
				$components = ['Direct Bond', 'Mutual Fund'];
			}

			//Convert dari angka jadi nama(bond_a)
			$bond_a = $bond_a_array[$bond_a -1];

			//Array Bulan
			$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

			$chart_data = [];
			//Memasukkan data ke array, score dari masing2 setiap bulan selama setahun
			for($i = 0; $i < sizeof($components); $i++){
				for($j = 0; $j < sizeof($months); $j++){
					$data = $this->bond_a_rating_model->get_score($bond_a, $components[$i], $months[$j], $year);
					$chart_data[$components[$i]][$months[$j]] = $data + 0;
				}
			}

			echo json_encode($chart_data);
		}

		public function ia_bra_show_score($bond_a, $month, $year){
			//1 -> acc meth, 2 -> portofolio
			$bond_a_array = ['Accounting Method', 'Portofolio'];

			$components = [];
			//Menentukan component tergantung bond_a nya
			if($bond_a == 1){
				$components = ['AFS', 'TRD'];
			}else{
				$components = ['Direct Bond', 'Mutual Fund'];
			}

			//Convert dari angka jadi nama(bond_a)
			$bond_a = $bond_a_array[$bond_a -1];

			//Mendapatkan data actual value dan dimasukan ke array
			$score1 = $this->bond_a_rating_model->get_actual_value($bond_a, $components[0], $month, $year);
			$score2 = $this->bond_a_rating_model->get_actual_value($bond_a, $components[1], $month, $year);

			$actual_value = [round(($score1 / 1000000000), 2), round(($score2 / 1000000000), 2)];

			//Mendapatkan data unrealized dan dimasukan ke array
			$score1 = $this->bond_a_rating_model->get_unrealized_value($bond_a, $components[0], $month, $year);
			$score2 = $this->bond_a_rating_model->get_unrealized_value($bond_a, $components[1], $month, $year);

			$unrealized_value = [round(($score1 / 1000000000), 2), round(($score2 / 1000000000), 2)];

			$scores = array(
				'actual' => $actual_value,
				'unrealized' => $unrealized_value
			);

			echo json_encode($scores);
		}
	}