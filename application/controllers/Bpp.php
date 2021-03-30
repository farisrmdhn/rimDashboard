<?php
	class Bpp extends CI_Controller{
		//Buku Pedoman Perusahaan
		public function dashboard(){
			if($this->session->userdata['logged_in'] != true ){
				redirect('users/login');
			}
			$data['years'] = $this->bpp_model->get_year();

			//View
			$this->load->view('templates/header');
			$this->load->view('bpp/dashboard', $data);
		}

		public function get_month($year){
			$months = $this->bpp_model->get_month($year);

			echo json_encode($months);
		}

		public function add(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->form_validation->set_rules('month', 'Month', 'required');
			$this->form_validation->set_rules('year', 'Year', 'required');
			$this->form_validation->set_rules('bpp', 'BPP', 'required');
			$this->form_validation->set_rules('unit', 'Unit', 'required');
			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('no_sertifikasi', 'No.Sertifikasi', 'required');
			$this->form_validation->set_rules('cek', 'Cek', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('bpp/add');
				$this->load->view('templates/footer');
			}else{
				$month =  $this->input->post('month');
				$year =  $this->input->post('year');
				$bpp = $this->input->post('bpp');
				$unit = $this->input->post('unit');
				$date = $this->input->post('date');
				$no_sertifikasi = $this->input->post('no_sertifikasi');
				$cek = $this->input->post('cek');
				$update_data[0]['A'] = $unit;
				$update_data[0]['B'] = $bpp;
				$update_data[0]['C'] = $date;
				$update_data[0]['D'] = $no_sertifikasi;
				$update_data[0]['E'] = $month;
				$update_data[0]['F'] = $year;
				$update_data[0]['G'] = $cek;

				$this->bpp_model->update($update_data);

				redirect('bpp');
			}
		}

		public function update($file_name){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}

			$file = './assets/uploads/bpp/'.$file_name;
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

			$this->bpp_model->update($update_data);

			redirect('bpp');
		}

		//AJAX
		public function bpp_show_chart($month, $year){
			//bulan dan tahunnya bisa dapet dari page(ajax)
			$chart_data = $this->bpp_model->get_bpp_chart($month, $year);

			echo json_encode($chart_data, JSON_PRETTY_PRINT);
		}

		public function bpp_show_table($unit, $month, $year){
			//bulan dan tahunnya bisa dapet dari page(ajax)
			//yang abis dirubah di JS dirubah lagi ke bentuk awal
			$unit = str_replace('-', ' ', strtoupper($unit));
			$unit = str_replace('DAN' , '&', $unit);
			$unit = str_replace('KOMA' , ',', $unit);
			$table_data = $this->bpp_model->get_bpp_table($unit, $month, $year);

			echo json_encode($table_data);
		}

		public function bpp_show_selector($month, $year){
			$selector_data = $this->bpp_model->get_bpp_distinct_unit($month, $year);

			echo json_encode($selector_data);
		}

		public function bpp_show_sum($month, $year){
			$sum_data = $this->bpp_model->get_all_sum($month, $year);

			echo json_encode($sum_data);
		}
	}
