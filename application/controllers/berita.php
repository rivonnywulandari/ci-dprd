<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_berita'));
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
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('berita/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_berita->init_view($offset,$perpage,$siteurl);
        
        $profil['link'] = "berita/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/view',$list);		
		$this->load->view('admin/footer');
	}

	public function filter($offset = NULL)
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 
		$this->breadcrumb->add('Per Kategori ', base_url().'berita/filter');

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('berita/filter'); 

	    if (!$_POST =="")
			$kategori	= $this->format_data->string($this->input->post('kategori'));
		else
			$kategori 	= $this->session->flashdata('kategori');   
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_berita->init_filter($offset,$perpage,$siteurl,$kategori);
        
        $profil['link'] = "berita/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 
		$this->breadcrumb->add('Search ', base_url().'berita/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_berita->init_search();
        
        $profil['link'] = "berita/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'berita/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_berita->init_tanggal();
  		
  		$profil['link'] = "berita/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'berita/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_berita->init_add();
        
        $profil['link'] = "berita/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'berita/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_berita->init_edit();
        
        $profil['link'] = "berita/view";

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_berita->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_berita->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_berita->init_action();
	}

	public function category()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Berita ', base_url().'berita/view'); 
		$this->breadcrumb->add('Kategori ', base_url().'berita/category');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_berita->init_category();
        
        $profil['link'] = "berita/view";
        
		$this->load->view('admin/header',$profil);
		$this->load->view('admin/berita/category',$data);		
		$this->load->view('admin/footer');
	}

	public function category_action()
	{
        $data = $this->model_berita->init_category_action();
	}
}