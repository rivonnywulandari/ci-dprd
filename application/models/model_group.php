<?php

class Model_group extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('_group')->num_rows();
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
                                                                FROM _group
                                                                ORDER BY _group.id_group desc
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
                                                                FROM _group
                                                                WHERE group_name like '%$cari%'
                                                                limit 100                                                         
                                                                ");

        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data <b>".$cari."</b> tidak ditemukan !!!";   
        return $data;
    }

    public function init_add()
    {
        $data['module'] = $this->model_public->QueryMultyValue("SELECT * from _module order by id_module asc");                                  
        return $data;
    }

    public function init_edit()
    {
        $id_group = $this->format_data->string($this->uri->segment(3,0));
        $group =  $this->model_public->QuerySingleValue("SELECT * FROM _group WHERE id_group='$id_group'"); 
        
        if ($group)     
            $data['data'] = $group;
        else
            redirect ('group/view');

        $data['module'] = $this->model_public->QueryMultyValue("SELECT * from _module order by id_module asc");  
                        
        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('group_name', 'nama group', 'required'); 
        $this->model_public->conv_validasi_to_indonesia();  
        if($this->form_validation->run() == FALSE)
        {
            $status_property['parameter'] = $action;
            $status_property['message'] = validation_errors();
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('group/'.$action.'/'.$id);         
        }    
    }

    public function init_add_save($groupname)
    {
        //validate
        $this->validate('add','');

        $group_name  = $this->format_data->string($this->input->post('group_name'));
        $aktif      = $this->input->post('aktif',TRUE);

        if($aktif)
          $aktif = '1';
        else
          $aktif = '0';

        $group = $this->model_public->QuerySingleValue("SELECT max(id_group) as id_max from _group");
        $id_group = $group->id_max + 1;    
        
        $data = array(
            'id_group' => $id_group,
            'group_name' => $group_name,
            'aktif' => $aktif
        );

        $this->db->trans_start();   
        $this->db->insert('_group',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            if ($check){
                for($i=0;$i<$jml_check;$i++){
                    $group_module = $this->model_public->QuerySingleValue("SELECT max(id_group_module) as id_max from _group_module");
                    $id_group_module = $group_module->id_max + 1;    
                    
                    $data = array(
                        'id_group_module' => $id_group_module,
                        'id_group' => $id_group,
                        'id_module' => $check[$i]
                    );

                    $this->db->trans_start();   
                    $this->db->insert('_group_module',$data); 
                    $this->db->trans_complete();    
                }
            }
        
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'edit';
            $status_property['url_process'] = base_url().'group/edit/'.$id_group;
            $this->model_public->messaga_status_user($status_property);
            redirect('group/view/');
        }
        
        
    }

    public function init_edit_save($groupname)
    {
        //validate
        $this->validate('edit',$this->input->post('id_group')); 
        
        $id_group    = $this->format_data->string($this->input->post('id_group'));
        $group_name  = $this->format_data->string($this->input->post('group_name'));
        $aktif      = $this->input->post('aktif',TRUE);

        if($aktif)
          $aktif = '1';
        else
          $aktif = '0';
               
        $data = array(
                'group_name' => $group_name,
                'aktif' => $aktif
            );

        $this->db->trans_start();   
        $this->db->where('id_group',$id_group); 
        $this->db->update('_group',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            //delete data di group module
            $this->db->query("DELETE from _group_module where id_group='$id_group'");

            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            if ($check){
                for($i=0;$i<$jml_check;$i++){
                    $group_module = $this->model_public->QuerySingleValue("SELECT max(id_group_module) as id_max from _group_module");
                    $id_group_module = $group_module->id_max + 1;    
                    
                    $data = array(
                        'id_group_module' => $id_group_module,
                        'id_group' => $id_group,
                        'id_module' => $check[$i]
                    );

                    $this->db->trans_start();   
                    $this->db->insert('_group_module',$data); 
                    $this->db->trans_complete();    
                }
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'edit';
            $status_property['url_process'] = base_url().'group/edit/'.$id_group;
            $this->model_public->messaga_status_user($status_property);
            redirect('group/view/');
        }
        
    }

    public function init_action()
    {
        //validate Checkbox
        $this->master->validateCheckbox('group');

        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id_group', $check[$i]);
                $this->db->update('_group',array('aktif' => '1'));
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
                $this->db->where('id_group', $check[$i]);
                $this->db->update('_group',array('aktif' => '0'));
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

            for($i=0;$i<$jml_check;$i++)
            {
                //alert relasi data
                $this->cekRelasiData($check[$i]);

                $this->db->trans_start();
                $this->db->where('id_group', $check[$i]);
                $this->db->delete('_group');
                $this->db->trans_complete();
                
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{ 
                    $this->db->trans_start();
                    $this->db->where('id_group', $check[$i]);
                    $this->db->delete('_group_module');
                    $this->db->trans_complete();   
                } 
            }
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses dihapus</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }

        redirect('group/view'); 
    }

    public function  getModule($id_group)
    {
        $data = $this->model_public->QueryMultyValue("SELECT _module.module_name 
                                                        from _module, _group_module
                                                        where  _module.id_module = _group_module.id_module
                                                        and ._group_module.id_group='$id_group'");  
        return $data;
    }

    public function cekModule($id_module,$id_group)
    {
        $data='';
        $cek = $this->model_public->QueryNumRows("SELECT * from _group_module where id_module='$id_module' and id_group='$id_group'");
        if ($cek > 0)
            $data = 'checked';

        return $data;
    }

    public function cekRelasiData($id){
        $data_array=array(
            "_user"=>"User"
        );         
        $relasi = $this->model_public->relasi_data($data_array,'id_group',$id);   
        if (!$relasi == ""){
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data tidak dapat dihapus, data sedang digunakan  pada tabel <b>'.$relasi.'</b>';
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('group/view');  
        }
    }
}
?>