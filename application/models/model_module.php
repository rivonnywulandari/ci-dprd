<?php

class Model_module extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('_module')->num_rows();
        $config['per_page'] = $perpage;
        $config['num_links'] = 5;   
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '← Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
      
        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM _module
                                                                ORDER BY _module.id_module desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['null'] = "tidak ada data !!!";
        return $data;
    }

    public function init_search()
    {  
        $cari = $this->format_data->string($this->input->post('cari'));

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM _module
                                                                WHERE module_key like '%$cari%'
                                                                or  module_name like '%$cari%'
                                                                limit 100                                                         
                                                                ");

        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data <b>".$cari."</b> tidak ditemukan !!!";   
        return $data;
    }

    public function init_add()
    {
        $data['module_key']   = $this->session->flashdata('module_key');                        
        $data['module_name']  = $this->session->flashdata('module_name');                                    
        
        return $data;
    }

    public function init_edit()
    {
        $id_module = $this->format_data->string($this->uri->segment(3,0));
        $module =  $this->model_public->QuerySingleValue("SELECT * FROM _module WHERE id_module='$id_module'"); 
        
        if ($module)     
            $data['data'] = $module;
        else
            redirect ('module/view');
                        
        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('module_key', 'module key', 'required'); 
        $this->form_validation->set_rules('module_name', 'module name', 'required');  
        $this->model_public->conv_validasi_to_indonesia();  
        if($this->form_validation->run() == FALSE)
        {
            $status_property['parameter'] = $action;
            $status_property['message'] = validation_errors();
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('module/'.$action.'/'.$id);         
        }    
    }

    public function init_add_save($modulename)
    {
        $module_key  = $this->format_data->string($this->input->post('module_key'));
        $module_name = $this->format_data->string($this->input->post('module_name'));
        $aktif      = $this->input->post('aktif',TRUE);

        if($aktif)
          $aktif = '1';
        else
          $aktif = '0';

        //flashdata
        $setdata    = array('module_key'=>$module_key,'module_name'=>$module_name);
        $this->master->dataflash($setdata);

        //validate
        $this->validate('add','');

        $module = $this->model_public->QuerySingleValue("SELECT max(id_module) as id_max from _module");
        $id_module = $module->id_max + 1;    
        
        $data = array(
            'id_module' => $id_module,
            'module_key' => $module_key,
            'module_name' => $module_name,
            'aktif' => $aktif
        );

        $this->db->trans_start();   
        $this->db->insert('_module',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'edit';
            $status_property['url_process'] = base_url().'module/edit/'.$id_module;
            $this->model_public->messaga_status_user($status_property);
            redirect('module/view/');
        }
        
        
    }

    public function init_edit_save($modulename)
    {
        //validate
        $this->validate('edit',$this->input->post('id_module')); 
        
        $id_module    = $this->format_data->string($this->input->post('id_module'));
        $module_key  = $this->format_data->string($this->input->post('module_key'));
        $module_name = $this->format_data->string($this->input->post('module_name'));
        $aktif      = $this->input->post('aktif',TRUE);

        if($aktif)
          $aktif = '1';
        else
          $aktif = '0';

               
        $data = array(
                'module_key' => $module_key,
                'module_name' => $module_name,
                'aktif' => $aktif
            );

        $this->db->trans_start();   
        $this->db->where('id_module',$id_module); 
        $this->db->update('_module',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'edit';
            $status_property['url_process'] = base_url().'module/edit/'.$id_module;
            $this->model_public->messaga_status_user($status_property);
            redirect('module/view/');
        }
        
    }

    public function init_action()
    {
        //validate Checkbox
        $this->master->validateCheckbox('module');

        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id_module', $check[$i]);
                $this->db->update('_module',array('aktif' => '1'));
                $this->db->trans_complete(); 
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{   
                    $this->db->trans_commit();
                }
            }
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses di<b>publish</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }
        if ($unpublish == 'unpublish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id_module', $check[$i]);
                $this->db->update('_module',array('aktif' => '0'));
                $this->db->trans_complete(); 
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{   
                    $this->db->trans_commit();  
                }
            }
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses di<b>unpublish</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }
        if ($delete == 'delete'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id_module', $check[$i]);
                $this->db->delete('_module');
                $this->db->trans_complete();   
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses dihapus</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }

        redirect('module/view'); 
    }
}
?>