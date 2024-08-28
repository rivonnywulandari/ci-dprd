<?php

class Model_berita extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('tb_berita')->num_rows();
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
                                                                FROM tb_berita
                                                                ORDER BY tb_berita.id desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita"); 

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
        $total_rows = $this->model_public->QueryNumRows("SELECT * from tb_berita where id_kat='$kategori'");
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
                                                                FROM tb_berita
                                                                WHERE id_kat='$kategori'
                                                                ORDER BY tb_berita.id desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita"); 

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
                                                                FROM tb_berita
                                                                WHERE judul like '%$cari%'
                                                                or  subjudul like '%$cari%'
                                                                or  isi like '%$cari%'
                                                                or  tag like '%$cari%' 
                                                                limit 100                                                         
                                                                ");
        
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita");

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
                                                                FROM tb_berita
                                                                WHERE tanggal like '$tanggal%'                                                         
                                                                ");
        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data pada tanggal <b>".$tanggal."</b> tidak ditemukan !!!";     
      return $data;
    }

    public function init_add()
    {
        $data['id_kategori'] = '';
        $data['nama_kategori'] = "--Pilih Kategori--";
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita");                          
        
        return $data;
    }

    public function init_edit()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $berita =  $this->model_public->QuerySingleValue("SELECT * FROM tb_berita WHERE id='$id'"); 
        
        if ($berita)     
            $data['data'] = $berita;
        else
            redirect ('berita/view');

        $kategori = $this->model_public->QuerySingleValue("SELECT * FROM tb_katberita WHERE id='".$berita->id_kat."'");
        $data['id_kategori'] = $kategori->id;
        $data['nama_kategori'] = $kategori->nama;
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita where id <> '".$berita->id_kat."'");                         
        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('judul', 'judul', 'required'); 
        $this->form_validation->set_rules('id_kat', 'kategori', 'required'); 
        $this->form_validation->set_rules('isi', 'isi', 'required'); 
        $this->form_validation->set_rules('tag', 'kata kunci', 'required'); 
        $this->model_public->conv_validasi_to_indonesia();  
        if($this->form_validation->run() == FALSE)
        {
            $status_property['parameter'] = $action;
            $status_property['message'] = validation_errors();
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('berita/'.$action.'/'.$id);         
        }    
    }

    public function init_add_save($username)
    {
        //validate
        $this->validate('add','');

        $judul      = $this->format_data->string($this->input->post('judul'));
        $subjudul   = $this->format_data->string($this->input->post('subjudul'));
        $isi        = trim(addslashes($this->input->post('isi')));
        $tag        = $this->format_data->string($this->input->post('tag'));
        $id_kat     = $this->format_data->string($this->input->post('id_kat'));
        $headline   = $this->format_data->string($this->input->post('headline'));
        $hari       = date("w");
        $tanggal    = date("Y-m-d H:i:s");
        $aktif      = $this->format_data->string($this->input->post('aktif'));
        $entri      = $username;
        $teks_foto  = $this->format_data->string($this->input->post('teks_foto'));
        $tabel      = 'tb_berita';

        $berita = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_berita");
        $id_berita = $berita->id_max + 1;    
        
        $data = array(
            'id' => $id_berita,
            'judul' => $judul,
            'subjudul' => $subjudul,
            'isi' => $isi,
            'tag' => $tag,
            'id_kat' => $id_kat,
            'headline' => $headline,
            'hari' => $hari,
            'tanggal' => $tanggal,
            'aktif' => $aktif,
            'entri' => $entri
        );

        $this->db->trans_start();   
        $this->db->insert('tb_berita',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            if ($_FILES['foto']['name']!=''){
                $id_kat_foto = '1';
                $uploadFoto = $this->master->uploadFoto('berita',$judul, $teks_foto, $id_kat_foto, $tabel, $id_berita, $aktif, $tag, $entri);
            }
            
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'edit';
            $status_property['url_process'] = base_url().'berita/edit/'.$id_berita;
            $this->model_public->messaga_status_user($status_property);
            redirect('berita/view/');
        }
        
    }

    public function init_edit_save($username)
    {
        //validate
        $this->validate('edit',$this->input->post('id')); 
        
        $id         = $this->format_data->string($this->input->post('id'));
        $judul      = $this->format_data->string($this->input->post('judul'));
        $subjudul   = $this->format_data->string($this->input->post('subjudul'));
        $isi        = trim(addslashes($this->input->post('isi')));
        $tag        = $this->format_data->string($this->input->post('tag'));
        $id_kat     = $this->format_data->string($this->input->post('id_kat'));
        $headline   = $this->format_data->string($this->input->post('headline'));
        $hari       = date("w");
        $tanggal    = date("Y-m-d H:i:s");
        $aktif      = $this->format_data->string($this->input->post('aktif'));
        $edit       = $username;
        $teks_foto  = $this->format_data->string($this->input->post('teks_foto'));
        $tabel      = 'tb_berita';
          
        $data = array(
            'judul' => $judul,
            'subjudul' => $subjudul,
            'isi' => $isi,
            'tag' => $tag,
            'id_kat' => $id_kat,
            'headline' => $headline,
            'hari' => $hari,
            'tanggal2' => $tanggal,
            'aktif' => $aktif,
            'edit' => $edit,
        );

        $this->db->trans_start();   
        $this->db->where('id',$id); 
        $this->db->update('tb_berita',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else
        {   
            if ($_FILES['foto']['name']!=''){
                $this->master->deleteFoto($tabel,$id);
                $id_kat_foto = '1';
                $this->master->uploadFoto('berita',$judul, $teks_foto, $id_kat_foto, $tabel, $id, $aktif, $tag, $edit);
            }
            else{
                $foto = $this->model_public->QuerySingleValue("select * from tb_foto where tabel='$tabel' and id_konten='$id'");
                if ($foto){
                    $id_foto = $foto->id;
                    $id_kat_foto = $foto->id_kat;
                    $this->master->updateDataFoto('berita', $judul, $teks_foto, $id_kat_foto, $tabel, $id_foto, $aktif, $tag, $edit);   
                }    
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses disimpan';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'edit';
            $status_property['url_process'] = base_url().'berita/edit/'.$id;
            $this->model_public->messaga_status_user($status_property);
            redirect('berita/view/');
        }
    }

    public function init_action()
    {
        //validate Checkbox
        $this->master->validateCheckbox('berita');

        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id', $check[$i]);
                $this->db->update('tb_berita',array('aktif' => '1'));
                $this->db->trans_complete(); 
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{   
                    $this->master->publishFotoContent('tb_berita',$check[$i]); 
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
                $this->db->update('tb_berita',array('aktif' => '0'));
                $this->db->trans_complete(); 
                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else{   
                    $this->master->unpublishFotoContent('tb_berita',$check[$i]);  
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
                $this->db->delete('tb_berita');
                $this->db->trans_complete();   
            }
            for($i=0;$i<$jml_check;$i++){
                $this->master->deleteFoto('tb_berita',$check[$i]);  
            }

            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data sukses dihapus</b>';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
        }

        redirect('berita/view'); 
    }

    public function init_category()
    {  
        $id = $this->format_data->string($this->uri->segment(3,0));

        //list data
        $data['data'] =  $this->model_public->QueryMultyValue("SELECT * FROM tb_katberita where id <> '0'");

        //form add 
        if ($id == 0){            
            $data['id'] = ""; 
            $data['nama'] = ""; 
            $data['id_induk'] =  "0";
            $data['nama_induk'] = "Kategori Induk";
            $data['category_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita where id <> 0"); 
            $data['button'] = "Simpan"; 
            $data['title'] = "TAMBAH";
            $data['action'] = "add";
        }

        //formedit
        else{
            $data['id'] = $id;
            $kategori =  $this->model_public->QuerySingleValue("SELECT * FROM tb_katberita where id='$id'");
            if (!$kategori)
                redirect('berita/category/');
            else
                $data['nama'] = $kategori->nama;

            $induk=  $this->model_public->QuerySingleValue("SELECT * FROM tb_katberita where id='".$kategori->induk."'");
            $data['id_induk'] =  "0";
            $data['nama_induk'] = "Kategori Induk";
            $data['category_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katberita");  
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
                "tb_berita"=>"Berita"
            );         
            $relasi = $this->model_public->relasi_data($data_array,'id_kat',$id);   
            if (!$relasi == ""){
                $status_property['parameter'] = 'category';
                $status_property['message'] = 'data tidak dapat dihapus, data sedang digunakan  pada tabel <b>'.$relasi.'</b>';
                $status_property['error_message'] = 'alert-danger';
                $status_property['status_message'] = '';
                $status_property['url_process'] = '';  
                $this->model_public->messaga_status_user($status_property); 
                redirect('berita/category');  
            }   
            /*------------------------------------------------*/ 

            $this->db->query("delete from tb_katberita where id ='$id'"); 

            $status_property['parameter'] = 'category';
            $status_property['message'] = 'data sukses dihapus';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'delete';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property); 
        }

        if ($action == "add"){
            $category = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_katberita");
            $id= $category->id_max + 1; 
            //input array
            $data = array(
                'id' => $id,
                'nama' => $nama,
                'induk' => $induk
            );

            $this->db->trans_start();
            $this->db->insert('tb_katberita', $data);
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
            $this->db->update('tb_katberita',$data);
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
        redirect('berita/category'); 
    }
}
?>