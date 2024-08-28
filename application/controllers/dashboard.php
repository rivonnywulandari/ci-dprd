<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('model_list');
        $this->load->model('master');
		$this->load->library('format_login');

		//createFolderFoto
		$this->master->createFolderFoto();

		//createFolderFile
		$this->master->createFolderFile();

		//createFolderFile
		$this->master->createFolderVideo();
		
    }

	public function index()
	{
        $this->breadcrumb->add(' Home ', base_url().'dashboard');
		
		$session_value = $this->session->userdata('mysession');
        $data = $this->model_list->init_profile($session_value);
        
        $data['link'] = 'dashboard'; 

		$this->load->view('admin/header',$data);
		
		$id_group = $data['id_group'];
		
		if ( $id_group == 1)
		{
			$list['user'] = $this->model_public->QueryNumRows("select * from _user where id_group <> 1");
			$this->load->view('admin/content_admin',$list);
		}
		else
		{
			$this->load->view('admin/content');
		}
		
		
		$this->load->view('admin/footer');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */