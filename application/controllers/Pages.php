<?php
class Pages extends CI_Controller {
	public function index(){
		if($this->session->userdata['logged_in'] != true ){
			redirect('users/login');
		}
		//Data index
		$data['title'] = 'Risk Management Information System';
		$data['years'] = $this->rbc_model->get_year();

		//Load tampilan index
		$this->load->view('templates/header');
		$this->load->view('pages/index', $data);
	}

	public function notFound(){
		$this->load->view('pages/notFound');
	}

	public function get_month($year){
			$months = $this->rbc_model->get_month($year);

			echo json_encode($months);
	}

	//Function for AJAX
	public function dashboard_show_gauge($month, $year){

		//Score RBC/UW/GAE, tahun dan bulan(3 huruf pertama) dari page
		$rbc_gauge = $this->rbc_model->rbc_sum_score($month, $year);
		$uw_ratio_gauge= $this->leading_risk_indicator_model->uw_ratio_score($month, $year);
		$ga_expense_gauge = $this->ga_expense_model->ga_expense_score($month, $year);

		$rbc_gauge = round($rbc_gauge['score'] * 100, 1);
		$uw_ratio_gauge = round($uw_ratio_gauge['score'] * 100, 1);
		$ga_expense_gauge = round($ga_expense_gauge, 1);

		$data_gauge = array($rbc_gauge, $uw_ratio_gauge, $ga_expense_gauge);

		echo json_encode($data_gauge);
	}

	public function dashboard_show_chart($year){
		//tahunnya bisa dapet dari page(ajax) --> belom
		$rcp_chart = $this->risk_control_plan_model->rcp_progress_chart($year);

		$data_chart = array( round($rcp_chart['done'], 1), round($rcp_chart['in_progress'], 1), round($rcp_chart['not_yet_started'], 1));

		echo json_encode($data_chart);
	}

	public function dashboard_show_bulb($month, $year){
		if($year == 2017 || $year == 2016){
			$bulb_data = $this->investment_risk_limit_model->get_bulb_data($month, $year);
		}else{
			$bulb_data = $this->asset_allocation_model->get_bulb_data($month, $year);
		}

		echo json_encode($bulb_data);
	}

	//gain loss precentages
	public function dashboard_show_prec($week, $month, $year){
		if($year == 2016){
			echo json_encode(array(0,0,0));
		}else {
			$prec_data = $this->unrealized_gain_loss_model->get_gain_loss_prec($week, $month, $year);

			echo json_encode($prec_data);
		}
	}

	// public function testExcel_upload($file_name){

	// 	$file = './assets/uploads/asset_allocation/'.$file_name;
	// 	//load the excel library
	// 	$this->load->library('ExcelLib');
	// 	//read file from path
	// 	$objPHPExcel = PHPExcel_IOFactory::load($file);
	// 	//get only the Cell Collection
	// 	$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

	// 	//extract to a PHP readable array format
	// 	foreach ($cell_collection as $cell) {
	// 	    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
	// 	    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
	// 	    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
	// 	    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
	// 	    if ($row != 1) {
	// 	        $uploads[$row-2][$column] = $data_value;
	// 			// array_push($uploads, $data_value);
	// 			// $this->rbc_model->tes_upload($uploads);
	// 	    }
	// 	}
	// 	$this->rbc_model->tes_upload($uploads);

	// 	//send the data in an array format
	// 	// $data['header'] = $header;
	// 	//$data['values'] = $uploads;
	// 	redirect('rim_dashboard');
	// 	//echo json_encode($uploads);

	// 	  //print_r($uploads);
	// }

}
