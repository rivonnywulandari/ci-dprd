<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model(array('model_list','model_module'));
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
		$this->breadcrumb->add('Data Module ', base_url().'module/view'); 

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('module/view');    
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_module->init_view($offset,$perpage,$siteurl);
       	
       	$profil['link'] = 'module/view'; 

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/module/view',$list);		
		$this->load->view('admin/footer');
	}

	public function filter($offset = NULL)
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Module ', base_url().'module/view'); 
		$this->breadcrumb->add('Per Group ', base_url().'module/filter');

		$perpage = 10;

		if(is_null($offset) == TRUE)        
            $offset  = $this->uri->segment(3,0);
	    $siteurl = site_url('module/filter'); 

	    if (!$_POST =="")
			$id_group	= $this->format_data->string($this->input->post('id_group'));
		else
			$id_group 	= $this->session->flashdata('id_group');   
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $list = $this->model_module->init_filter($offset,$perpage,$siteurl,$id_group);
        
        $profil['link'] = 'module/view';

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/module/view',$list);		
		$this->load->view('admin/footer');
	}

	public function search()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Module ', base_url().'module/view'); 
		$this->breadcrumb->add('Search ', base_url().'module/search');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_module->init_search();
        
		$profil['link'] = 'module/view';

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/module/view',$data);		
		$this->load->view('admin/footer');
	}

	public function tanggal()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Module ', base_url().'module/view'); 
		$this->breadcrumb->add('Pertanggal ', base_url().'module/tanggal');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_module->init_tanggal();
  		
  		$profil['link'] = 'module/view';

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/module/view',$data);		
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Module ', base_url().'module/view'); 
		$this->breadcrumb->add('Tambah ', base_url().'module/add');  
		
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_module->init_add();
        
		$profil['link'] = 'module/view';

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/module/add',$data);		
		$this->load->view('admin/footer');
	}

	public function edit()
	{
		$this->breadcrumb->add('Home ', base_url().'dashboard');
		$this->breadcrumb->add('Data Module ', base_url().'module/view'); 
		$this->breadcrumb->add('Ubah ', base_url().'module/ubah');  

		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $data = $this->model_module->init_edit();
        
		$profil['link'] = 'module/view';

		$this->load->view('admin/header',$profil);
		$this->load->view('admin/module/edit',$data);		
		$this->load->view('admin/footer');
	}	

	public function add_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_module->init_add_save($username);
	}

	public function edit_save()
	{
		$session_value = $this->session->userdata('mysession');
        $profil = $this->model_list->init_profile($session_value);
        $username = $profil['username'];
		$this->model_module->init_edit_save($username);
	}

	public function action()
	{
        $data = $this->model_module->init_action();
	}
}