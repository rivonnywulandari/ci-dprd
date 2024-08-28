<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('model_account');
        $this->load->model('model_list');
        $this->load->model('model_public');
        $session_value = $this->session->userdata('mysession');
        $this->load->library('form_validation');  	
        $this->load->library('format_login'); 		
    }

	public function index()
	{
		$this->password();
	}

	public function profile()
	{
	    $this->breadcrumb->add(' Home ', base_url().'dashboard');
		$this->breadcrumb->add(' Profil Pengguna ', base_url().'account/profile'); 
		
		$session_value = $this->session->userdata('mysession');
		$data = $this->model_list->init_profile($session_value);
		
		$data['link'] = 'account/profile';

		$this->load->view('admin/header',$data); 
	    $this->load->view('admin/account/profile', $data);
	    $this->load->view('admin/footer');
	}

	public function password()
	{
	    $this->breadcrumb->add(' Home ', base_url().'dashboard');
	    $this->breadcrumb->add(' Profil Pengguna ', base_url().'account/profile'); 
		$this->breadcrumb->add(' Ganti Password ', base_url().'control_user/password'); 
		
		$session_value = $this->session->userdata('mysession');
		$data = $this->model_list->init_profile($session_value);

		$data['link'] = 'account/password';

		$this->load->view('admin/header',$data);      
	    $this->load->view('admin/account/ganti_password');
	    $this->load->view('admin/footer');
	}
	
	public function ganti_password()
	{
		$session_value = $this->session->userdata('mysession');
		$this->model_account->init_ganti_password($session_value);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */