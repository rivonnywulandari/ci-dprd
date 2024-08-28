<?php

class Model_video extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_view($offset = 0,$perpage = 0,$siteurl)
    {  
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $this->db->get('tb_video')->num_rows();
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
                                                                FROM tb_video
                                                                ORDER BY tb_video.id desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo"); 

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
        $total_rows = $this->model_public->QueryNumRows("SELECT * from tb_video where id_kat='$kategori'");
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
                                                                FROM tb_video
                                                                WHERE id_kat='$kategori'
                                                                ORDER BY tb_video.id desc
                                                                limit ".$perpage." offset ".$offset ); 

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo"); 

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
                                                                FROM tb_video
                                                                WHERE judul like '%$cari%'
                                                                or  isi like '%$cari%'
                                                                or  tag like '%$cari%'  
                                                                or  video like '%$cari%'  
                                                                limit 100                                                         
                                                                ");

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo"); 

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
                                                                FROM tb_video
                                                                WHERE tanggal like '$tanggal%'                                                         
                                                                ");

        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo"); 

        $data['pagination'] = '';   
        $data['offset'] = '';  
        $data['null'] = "data pada tanggal <b>".$tanggal."</b> tidak ditemukan !!!";     
      return $data;
    }

    public function init_add()
    {
        $data['id_kategori'] = '';
        $data['nama_kategori'] = "--Pilih Kategori--";
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo");                          
        
        return $data;
    }

    public function init_edit()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $video =  $this->model_public->QuerySingleValue("SELECT * FROM tb_video WHERE id='$id'"); 
        
        if ($video)     
            $data['data'] = $video;
        else
            redirect ('video/view');

        $kategori = $this->model_public->QuerySingleValue("SELECT * FROM tb_katvideo WHERE id='".$video->id_kat."'");
        $data['id_kategori'] = $kategori->id;
        $data['nama_kategori'] = $kategori->nama;
        $data['kategori_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo where id <> '".$video->id_kat."'");                         
        return $data;
    }

    public function validate($action,$id)
    {
        $this->form_validation->set_rules('judul', 'judul', 'required'); 
        $this->form_validation->set_rules('teks_video', 'teks video', 'required');         
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
            redirect('video/'.$action.'/'.$id);         
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
        $aktif      = $this->format_data->string($this->input->post('aktif'));
        $entri      = $username;
        $teks_video  = $this->format_data->textarea($this->input->post('teks_video'));
        $tabel      = 'tb_video';

        $video = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_video");
        $id_video = $video->id_max + 1;

        $config = array(
                   'allowed_types' => 'flv|mp4',
                   'upload_path' => realpath('./media/videos/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 1024000,
                );

        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $file = $this->upload->file_name;

        if($this->upload->do_upload('video'))
        {         
            $file1  = $this->upload->data();
            $file2  = $file1['file_name'];
            $nama_video = $file2;
            $ukuran = $file1['file_size'];
            $video = 'media/videos/'.date('Y').'/'.date('m').'/'.$file2;

            //createPreviewvideo
            $preview = $this->master->createPreviewVideo(); 

            $data = array(
                'id' => $id_video,
                'judul' => $judul,
                'video' =>  $video,
                'nama_video' =>  $nama_video,
                'ukuran' => $ukuran,
                'preview' => $preview,
                'isi' => $teks_video,
                'tag' => $tag,
                'id_kat' => $id_kat,
                'tabel' => $tabel,
                'id_konten' => $id_video,
                'hari' => date('W'),
                'tanggal' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'entri' => $entri
            );
            $this->db->trans_start();
            $this->db->insert('tb_video', $data);
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();            
            else{   
                $this->db->trans_commit();
                //alert success
                $this->master->alertSuccess('video','save',$id_video);
            }            
        }
        else{
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data video gagal diupload';
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] ='';
            $this->model_public->messaga_status_user($status_property);
        }
        echo site_url().'video/view';
    }

    public function init_edit_save($username)
    {
        //validate
        $this->validate('edit',$this->input->post('id')); 
        
        $id         = $this->format_data->string($this->input->post('id'));
        $preview    = $this->input->post('preview');
        $judul      = $this->format_data->string($this->input->post('judul'));
        $tag        = $this->format_data->string($this->input->post('tag'));
        $id_kat     = $this->format_data->string($this->input->post('id_kat'));
        $tanggal    = date("Y-m-d H:i:s");
        $aktif      = $this->format_data->string($this->input->post('aktif'));
        $edit       = $username;
        $teks_video  = $this->format_data->textarea($this->input->post('teks_video'));
        $tabel      = 'tb_video';
          
        if (empty($_FILES['foto']['name']) == false){
            //createPreviewvideo
            $this->master->deletePreviewVideo($preview);
            //createPreviewvideo
            $preview = $this->master->createPreviewVideo(); 
        }

        if (empty($_FILES['video']['name']) == false){
            $result = $this->model_public->QuerySingleValue("SELECT * from tb_video where id='$id'");
            $video = $result->video;
            $video = './'.$video;
            if (!$video == ""){
                if(file_exists($video)){
                    $delete= unlink($video);
                    if ($delete){
                        $updateVideo = $this->master->updateVideo('video', $preview, $judul, $teks_video, $id_kat, $tabel, $id, $aktif, $tag, $edit);  
                        if ($updateVideo==false){
                            $status_property['parameter'] = 'view';
                            $status_property['message'] = 'data video gagal diupload';
                            $status_property['error_message'] = 'alert-warning';
                            $status_property['status_message'] = '';
                            $status_property['url_process'] = '';
                            $this->model_public->messaga_status_user($status_property);  
                        }
                        else{
                            $this->master->alertSuccess('video','save',$id);   
                        }
                    }
                    else{
                        $status_property['parameter'] = 'view';
                        $status_property['message'] = 'data video gagal diupload';
                        $status_property['error_message'] = 'alert-warning';
                        $status_property['status_message'] = '';
                        $status_property['url_process'] = '';
                        $this->model_public->messaga_status_user($status_property);
                    }        
                }
                else{
                    $updateVideo = $this->master->updateVideo('video', $preview, $judul, $teks_video, $id_kat, $tabel, $id, $aktif, $tag, $edit);  
                    if ($updateVideo==false){
                        $status_property['parameter'] = 'view';
                        $status_property['message'] = 'data video gagal diupload';
                        $status_property['error_message'] = 'alert-warning';
                        $status_property['status_message'] = '';
                        $status_property['url_process'] = '';
                        $this->model_public->messaga_status_user($status_property);  
                    }
                    else{
                        $this->master->alertSuccess('video','save',$id);   
                    }                
                }
            }
        }
        else{
            $this->master->updateDataVideo('video', $preview, $judul, $teks_video, $id_kat, $tabel, $id, $aktif, $tag, $edit);   
            //alert success
            $this->master->alertSuccess('video','save',$id);                
        }

        echo site_url().'video/view';   
        
    }

    public function init_action()
    {
        //validate Checkbox
        $this->master->validateCheckbox('video');

        $publish = $this->input->post('publish');
        $unpublish = $this->input->post('unpublish');
        $delete = $this->input->post('delete');

        if ($publish == 'publish'){
            $check = $this->input->post('checkbox',true);        
            $jml_check=count($check);

            for($i=0;$i<$jml_check;$i++){
                $this->db->trans_start();
                $this->db->where('id', $check[$i]);
                $this->db->update('tb_video',array('aktif' => '1'));
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
                $this->db->update('tb_video',array('aktif' => '0'));
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
                $result = $this->model_public->QuerySingleValue("SELECT * from tb_video where id='".$check[$i]."'");
                $video = $result->video;
                $video = './'.$video;
                if (!$video == ""){
                    if(file_exists($video)){
                        unlink($video);
                        
                        //delete preview video
                        $this->master->deletePreviewVideo($result->preview);

                        $this->db->trans_start();
                        $this->db->where('id',$check[$i]);
                        $this->db->delete('tb_video');
                        $this->db->trans_complete();
                    }
                    else{

                        //delete preview video
                        $this->master->deletePreviewVideo($result->preview);

                        $this->db->trans_start();
                        $this->db->where('id',$check[$i]);
                        $this->db->delete('tb_video');
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

        redirect('video/view'); 
    }

    public function init_category()
    {  
        $id = $this->format_data->string($this->uri->segment(3,0));

        //list data
        $data['data'] =  $this->model_public->QueryMultyValue("SELECT * FROM tb_katvideo where id <> '0'");

        //form add 
        if ($id == 0){            
            $data['id'] = ""; 
            $data['nama'] = ""; 
            $data['id_induk'] =  "0";
            $data['nama_induk'] = "Kategori Induk";
            $data['category_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo where id <> 0"); 
            $data['button'] = "Simpan"; 
            $data['title'] = "TAMBAH";
            $data['action'] = "add";
        }

        //formedit
        else{
            $data['id'] = $id;
            $kategori =  $this->model_public->QuerySingleValue("SELECT * FROM tb_katvideo where id='$id'");
            if (!$kategori)
                redirect('video/category/');
            else
                $data['nama'] = $kategori->nama;

            $induk=  $this->model_public->QuerySingleValue("SELECT * FROM tb_katvideo where id='".$kategori->induk."'");
            $data['id_induk'] =  "0";
            $data['nama_induk'] = "Kategori Induk";
            $data['category_cb'] = $this->model_public->QueryMultyValue("SELECT * from tb_katvideo");  
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
                "tb_video"=>"video"
            );         
            $relasi = $this->model_public->relasi_data($data_array,'id_kat',$id);   
            if (!$relasi == ""){
                $status_property['parameter'] = 'category';
                $status_property['message'] = 'data tidak dapat dihapus, data sedang digunakan  pada tabel <b>'.$relasi.'</b>';
                $status_property['error_message'] = 'alert-warning';
                $status_property['status_message'] = '';
                $status_property['url_process'] = '';  
                $this->model_public->messaga_status_user($status_property); 
                redirect('video/category');  
            }   
            /*------------------------------------------------*/ 

            $this->db->query("delete from tb_katvideo where id ='$id'"); 

            $status_property['parameter'] = 'category';
            $status_property['message'] = 'data sukses dihapus';
            $status_property['error_message'] = 'alert-success';
            $status_property['status_message'] = 'delete';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property); 
        }

        if ($action == "add"){
            $category = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_katvideo");
            $id= $category->id_max + 1; 
            //input array
            $data = array(
                'id' => $id,
                'nama' => $nama,
                'induk' => $induk
            );

            $this->db->trans_start();
            $this->db->insert('tb_katvideo', $data);
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
            $this->db->update('tb_katvideo',$data);
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
        redirect('video/category'); 
    }
}
?>