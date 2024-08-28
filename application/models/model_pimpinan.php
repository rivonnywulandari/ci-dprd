<?php

class Model_pimpinan extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('tb_pimpinan')->num_rows();
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
                                                                FROM tb_pimpinan
                                                                ORDER BY tb_pimpinan.id desc
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
                                                                FROM tb_pimpinan
                                                                WHERE nama like '%$cari%'
                                                                or  jabatan like '%$cari%'  
                                                                limit 100                                                       
                                                                ");
        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data <b>".$cari."</b> tidak ditemukan !!!";   
        return $data;
    }

    public function init_tanggal()
    {  
        $tanggal = $this->format_data->string($this->input->post('tanggal'));
        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM tb_pimpinan
                                                                WHERE tanggal like '$tanggal%'                                                         
                                                                ");
        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data pada tanggal <b>".$tanggal."</b> tidak ditemukan !!!";     
      return $data;
    }

    public function init_add()
    {                        
        $data['agama_cb'] = $this->model_public->QueryMultyValue("SELECT * from _agama");   
        return $data;
    }

    public function init_edit()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $pimpinan =  $this->model_public->QuerySingleValue("SELECT * FROM tb_pimpinan WHERE id='$id'"); 
        
        if ($pimpinan)     
            $data['data'] = $pimpinan;
        else
            redirect ('pimpinan/view');

        $agama = $this->model_public->QuerySingleValue("SELECT * FROM _agama WHERE id='".$pimpinan->id_agama."'");
        $data['id_agama'] = $agama->id;
        $data['nama_agama'] = $agama->nama;
        $data['agama_cb'] = $this->model_public->QueryMultyValue("SELECT * from _agama where id <> '".$pimpinan->id_agama."'");                         
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
            redirect('pimpinan/'.$action.'/'.$id);         
        }    
    }

    public function init_add_save($username)
    {
        //validate
        $this->validate('add','');

        $jabatan        = $this->format_data->string($this->input->post('jabatan'));
        $nama           = $this->format_data->string($this->input->post('nama'));
        $tempat_lahir   = $this->format_data->string($this->input->post('tempat_lahir'));
        $tanggal_lahir  = $this->format_data->string($this->input->post('tanggal_lahir'));
        $jekel          = $this->format_data->string($this->input->post('jekel'));
        $id_agama       = $this->format_data->string($this->input->post('id_agama'));
        $alamat         = $this->format_data->textarea($this->input->post('alamat'));
        $telepon        = $this->format_data->string($this->input->post('telepon'));
        $hp             = $this->format_data->string($this->input->post('hp'));
        $email          = $this->format_data->string($this->input->post('email'));
        $web            = $this->format_data->string($this->input->post('web'));
        $pendidikan     = $this->format_data->textarea($this->input->post('pendidikan'));
        $ket            = $this->format_data->textarea($this->input->post('ket'));
        $no_urut        = $this->format_data->string($this->input->post('no_urut'));
        $hari           = date("w");
        $tanggal        = date("Y-m-d H:i:s");
        $aktif          = $this->format_data->string($this->input->post('aktif'));
        $entri          = $username;
        $teks_foto      = $this->format_data->string($this->input->post('teks_foto'));
        $tabel          = 'tb_pimpinan';

        $pimpinan = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_pimpinan");
        $id_pimpinan = $pimpinan->id_max + 1;    
        
        $data = array(
            'id' => $id_pimpinan,
            'jabatan' => $jabatan,
            'nama' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jekel' => $jekel,
            'id_agama' => $id_agama,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'hp' => $hp,
            'email' => $email,
            'web' => $web,
            'pendidikan' => $pendidikan,
            'ket' => $ket,
            'no_urut' => $no_urut,
            'hari' => $hari,
            'tanggal' => $tanggal,
            'aktif' => $aktif,
            'entri' => $entri
        );

        $this->db->trans_start();   
        $this->db->insert('tb_pimpinan',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            if ($_FILES['foto']['name']!=''){
                $id_kat_foto = '7';
                $judul = $nama;
                $tag = $nama;
                $uploadFoto = $this->master->uploadFoto('pimpinan',$judul, $teks_foto, $id_kat_foto, $tabel, $id_pimpinan, $aktif, $tag, $entri);
            }
            
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
            redirect('pimpinan/view/');
        }
        
    }

    public function init_edit_save($username)
    {
        //validate
        $this->validate('edit',$this->input->post('id')); 
        
        $id             = $this->format_data->string($this->input->post('id'));
        $jabatan        = $this->format_data->string($this->input->post('jabatan'));
        $nama           = $this->format_data->string($this->input->post('nama'));
        $tempat_lahir   = $this->format_data->string($this->input->post('tempat_lahir'));
        $tanggal_lahir  = $this->format_data->string($this->input->post('tanggal_lahir'));
        $jekel          = $this->format_data->string($this->input->post('jekel'));
        $id_agama       = $this->format_data->string($this->input->post('id_agama'));
        $alamat         = $this->format_data->textarea($this->input->post('alamat'));
        $telepon        = $this->format_data->string($this->input->post('telepon'));
        $hp             = $this->format_data->string($this->input->post('hp'));
        $email          = $this->format_data->string($this->input->post('email'));
        $web            = $this->format_data->string($this->input->post('web'));
        $pendidikan     = $this->format_data->textarea($this->input->post('pendidikan'));
        $ket            = $this->format_data->textarea($this->input->post('ket'));
        $no_urut        = $this->format_data->string($this->input->post('no_urut'));
        $tanggal        = date("Y-m-d H:i:s");
        $aktif          = $this->format_data->string($this->input->post('aktif'));
        $edit           = $username;
        $teks_foto      = $this->format_data->string($this->input->post('teks_foto'));
        $tabel          = 'tb_pimpinan';

          
        $data = array(
            'jabatan' => $jabatan,
            'nama' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jekel' => $jekel,
            'id_agama' => $id_agama,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'hp' => $hp,
            'email' => $email,
            'web' => $web,
            'pendidikan' => $pendidikan,
            'ket' => $ket,
            'no_urut' => $no_urut,
            'tanggal2' => $tanggal,
            'aktif' => $aktif,
            'edit' => $edit,
        );

        $this->db->trans_start();   
        $this->db->where('id',$id); 
        $this->db->update('tb_pimpinan',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            if ($_FILES['foto']['name']!=''){
                $this->master->deleteFoto($tabel,$id);
                $id_kat_foto = '7';
                $judul = $nama;
                $tag = $nama;
                $uploadFoto = $this->master->uploadFoto('pimpinan',$judul, $teks_foto, $id_kat_foto, $tabel, $id, $aktif, $tag, $edit);
            }
            else{
                $foto = $this->model_public->QuerySingleValue("select * from tb_foto where tabel='$tabel' and id_konten='$id'");
                if ($foto){
                    $id_foto = $foto->id;
                    $id_kat_foto = $foto->id_kat;
                    $judul = $nama;
                    $teks_foto = $nama;
                    $tag = $nama;
                    $this->master->updateDataFoto('pimpinan', $judul, $teks_foto, $id_kat_foto, $tabel, $id_foto, $aktif, $tag, $edit); 
                }    
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
            redirect('pimpinan/view/');
        }
    }

    public function init_action(){

        //validate Checkbox
        $this->master->validateCheckbox('pengumuman');
        
        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id', $check[$i]);
                $this->db->update('tb_pimpinan',array('aktif' => '1'));
                $this->db->trans_complete();   
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{   
                    $this->master->publishFotoContent('tb_pimpinan',$check[$i]); 
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
                $this->db->where('id', $check[$i]);
                $this->db->update('tb_pimpinan',array('aktif' => '0'));
                $this->db->trans_complete();  
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{   
                    $this->master->unpublishFotoContent('tb_pimpinan',$check[$i]); 
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
                $this->db->where('id', $check[$i]);
                $this->db->delete('tb_pimpinan');
                $this->db->trans_complete();   
            }
            for($i=0;$i<$jml_check;$i++){
                $this->master->deleteFoto('tb_pimpinan',$check[$i]);  
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses dihapus</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }

        redirect('pimpinan/view'); 
    }
}
?>