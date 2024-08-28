<?php

class Model_foto extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('tb_foto')->num_rows();
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
                                                                FROM tb_foto
                                                                ORDER BY tb_foto.id desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto"); 

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['null'] = "tidak ada data !!!";
        return $data;
    }

    public function init_filter($offset = 0,$perpage = 0,$siteurl,$kategori)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $total_rows = $this->model_public->QueryNumRows("SELECT * from tb_foto where id_kat='$kategori'");
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
                                                                FROM tb_foto
                                                                WHERE id_kat='$kategori'
                                                                ORDER BY tb_foto.id desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto"); 

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['null'] = "tidak ada data !!!";

        if ($kategori == "")
            $this->session->set_flashdata('kategori',null);
        else           
            $this->session->set_flashdata('kategori',$kategori);
        
        return $data;
    }

    public function init_search()
    {  
        $cari = $this->format_data->string($this->input->post('cari'));

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM tb_foto
                                                                WHERE judul like '%$cari%'
                                                                or  isi like '%$cari%'
                                                                or  tag like '%$cari%'  
                                                                or  foto like '%$cari%'  
                                                                limit 100                                                         
                                                                ");

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto"); 

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
                                                                FROM tb_foto
                                                                WHERE tanggal like '$tanggal%'                                                         
                                                                ");

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto"); 

        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data pada tanggal <b>".$tanggal."</b> tidak ditemukan !!!";     
      return $data;
    }

    public function init_add()
    {
        $data['id_kategori'] = '';
        $data['nama_kategori'] = "--Pilih Kategori--";
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto");                          
        
        return $data;
    }

    public function init_edit()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $foto =  $this->model_public->QuerySingleValue("SELECT * FROM tb_foto WHERE id='$id'"); 
        
        if ($foto)     
            $data['data'] = $foto;
        else
            redirect ('foto/view');

        $kategori = $this->model_public->QuerySingleValue("SELECT * FROM tb_katfoto WHERE id='".$foto->id_kat."'");
        $data['id_kategori'] = $kategori->id;
        $data['nama_kategori'] = $kategori->nama;
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto where id <> '".$foto->id_kat."'");                         
        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('judul', 'judul', 'required'); 
        $this->form_validation->set_rules('teks_foto', 'teks foto', 'required');         
        $this->form_validation->set_rules('tag', 'kata kunci', 'required'); 
        $this->form_validation->set_rules('id_kat', 'kategori', 'required'); 
        $this->model_public->conv_validasi_to_indonesia();  
        if($this->form_validation->run() == FALSE)
        {
            $status_property['parameter'] = $action;
            $status_property['message'] = validation_errors();
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('foto/'.$action.'/'.$id);         
        }    
    }

    public function init_add_save($username)
    {
        //validate
        $this->validate('add','');

        $judul      = $this->format_data->string($this->input->post('judul'));
        $tag        = $this->format_data->string($this->input->post('tag'));
        $id_kat     = $this->format_data->string($this->input->post('id_kat'));
        $hari       = date("w");
        $tanggal    = date("Y-m-d H:i:s");
        $tanggal2    = '0000-00-00 00:00:00';
        $aktif      = $this->format_data->string($this->input->post('aktif'));
        $entri      = $username;
        $teks_foto  = $this->format_data->textarea($this->input->post('teks_foto'));
        $tabel      = 'tb_foto';

        $foto = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_foto");
        $id_foto = $foto->id_max + 1;

        $config = array(
                   'allowed_types' => 'jpg|jpeg|gif|png',
                   'upload_path' => realpath('./media/fotos/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 91024000000,
                );
        
        $hits=0;
        $edit=0;
        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $file = $this->upload->file_name;

        if($this->upload->do_upload('foto'))
        {
            $file1  = $this->upload->data();
            $file2  = $file1['file_name'];
            $ukuran = $file1['file_size'];
            $gambar = 'media/fotos/'.date('Y').'/'.date('m').'/'.$file2;

            $data = array(
                'id' => $id_foto,
                'judul' => $judul,
                'foto' =>  $gambar,
                'ukuran' => $ukuran,
                'isi' => $teks_foto,
                'tag' => $tag,
                'id_kat' => $id_kat,
                'tabel' => $tabel,
                'id_konten' => $id_foto,
                'hari' => date('W'),
                'tanggal' => date('Y-m-d H:i:s'),
                'tanggal2' => $tanggal2,
                'hit' => $hits,
                'aktif' => $aktif,
                'entri' => $entri,
                'edit' => $edit
            );
            $this->db->trans_start();
            $this->db->insert('tb_foto', $data);
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else{   
                $this->db->trans_commit();
                $this->master->resizeFoto($file2,600,2000);
                $this->master->createThumbnailFoto($file2);
            }
        }
        else{
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data foto gagal diupload';
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] ='';
            $this->model_public->messaga_status_user($status_property);
            redirect('foto/view/');
        }
            
        $status_property['parameter'] = 'view';
        $status_property['message'] = 'data sukses disimpan';
        $status_property['error_message'] = 'alert-success';
        $status_property['status_message'] = 'edit';
        $status_property['url_process'] = base_url().'foto/edit/'.$id_foto;
        $this->model_public->messaga_status_user($status_property);
        redirect('foto/view/');
    }

    public function init_edit_save($username)
    {
        //validate
        $this->validate('edit',$this->input->post('id')); 
        
        $id         = $this->format_data->string($this->input->post('id'));
        $judul      = $this->format_data->string($this->input->post('judul'));
        $tag        = $this->format_data->string($this->input->post('tag'));
        $id_kat     = $this->format_data->string($this->input->post('id_kat'));
        $tanggal    = date("Y-m-d H:i:s");
        $aktif      = $this->format_data->string($this->input->post('aktif'));
        $edit       = $username;
        $teks_foto  = $this->format_data->textarea($this->input->post('teks_foto'));
        $tabel      = 'tb_foto';
          
        if ($_FILES['foto']['name']!=''){
            $result = $this->model_public->QuerySingleValue("SELECT * from tb_foto where id='$id'");
            $foto = $result->foto;
            $foto = './'.$foto;
            if (!$foto == ""){
                if(file_exists($foto)){
                    $delete= unlink($foto);
                    if ($delete){
                        //delete thumbnail foto
                        $tahun = date('Y',strtotime($result->tanggal));
                        $bulan = date('m',strtotime($result->tanggal));
                        $this->master->deleteThumbnailFoto($result->foto,$tahun,$bulan);
                        //upload foto
                        $this->master->updateFoto('foto', $judul, $teks_foto, $id_kat, $tabel, $id, $aktif, $tag, $edit);  
                    }
                    else{
                        $status_property['parameter'] = 'view';
                        $status_property['message'] = 'data foto gagal diupload';
                        $status_property['error_message'] = 'alert-warning';
                        $status_property['status_message'] = '';
                        $status_property['url_process'] = '';
                        $this->model_public->messaga_status_user($status_property);
                        redirect('foto/view/');
                    }        
                }
                else
                    $this->master->updateFoto('foto', $judul, $teks_foto, $id_kat, $tabel, $id, $aktif, $tag, $edit);                
            }
        }
        else{
            $this->master->updateDataFoto('foto', $judul, $teks_foto, $id_kat, $tabel, $id, $aktif, $tag, $edit);   
        }

        $status_property['parameter'] = 'view';
        $status_property['message'] = 'data sukses disimpan';
        $status_property['error_message'] = 'alert-success';
        $status_property['status_message'] = 'edit';
        $status_property['url_process'] = base_url().'foto/edit/'.$id;
        $this->model_public->messaga_status_user($status_property);
        redirect('foto/view/');
        
    }

    public function init_action()
    {
        //validate Checkbox
        $this->master->validateCheckbox('foto');

        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id', $check[$i]);
                $this->db->update('tb_foto',array('aktif' => '1'));
                $this->db->trans_complete();   
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
                $this->db->update('tb_foto',array('aktif' => '0'));
                $this->db->trans_complete();   
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
                $result = $this->model_public->QuerySingleValue("SELECT * from tb_foto where id='".$check[$i]."'");
                $foto = $result->foto;
                $foto = './'.$foto;
                if (!$foto == ""){
                    if(file_exists($foto)){
                        unlink($foto);
                        $this->db->trans_start();
                        $this->db->where('id',$check[$i]);
                        $this->db->delete('tb_foto');
                        $this->db->trans_complete();

                        //delete thumbnail foto
                        $tahun = date('Y',strtotime($result->tanggal));
                        $bulan = date('m',strtotime($result->tanggal));
                        $this->master->deleteThumbnailFoto($result->foto,$tahun,$bulan);
                    }
                    else{
                        $this->db->trans_start();
                        $this->db->where('id',$check[$i]);
                        $this->db->delete('tb_foto');
                        $this->db->trans_complete();
                    }      
                }  
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses dihapus</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }

        redirect('foto/view'); 
    }

    public function init_category()
    {  
        $id = $this->format_data->string($this->uri->segment(3,0));

        //list data
        $data['data'] =  $this->model_public->QueryMultyValue("SELECT * FROM tb_katfoto where id <> '0'");

        //form add 
        if ($id == 0){            
            $data['id'] = ""; 
            $data['nama'] = ""; 
            $data['id_induk'] =  "0";
            $data['nama_induk'] = "Kategori Induk";
            $data['category_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto where id <> 0"); 
            $data['button'] = "Simpan"; 
            $data['title'] = "TAMBAH";
            $data['action'] = "add";
        }

        //formedit
        else{
            $data['id'] = $id;
            $kategori =  $this->model_public->QuerySingleValue("SELECT * FROM tb_katfoto where id='$id'");
            if (!$kategori)
                redirect('foto/category/');
            else
                $data['nama'] = $kategori->nama;

            $induk=  $this->model_public->QuerySingleValue("SELECT * FROM tb_katfoto where id='".$kategori->induk."'");
            $data['id_induk'] =  "0";
            $data['nama_induk'] = "Kategori Induk";
            $data['category_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katfoto");  
            $data['button'] = "Perbarui";
            $data['title'] = "UBAH";
            $data['action'] = "edit";
        }
        $data['pagination'] = '';   
        $data['offset'] = '';    
        return $data;
    }

    public function init_category_action()
    {  
        $action = $this->format_data->string($this->input->post('action'));
        $id = $this->format_data->string($this->input->post('id'));
        $induk = $this->format_data->string($this->input->post('induk'));
        $nama = $this->format_data->string($this->input->post('nama'));

        /*------------------------------------------------*/
        if ($action == "delete"){
            $data_array=array(
                "tb_foto"=>"foto"
            );         
            $relasi = $this->model_public->relasi_data($data_array,'id_kat',$id);   
            if (!$relasi == ""){
                $status_property['parameter'] = 'category';
                $status_property['message'] = 'data tidak dapat dihapus, data sedang digunakan  pada tabel <b>'.$relasi.'</b>';
                $status_property['error_message'] = 'alert-warning';
                $status_property['status_message'] = '';
                $status_property['url_process'] = '';  
                $this->model_public->messaga_status_user($status_property); 
                redirect('foto/category');  
            }   
            /*------------------------------------------------*/ 

            $this->db->query("delete from tb_katfoto where id ='$id'"); 

            $status_property['parameter'] = 'category';
            $status_property['message'] = 'data sukses dihapus';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'delete';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property); 
        }

        if ($action == "add"){
            $category = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_katfoto");
            $id= $category->id_max + 1; 
            //input array
            $data = array(
                'id' => $id,
                'nama' => $nama,
                'induk' => $induk
            );

            $this->db->trans_start();
            $this->db->insert('tb_katfoto', $data);
            $this->db->trans_complete();    
            
            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else
            {   
                $this->db->trans_commit();
                $status_property['parameter'] = 'category';
                $status_property['message'] = 'data sukses disimpan';
                $status_property['error_message'] = 'alert-success';
                $status_property['status_message'] = '';
                $status_property['url_process'] = '';
                $this->model_public->messaga_status_user($status_property);
            }
        }

        if ($action == "edit"){
            //update array
            $data = array(
                'nama' => $nama,
                'induk' => $induk,
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update('tb_katfoto',$data);
            $this->db->trans_complete();    
            
            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else
            {   
                $this->db->trans_commit();
                $status_property['parameter'] = 'category';
                $status_property['message'] = 'data sukses diperbarui';
                $status_property['error_message'] = 'alert-success';
                $status_property['status_message'] = '';
                $status_property['url_process'] = '';
                $this->model_public->messaga_status_user($status_property);
            }
        }
        redirect('foto/category'); 
    }
}
?>