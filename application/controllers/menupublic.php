<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menupublic extends CI_Controller 
{
  
	public function __construct()
  {  
    parent::__construct();
    $this->load->model(array('model_list','model_menupublic'));
    $this->load->library(array('format_login','form_validation'));
    $this->load->helper('tgl_indo');
  }

  public function index()
  {
    $this->view();
  }


	public function view()
  { 
      $this->breadcrumb->add('Home ', base_url().'dashboard');
      $this->breadcrumb->add('Menu Public ', base_url().'berita/view');     
      
      $session_value = $this->session->userdata('mysession');
      $profil = $this->model_list->init_profile($session_value);
      $list = $this->model_menupublic->init_view();

      $profil['link'] =  'menupublic/view';  
          
      $this->load->view('admin/header',$profil);
      $this->load->view('admin/menupublic/view',$list);   
      $this->load->view('admin/footer');
  }

  public function edit(){
      $id_menu = $this->input->post('id_menu');
      $data = $this->model_menupublic->init_edit($id_menu);
      $this->load->view('admin/menupublic/edit',$data);
  }

  public function add_save()
  {
      $this->model_menupublic->init_add_save();
  }

  public function edit_save()
  {
      $this->model_menupublic->init_edit_save();
  }

  public function delete()
  {
      $this->model_menupublic->init_delete();
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */