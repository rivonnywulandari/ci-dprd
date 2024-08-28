<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_artikel'));
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
		$this->breadcrumb->add('Data Artikel ', base_url().'artikel/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('artikel/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_artikel->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] = "artikel/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/artikel/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Artikel ', base_url().'artikel/view'); 
		$this->breadcrumb->add('Search ', base_url().'artikel/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_artikel->init_search();
        
        $profil['link'] = "artikel/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/artikel/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Artikel ', base_url().'artikel/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'artikel/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_artikel->init_tanggal();
  
  		$profil['link'] = "artikel/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/artikel/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Artikel ', base_url().'artikel/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'artikel/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_artikel->init_add();
        
        $profil['link'] = "artikel/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/artikel/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Artikel ', base_url().'artikel/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'artikel/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_artikel->init_edit();
        
        $profil['link'] = "artikel/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/artikel/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_artikel->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_artikel->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_artikel->init_action();
	}

	public function category()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Artikel ', base_url().'artikel/view'); 
		$this->breadcrumb->add('Kategori ', base_url().'artikel/category');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_artikel->init_category();
        
        $profil['link'] = "artikel/view";
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/artikel/category',$data);		
		$this->load->view('admin/footer');
	}

	public function category_action()
	{
        $data = $this->model_artikel->init_category_action();
	}
}