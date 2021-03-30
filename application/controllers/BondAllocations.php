<?php
	class BondAllocations extends CI_Controller{
		//views
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->bond_allocation_model->get_year();

			$this->load->view('templates/header');
			$this->load->view('bondAllocations/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->bond_allocation_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('db_1', 'DB - Corporate non SOE', 'required');
			$this->form_validation->set_rules('db_2', 'DB - Government IDR', 'required');
			$this->form_validation->set_rules('db_3', 'DB - Government USD', 'required');
			$this->form_validation->set_rules('db_4', 'DB - SOE IDR', 'required');
			$this->form_validation->set_rules('db_5', 'DB - SOE IDR - Infrastructure', 'required');
			$this->form_validation->set_rules('db_6', 'DB - SOE USD', 'required');
			$this->form_validation->set_rules('db_7', 'DB - SOE USD - Infrastructure', 'required');
			$this->form_validation->set_rules('db_8', 'DB - Total Bond', 'required');
			$this->form_validation->set_rules('db_9', 'DB - Total Investment Portfolio Traditional & SHF', 'required');
			$this->form_validation->set_rules('dbmf_1', 'DB + MF - Corporate non SOE', 'required');
			$this->form_validation->set_rules('dbmf_2', 'DB + MF - Government IDR', 'required');
			$this->form_validation->set_rules('dbmf_3', 'DB + MF - Government USD', 'required');
			$this->form_validation->set_rules('dbmf_4', 'DB + MF - SOE IDR', 'required');
			$this->form_validation->set_rules('dbmf_5', 'DB + MF - SOE IDR - Infrastructure', 'required');
			$this->form_validation->set_rules('dbmf_6', 'DB + MF - SOE USD', 'required');
			$this->form_validation->set_rules('dbmf_7', 'DB + MF - SOE USD - Infrastructure', 'required');
			$this->form_validation->set_rules('dbmf_8', 'DB + MF - Total Bond', 'required');
			$this->form_validation->set_rules('dbmf_9', 'DB + MF - Total Investment Portfolio Traditional & SHF', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('bondAllocations/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				//db -> Direct Bond , dbmf -> direct bond + mutual fund
				$db_1 = $this->input->post('db_1');
				$db_2 = $this->input->post('db_2');
				$db_3 = $this->input->post('db_3');
				$db_4 = $this->input->post('db_4');
				$db_5 = $this->input->post('db_5');
				$db_6 = $this->input->post('db_6');
				$db_7 = $this->input->post('db_7');
				$db_8 = $this->input->post('db_8');
				$db_9 = $this->input->post('db_9');
				$dbmf_1 = $this->input->post('dbmf_1');
				$dbmf_2 = $this->input->post('dbmf_2');
				$dbmf_3 = $this->input->post('dbmf_3');
				$dbmf_4 = $this->input->post('dbmf_4');
				$dbmf_5 = $this->input->post('dbmf_5');
				$dbmf_6 = $this->input->post('dbmf_6');
				$dbmf_7 = $this->input->post('dbmf_7');
				$dbmf_8 = $this->input->post('dbmf_8');
				$dbmf_9 = $this->input->post('dbmf_9');

				$allocation_array = ['Direct Bond', 'Direct Bond + MF'];
				$bond_array = ['Corporate non SOE', 'Government IDR', 'Government USD', 'SOE IDR', 'SOE IDR - Infrastructure', 'SOE USD', 'SOE USD - Infrastructure', 'Total Bond', 'Total Investment Portfolio Traditional & SHF'];
				$amount_array = [$db_1, $db_2, $db_3, $db_4, $db_5, $db_6, $db_7, $db_8, $db_9, $dbmf_1, $dbmf_2, $dbmf_3, $dbmf_4, $dbmf_5, $dbmf_6, $dbmf_7, $dbmf_8, $dbmf_9];

				for($k = 0; $k < 18; $k++){
					if($k < 9){
						$update_data[$k]['B'] = $allocation_array[0];
					}else{
						$update_data[$k]['B'] = $allocation_array[1];
					}

					if($k < 9){
						$update_data[$k]['A'] = $bond_array[$k];
					}else{
						$update_data[$k]['A'] = $bond_array[$k - 9];
					}

					$update_data[$k]['C'] = $month;
					$update_data[$k]['D'] = $year;
					$update_data[$k]['E'] = $amount_array[$k];
				}

				$this->bond_allocation_model->update($update_data);

				redirect('bondAllocations');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/bond_allocation/'.$file_name;
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

			$this->bond_allocation_model->update($update_data);

			redirect('bondAllocations');
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
	}
