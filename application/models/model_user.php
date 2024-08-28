<?php

class Model_user extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('_user')->num_rows();
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
                                                                FROM _user
                                                                WHERE id_group <> 1
                                                                ORDER BY _user.id_user desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['group_cb'] = $this->model_public->QueryMultyValue("SELECT * from _group where id_group <> 1");

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['null'] = "tidak ada data !!!";
        return $data;
    }

    public function init_filter($offset = 0,$perpage = 0,$siteurl,$id_group)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $total_rows = $this->model_public->QueryNumRows("SELECT * from _user where id_group='$id_group'");
        $config['total_rows'] = $total_rows;
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
                                                                FROM _user
                                                                WHERE id_group='$id_group'
                                                                ORDER BY _user.id_group desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['group_cb'] = $this->model_public->QueryMultyValue("SELECT * from _group where id_group <> 1");

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['null'] = "tidak ada data !!!";

        if ($id_group == "")
            $this->session->set_flashdata('id_group',null);
        else           
            $this->session->set_flashdata('id_group',$id_group);
        
        return $data;
    }

    public function init_search()
    {  
        $cari = $this->format_data->string($this->input->post('cari'));

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM _user
                                                                WHERE id_group <> 1
                                                                and (username like '%$cari%'
                                                                or  nama_user like '%$cari%')
                                                                limit 100                                                         
                                                                ");

        $data['group_cb'] = $this->model_public->QueryMultyValue("SELECT * from _group where id_group <> 1");

        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data <b>".$cari."</b> tidak ditemukan !!!";   
        return $data;
    }

    public function init_add()
    {
        $data['id_group'] = '';
        $data['group_name'] = "--Pilih Kategori--";
        $data['group_cb'] = $this->model_public->QueryMultyValue("SELECT * from _group where id_group <> 1");  

        $data['nama']       = $this->session->flashdata('nama');                        
        $data['alamat']     = $this->session->flashdata('alamat');                        
        $data['telepon']    = $this->session->flashdata('telepon');                        
        $data['username']   = $this->session->flashdata('username');                             
        
        return $data;
    }

    public function init_edit()
    {
        $id_user = $this->format_data->string($this->uri->segment(3,0));
        $user =  $this->model_public->QuerySingleValue("SELECT * FROM _user WHERE id_user='$id_user'"); 
        
        if ($user)     
            $data['data'] = $user;
        else
            redirect ('user/view');

        $group = $this->model_public->QuerySingleValue("SELECT * FROM _group WHERE id_group ='".$user->id_group."'");
        $data['id_group'] = $group->id_group;
        $data['group_name'] = $group->group_name;
        $data['group_cb'] = $this->model_public->QueryMultyValue("SELECT * from _group where ( id_group <> '".$user->id_group."' and id_group <> '1')");                         
        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('nama', 'nama lengkap', 'required'); 
        $this->form_validation->set_rules('username', 'username', 'required'); 
        $this->form_validation->set_rules('password', 'password', 'required'); 
        $this->form_validation->set_rules('id_group', 'group user', 'required'); 
        $this->model_public->conv_validasi_to_indonesia();  
        if($this->form_validation->run() == FALSE)
        {
            $status_property['parameter'] = $action;
            $status_property['message'] = validation_errors();
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('user/'.$action.'/'.$id);         
        }    
    }

    public function init_add_save($username)
    {
        $nama       = $this->format_data->string($this->input->post('nama'));
        $id_jekel   = $this->format_data->string($this->input->post('id_jekel'));
        $alamat     = $this->format_data->textarea($this->input->post('alamat'));
        $telepon    = $this->format_data->string($this->input->post('telepon'));
        $id_group   = $this->format_data->string($this->input->post('id_group'));
        $username   = $this->format_data->string($this->input->post('username'));
        $password   = md5(md5($this->format_data->string($this->input->post('password'))));
        $aktif      = $this->input->post('aktif',TRUE);

        if($aktif)
          $aktif = '1';
        else
          $aktif = '0';

        //flashdata
        $setdata    = array('nama'=>$nama,'alamat'=>$alamat,'telepon'=>$telepon,'username'=>$username);
        $this->master->dataflash($setdata);

        //validate
        $this->validate('add','');

        $cekusername = $this->model_public->QueryNumRows("SELECT * from _user where username = '$username'"); 

        if ($cekusername > 0)
        {
            $status_property['parameter'] = 'add';
            $status_property['message'] = 'username <b><i>'.$username.'</i></b> telah digunakan</b>';
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = '';
            $status_property['url_process'] ='';
            $this->model_public->messaga_status_user($status_property);
            redirect('user/add/');
        }
        else
        {
            $user = $this->model_public->QuerySingleValue("SELECT max(id_user) as id_max from _user");
            $id_user = $user->id_max + 1;    
            
            $data = array(
                'id_user' => $id_user,
                'nama_user' => $nama,
                'id_jekel' => $id_jekel,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'id_group' => $id_group,
                'username' => $username,
                'password' => $password,
                'aktif' => $aktif
            );

            $this->db->trans_start();   
            $this->db->insert('_user',$data); 
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else
            {   
                
                $status_property['parameter'] = 'view';
                $status_property['message'] = 'data sukses disimpan';
                $status_property['error_message'] = 'alert-success';
                $status_property['status_message'] = 'edit';
                $status_property['url_process'] = base_url().'user/edit/'.$id_user;
                $this->model_public->messaga_status_user($status_property);
                redirect('user/view/');
            }
        }
        
    }

    public function init_edit_save($username)
    {
        //validate
        $this->validate('edit',$this->input->post('id_user')); 
        
        $id_user    = $this->format_data->string($this->input->post('id_user'));
        $nama       = $this->format_data->string($this->input->post('nama'));
        $id_jekel   = $this->format_data->string($this->input->post('id_jekel'));
        $alamat     = $this->format_data->textarea($this->input->post('alamat'));
        $telepon    = $this->format_data->string($this->input->post('telepon'));
        $id_group   = $this->format_data->string($this->input->post('id_group'));
        $username   = $this->format_data->string($this->input->post('username'));
        $aktif      = $this->input->post('aktif',TRUE);
        $password   = $this->getPassword($id_user);

        if($aktif)
          $aktif = '1';
        else
          $aktif = '0';

        $cekusername = $this->model_public->QueryNumRows("SELECT * from _user where username = '$username' and id_user <> '$id_user'");

        if ($cekusername > 0)
        {
            $status_property['parameter'] = 'edit';
            $status_property['message'] = 'username <b><i>'.$username.'</i></b> telah digunakan</b>';
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = '';
            $status_property['url_process'] ='';
            $this->model_public->messaga_status_user($status_property);
            redirect('user/edit/'.$id_user);
        }
        else{          
            $data = array(
                    'nama_user' => $nama,
                    'id_jekel' => $id_jekel,
                    'alamat' => $alamat,
                    'telepon' => $telepon,
                    'id_group' => $id_group,
                    'username' => $username,
                    'password' => $password,
                    'aktif' => $aktif
                );

            $this->db->trans_start();   
            $this->db->where('id_user',$id_user); 
            $this->db->update('_user',$data); 
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else
            {   

                $status_property['parameter'] = 'view';
                $status_property['message'] = 'data sukses disimpan';
                $status_property['error_message'] = 'alert-success';
                $status_property['status_message'] = 'edit';
                $status_property['url_process'] = base_url().'user/edit/'.$id_user;
                $this->model_public->messaga_status_user($status_property);
                redirect('user/view/');
            }
        }
    }

    public function init_action()
    {
        //validate Checkbox
        $this->master->validateCheckbox('user');

        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id_user', $check[$i]);
                $this->db->update('_user',array('aktif' => '1'));
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
                $this->db->where('id_user', $check[$i]);
                $this->db->update('_user',array('aktif' => '0'));
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
                $this->db->where('id_user', $check[$i]);
                $this->db->delete('_user');
                $this->db->trans_complete();   
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses dihapus</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }

        redirect('user/view'); 
    }

    private function getPassword($id_user){
        $newpassword = $this->format_data->string($this->input->post('newpassword'));
        $repassword  = $this->format_data->string($this->input->post('repassword'));

        if (!$newpassword == ""){
            if ($newpassword == $repassword)
                $password = md5(md5($newpassword));
            else{
                $status_property['parameter'] = 'edit';
                $status_property['message'] = 'kombinasi password salah';
                $status_property['error_message'] = 'alert-danger';
                $status_property['status_message'] = '';
                $status_property['url_process'] = '';
                $this->model_public->messaga_status_user($status_property);
                redirect('user/edit/'.$id_user); 
            }  
        }
        else{
            $user = $this->model_public->QuerySingleValue("SELECT password from _user where id_user ='$id_user'");
            $password = $user->password; 
        }

        return $password;
    }
}
?>