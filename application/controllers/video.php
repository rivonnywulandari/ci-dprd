<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_video'));
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
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('video/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_video->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] = "video/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/view',$list);		
		$this->load->view('admin/footer');
	}

	public function filter($offset = NULL)
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 
		$this->breadcrumb->add('Per Kategori ', base_url().'video/filter');

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('video/filter'); 

	    if (!$_POST =="")
			$kategori	= $this->format_data->string($this->input->post('kategori'));
		else
			$kategori 	= $this->session->flashdata('kategori');   
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_video->init_filter($offset,$perpage,$siteurl,$kategori);
        
        $profil['link'] = "video/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 
		$this->breadcrumb->add('Search ', base_url().'video/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_video->init_search();
        
        $profil['link'] = "video/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'video/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_video->init_tanggal();
  	
  		$profil['link'] = "video/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'video/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_video->init_add();
        
        $profil['link'] = "video/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'video/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_video->init_edit();
        
        $profil['link'] = "video/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_video->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_video->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_video->init_action();
	}

	public function category()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Video ', base_url().'video/view'); 
		$this->breadcrumb->add('Kategori ', base_url().'video/category');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_video->init_category();
        
        $profil['link'] = "video/view";
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/video/category',$data);		
		$this->load->view('admin/footer');
	}

	public function category_action()
	{
        $data = $this->model_video->init_category_action();
	}
}