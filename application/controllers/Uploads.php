<?php
	class Uploads extends CI_Controller{
		public function app_upload(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->load->view('templates/header');
			$this->load->view('uploads/app_upload', array( 'error' => ''));
			$this->load->view('templates/footer');
		}

		public function bulk_upload($error = FALSE){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
				$data['error'] = '';
				$this->load->view('templates/header');
				$this->load->view('uploads/bulk_upload', $data);
				$this->load->view('templates/footer');
			
			
			
		}

		public function download_template(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$this->load->helper('download');
			$path = base_url().'assets/uploads/template.xlsx';
			ob_clean();
			$data = file_get_contents($path); // Read the file's contents
			$name = 'template.xlsx';
			//force_download($name, $data);
			//redirect('uploads/bulk_upload');
		}

		public function redirect_upload(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$table = $this->input->post('table_selection');
			if($table == 'asset_allocation'){
				redirect('assetAllocations/add/');
			}
			if($table == 'bond_a_rating'){
				redirect('bondARatings/add/');
			}
			if($table == 'bond_allocation'){
				redirect('bondAllocations/add');
			}
			if($table == 'unrealized_gain_loss'){
				redirect('unrealizedGainLosses/add');
			}
			// if($table == 'irl'){
			// 	redirect('investmentAssets/add_investment_risk_limit/'.$file_name);
			// }
			if($table == 'lri'){
				redirect('leadingRiskIndicators/add');
			}
			if($table == 'ga_expense'){
				redirect('gaExpenses/add');
			}
			if($table == 'kpmm_ratio'){
				redirect('kpmmRatios/add');
			}
			if($table == 'rbc'){
				redirect('riskBasedCapitals/add');
			}
			if($table == 'rbc_note'){
				redirect('riskBasedCapitals/add_note');
			}
			if($table == 'rcp'){
				redirect('rcpStatus/add');
			}
			if($table == 'rcp_detail'){
				redirect('rcpStatus/add_detail');
			}

			if($table == 'bpp'){
				redirect('bpp/add');
			}
		}

		public function do_upload(){
			if($this->session->userdata['rim'] != true || $this->session->userdata['logged_in'] != true ){
				redirect('rim_dashboard');
			}
			$table = $this->input->post('table_selection');
            $config['upload_path'] = './assets/uploads/'.$table;
            $config['allowed_types'] = 'xls|xlsx';
            $config['remove_spaces'] = true;

            $this->load->library('upload', $config);

			//Jika user tidak memasukkan input table selection
			if($table == ''){
	            $error = array('error' => 'Pilih tabel terlebih dahulu.');

				$this->load->view('templates/header');
				$this->load->view('uploads/bulk_upload', $error);
				$this->load->view('templates/footer');
			}else{
				if ( ! $this->upload->do_upload('userfile')){
	                    $error = array('error' => $this->upload->display_errors());

						$this->load->view('templates/header');
	                    $this->load->view('uploads/bulk_upload', $error);
						$this->load->view('templates/footer');
	            }else{
					$data = array('upload_data' => $this->upload->data());
					$file_name = $data['upload_data']['file_name'];
					if($table == 'asset_allocation'){
						redirect('assetAllocations/update/'.$file_name);
					}
					if($table == 'bond_a_rating'){
						redirect('bondARatings/update/'.$file_name);
					}
					if($table == 'bond_allocation'){
						redirect('bondAllocations/update/'.$file_name);
					}
					if($table == 'unrealized_gain_loss'){
						redirect('unrealizedGainlosses/update/'.$file_name);
					}
					if($table == 'irl'){
						redirect('investmentRiskLimits/update/'.$file_name);
					}
					if($table == 'lri'){
						redirect('leadingRiskIndicators/update/'.$file_name);
					}
					if($table == 'ga_expense'){
						redirect('gaExpenses/update/'.$file_name);
					}
					if($table == 'kpmm_ratio'){
						redirect('kpmmRatios/update/'.$file_name);
					}
					if($table == 'rbc'){
						redirect('riskBasedCapitals/update/'.$file_name);
					}
					if($table == 'rbc_note'){
						redirect('riskBasedCapitals/update_note/'.$file_name);
					}
					if($table == 'rcp'){
						redirect('rcpStatus/update/'.$file_name);
					}
					if($table == 'bpp'){
						redirect('bpp/update/'.$file_name);
					}
					if($table == 'rcp_detail'){
						redirect('rcpStatus/update_detail/'.$file_name);
					}

					redirect('rim_dashboard');
	            }
			}
        }
	}
?>
