<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transportasi extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_transportasi'));
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
		$this->breadcrumb->add('Data Transportasi ', base_url().'transportasi/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('transportasi/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_transportasi->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] =  'transportasi/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/transportasi/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Transportasi ', base_url().'transportasi/view'); 
		$this->breadcrumb->add('Search ', base_url().'transportasi/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_transportasi->init_search();
        
        $profil['link'] =  'transportasi/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/transportasi/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Transportasi ', base_url().'transportasi/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'transportasi/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_transportasi->init_tanggal();
  		
  		$profil['link'] =  'transportasi/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/transportasi/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Transportasi ', base_url().'transportasi/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'transportasi/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_transportasi->init_add();
        
        $profil['link'] =  'transportasi/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/transportasi/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Transportasi ', base_url().'transportasi/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'transportasi/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_transportasi->init_edit();
        
        $profil['link'] =  'transportasi/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/transportasi/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_transportasi->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_transportasi->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_transportasi->init_action();
	}

	public function category()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Transportasi ', base_url().'transportasi/view'); 
		$this->breadcrumb->add('Kategori ', base_url().'transportasi/category');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_transportasi->init_category();
        
        $profil['link'] =  'transportasi/view'; 
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/transportasi/category',$data);		
		$this->load->view('admin/footer');
	}

	public function category_action()
	{
        $data = $this->model_transportasi->init_category_action();
	}
}