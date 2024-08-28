<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_display'));
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
		$this->breadcrumb->add('Data Display ', base_url().'display/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('display/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_display->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] =  'display/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/display/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Display ', base_url().'display/view'); 
		$this->breadcrumb->add('Search ', base_url().'display/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_display->init_search();
        
        $profil['link'] =  'display/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/display/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Display ', base_url().'display/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'display/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_display->init_tanggal();
  		
  		$profil['link'] =  'display/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/display/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Display ', base_url().'display/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'display/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_display->init_add();
        
        $profil['link'] =  'display/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/display/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Display ', base_url().'display/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'display/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_display->init_edit();
        
        $profil['link'] =  'display/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/display/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_display->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_display->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_display->init_action();
	}

	public function category()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Display ', base_url().'display/view'); 
		$this->breadcrumb->add('Kategori ', base_url().'display/category');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_display->init_category();
        
        $profil['link'] =  'display/view'; 
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/display/category',$data);		
		$this->load->view('admin/footer');
	}

	public function category_action()
	{
        $data = $this->model_display->init_category_action();
	}
}