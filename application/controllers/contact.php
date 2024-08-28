<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_contact'));
		$this->load->library(array('format_login','form_validation'));
		$this->load->helper('tgl_indo'); 
    }

	public function index()
	{
        $this->view();
	}

	public function view($offset = NULL)
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Contact ', base_url().'contact/view'); 

		$perpage = 10;

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_contact->init_view();
        
        $profil['link'] = "contact/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/contact/view',$list);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Contact ', base_url().'contact/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'contact/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_contact->init_edit();
        
        $profil['link'] = "contact/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/contact/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_contact->init_edit_save($username);
	}
}