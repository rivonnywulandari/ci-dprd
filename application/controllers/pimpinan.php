<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_pimpinan'));
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
		$this->breadcrumb->add('Data Pimpinan ', base_url().'pimpinan/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('pimpinan/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_pimpinan->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] = "pimpinan/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/pimpinan/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Pimpinan ', base_url().'pimpinan/view'); 
		$this->breadcrumb->add('Search ', base_url().'pimpinan/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_pimpinan->init_search();
        
        $profil['link'] = "pimpinan/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/pimpinan/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Pimpinan ', base_url().'pimpinan/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'pimpinan/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_pimpinan->init_tanggal();
  		
  		$profil['link'] = "pimpinan/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/pimpinan/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Pimpinan ', base_url().'pimpinan/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'pimpinan/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_pimpinan->init_add();
        
        $profil['link'] = "pimpinan/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/pimpinan/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Pimpinan ', base_url().'pimpinan/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'pimpinan/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_pimpinan->init_edit();
        
        $profil['link'] = "pimpinan/view";
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/pimpinan/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_pimpinan->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_pimpinan->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_pimpinan->init_action();
	}
}