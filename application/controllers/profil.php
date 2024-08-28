<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_profil'));
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
		$this->breadcrumb->add('Data Profil ', base_url().'profil/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('profil/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_profil->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] = "profil/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/profil/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Profil ', base_url().'profil/view'); 
		$this->breadcrumb->add('Search ', base_url().'profil/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_profil->init_search();
        
        $profil['link'] = "profil/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/profil/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Profil ', base_url().'profil/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'profil/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_profil->init_tanggal();
  		
  		$profil['link'] = "profil/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/profil/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Profil ', base_url().'profil/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'profil/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_profil->init_add();
        
        $profil['link'] = "profil/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/profil/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Profil ', base_url().'profil/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'profil/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_profil->init_edit();
        
        $profil['link'] = "profil/view";
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/profil/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_profil->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_profil->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_profil->init_action();
	}
}