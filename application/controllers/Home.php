<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->CI = &get_instance();
		$this->load->model('admin_model', '', TRUE);
		$this->load->library(array('table', 'form_validation'));
		$this->load->helper(array('form', 'form_helper'));
		date_default_timezone_set('Asia/Kolkata');
		ini_set('upload_max_filesize', '20M');
	}


	public function index()
	{
		$data['page_title'] = 'Certificate Verification Portal';
	
		$this->home_template->show('home', $data);
	}

	public function check_certificate() {
        $certificate_number = $this->input->post('certificate_number');  

       
        $certificate = $this->admin_model->get_certificate_by_number($certificate_number);

        if ($certificate) {

            echo json_encode(['status' => 'success', 'data' => $certificate]);
        } else {
            // Certificate not found
            echo json_encode(['status' => 'error', 'message' => 'Invalid Certificate Number!']);
        }
    }
	
}
