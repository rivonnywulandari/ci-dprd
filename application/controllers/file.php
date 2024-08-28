<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_file'));
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
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('file/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_file->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] = "file/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/view',$list);		
		$this->load->view('admin/footer');
	}

	public function filter($offset = NULL)
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 
		$this->breadcrumb->add('Per Kategori ', base_url().'file/filter');

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('file/filter'); 

	    if (!$_POST =="")
			$kategori	= $this->format_data->string($this->input->post('kategori'));
		else
			$kategori 	= $this->session->flashdata('kategori');   
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_file->init_filter($offset,$perpage,$siteurl,$kategori);
        
        $profil['link'] = "file/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 
		$this->breadcrumb->add('Search ', base_url().'file/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_file->init_search();
        
        $profil['link'] = "file/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'file/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_file->init_tanggal();
  
  		$profil['link'] = "file/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'file/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_file->init_add();
        
        $profil['link'] = "file/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'file/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_file->init_edit();
        
        $profil['link'] = "file/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_file->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_file->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_file->init_action();
	}

	public function category()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data File ', base_url().'file/view'); 
		$this->breadcrumb->add('Kategori ', base_url().'file/category');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_file->init_category();
        
        $profil['link'] = "file/view";
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/file/category',$data);		
		$this->load->view('admin/footer');
	}

	public function category_action()
	{
        $data = $this->model_file->init_category_action();
	}
}