<?php

class Model_contact extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view()
    {        
        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM tb_contact
                                                                ORDER BY tb_contact.id desc"); 

        $data['null'] = "tidak ada data !!!";
        return $data;
    }

    public function init_edit()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $contact =  $this->model_public->QuerySingleValue("SELECT * FROM tb_contact WHERE id='$id'"); 
        
        if ($contact)     
            $data['data'] = $contact;
        else
            redirect ('contact/view');

        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('nama', 'nama', 'required'); 
        $this->model_public->conv_validasi_to_indonesia();  
        if($this->form_validation->run() == FALSE)
        {
            $status_property['parameter'] = $action;
            $status_property['message'] = validation_errors();
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('contact/'.$action.'/'.$id);         
        }    
    }

    public function init_edit_save($username)
    {
        //validate
        $this->validate('edit',$this->input->post('id')); 
        
        $id             = $this->format_data->string($this->input->post('id'));
        $nama           = $this->format_data->string($this->input->post('nama'));
        $slogan         = $this->format_data->string($this->input->post('slogan'));
        $alamat         = $this->input->post('alamat');
        $kota           = $this->format_data->string($this->input->post('kota'));
        $prov           = $this->format_data->string($this->input->post('prov'));
        $kodepos        = $this->format_data->string($this->input->post('kodepos'));
        $tlp            = $this->input->post('tlp');
        $fax            = $this->format_data->string($this->input->post('fax'));
        $hp             = $this->format_data->string($this->input->post('hp'));
        $email          = $this->format_data->string($this->input->post('email'));
        $web            = $this->format_data->string($this->input->post('web'));
        $deskripsi      = $this->input->post('deskripsi');
        $keyword        = $this->input->post('keyword');
        $ket            = $this->input->post('ket');
        $facebook       = $this->format_data->string($this->input->post('facebook'));
        $twitter        = $this->format_data->string($this->input->post('twitter'));
        $gplus          = $this->format_data->string($this->input->post('gplus'));
        $tanggal        = date("Y-m-d H:i:s");
        $edit           = $username;
          
        $data = array(
            'nama' => $nama,
            'slogan' => $slogan,
            'alamat' => $alamat,
            'kota' => $kota,
            'prov' => $prov,
            'kodepos' => $kodepos,
            'tlp' => $tlp,
            'fax' => $fax,
            'hp' => $hp,
            'email' => $email,
            'web' => $web,
            'deskripsi' => $deskripsi,
            'keyword' => $keyword,
            'ket' => $ket,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'gplus' => $gplus,
            'tanggal' => $tanggal,
            'edit' => $edit,
        );

        $this->db->trans_start();   
        $this->db->where('id',$id); 
        $this->db->update('tb_contact',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
            redirect('contact/view/');
        }
    }
}
?>