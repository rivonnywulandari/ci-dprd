<?php

class Master extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //image_lib
        $this->load->library('image_lib');
    }

    public function get($field,$tabel)
    {
        $data = "";
        $query = $this->model_public->QuerySingleValue("SELECT * from $tabel"); 
        if ($query)
            $data = $query->$field;   
        return $data;
    }

    public function getData($field,$tabel,$id,$value)
    {
        $data = "";
        $query = $this->model_public->QuerySingleValue("SELECT * from ".$tabel." where ".$id."='$value'"); 
        if (isset($query->$field))
            $data = $query->$field;   
        return $data;
    }

    public function getArray($tabel,$orderId,$orderType)
    {
        $data = "";
        $query = $this->model_public->QueryMultyValue("SELECT * from ".$tabel." order by ".$orderId." ".$orderType); 
        if ($query)
            $data = $query;   
        return $data;
    }
    
    public function getDataArray($tabel,$orderId,$orderType)
    {
        $data = "";
        $query = $this->model_public->QueryMultyValue("SELECT * from ".$tabel." where aktif='1' order by ".$orderId." ".$orderType); 
        if ($query)
            $data = $query;   
        return $data;
    }

    public function countData($tabel,$id,$value)
    {
        $data = 0;
        $query = $this->model_public->QueryNumRows("SELECT * from ".$tabel." where ".$id."='$value'"); 
        if ($query)
            $data = $query;   
        return $data;
    }

    public function getDataFoto($field,$valuetabel,$valueid)
    {
        $data = "";
        $query = $this->model_public->QuerySingleValue("SELECT * from tb_foto where tabel='$valuetabel' and id_konten='$valueid'"); 
        if ($query)
            $data = $query->$field;   
        return $data;
    }

    public function getDataThumb($valuetabel,$valueid) {
        $data = site_url().'media/fotos/thumbnail.png';
        $query = $this->model_public->QuerySingleValue("SELECT * from tb_foto where tabel='$valuetabel' and id_konten='$valueid'"); 
        if ($query){
            $foto  = $query->foto;
            if (!$foto ==""){
                $tahun = date('Y',strtotime($query->tanggal));
                $bulan = date('m',strtotime($query->tanggal));
                $folder = 'media/fotos/'.$tahun.'/'.$bulan.'/';
                $temp_array = explode($folder,$foto);
                if (isset($temp_array[1])){
                    $thumbnail = 'media/fotos/'.$tahun.'/'.$bulan.'/thumbnail/'.$temp_array[1];  
                    if (file_exists('./'.$thumbnail))
                        $data = site_url().$thumbnail;
                    else{
                        $data = site_url().'media/fotos/thumbnail.png';  
                    }
                }
            }
        } 
        return $data;
    }  

    public function getDataFile($field,$valuetabel,$valueid)
    {
        $data = "";
        $query = $this->model_public->QuerySingleValue("SELECT * from tb_file where tabel='$valuetabel' and id_konten='$valueid'"); 
        if ($query)
            $data = $query->$field;   
        return $data;
    }

    public function maxData($field,$tabel)
    {
        $data = 1;
        $query = $this->model_public->QuerySingleValue("SELECT max($field) as max from $tabel"); 
        if ($query)
            $data = $query->max + 1;   
        return $data;
    }

    public function maxDataDetail($field,$tabel,$id,$value)
    {
        $data = 1;
        $query = $this->model_public->QuerySingleValue("SELECT max($field) as max from $tabel where $id='$value'"); 
        if ($query)
            $data = $query->max + 1;   
        return $data;
    }

    public function countDataFoto($valuetabel,$valueid)
    {
        $data = 0;
        $query = $this->model_public->QueryNumRows("SELECT * from tb_foto where tabel='$valuetabel' and id_konten='$valueid'"); 
        if ($query)
            $data = $query;   
        return $data;
    }

    public function countDataFile($valuetabel,$valueid)
    {
        $data = 0;
        $query = $this->model_public->QueryNumRows("SELECT * from tb_file where tabel='$valuetabel' and id_konten='$valueid'"); 
        if ($query)
            $data = $query;   
        return $data;
    }

    public function category($field,$tabel,$induk)
    {
        $data = "Kategori Induk";
        $query = $this->model_public->QuerySingleValue("SELECT * from ".$tabel." where id='$induk'"); 
        if ($query)
            $data = $query->$field;   
        return $data;
    }

    public function categoryCount($tabel,$id)
    {
        $data = $this->model_public->QueryNumRows("SELECT * from ".$tabel." where id_kat='$id'");  
        return $data;
    }

    public function hitContent($tabel,$id)
    {
        $this->db->trans_start();   
        $this->db->query("UPDATE $tabel set hit= (hit) + 1 where id  = '$id'");  
        $this->db->trans_complete();  
    }

    public function publishFotoContent($tabel,$id_konten){
        $this->db->trans_start();
        $this->db->query("UPDATE tb_foto set aktif='1' where tabel='$tabel' and id_konten='$id_konten'");
        $this->db->trans_complete();  
    }
    
    public function unpublishFotoContent($tabel,$id_konten){
        $this->db->trans_start();
        $this->db->query("UPDATE tb_foto set aktif='0' where tabel='$tabel' and id_konten='$id_konten'");
        $this->db->trans_complete();  
    }

    public function publishFileContent($tabel,$id_konten){
        $this->db->trans_start();
        $this->db->query("UPDATE tb_file set aktif='1' where tabel='$tabel' and id_konten='$id_konten'");
        $this->db->trans_complete();  
    }
    
    public function unpublishFileContent($tabel,$id_konten){
        $this->db->trans_start();
        $this->db->query("UPDATE tb_file set aktif='0' where tabel='$tabel' and id_konten='$id_konten'");
        $this->db->trans_complete();  
    }

    public function uploadFoto($control, $judul, $teks_foto, $id_kat, $tabel, $id_konten, $aktif, $tag, $entri) { 
        $foto = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_foto");
        $id_foto = $foto->id_max + 1;

        $config = array(
                   'allowed_types' => 'jpg|jpeg|gif|png',
                   'upload_path' => realpath('./media/fotos/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 10240,
                );

        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();

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
                'id_konten' => $id_konten,
                'hari' => date('W'),
                'tanggal' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'entri' => $entri
            );
            $this->db->trans_start();
            $this->db->insert('tb_foto', $data);
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else{   
                $this->db->trans_commit();
                $this->resizeFoto($file2,600,2000);
                $this->createThumbnailFoto($file2);
            }
        }
        else{
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data foto gagal diupload';
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'ulangi';
            $status_property['url_process'] = base_url().$control.'/edit/'.$id_konten;
            $this->model_public->messaga_status_user($status_property);
            redirect($control.'/view/');
        }
    }

    public function uploadFoto2($control, $judul, $teks_foto, $id_kat, $tabel, $id_konten, $aktif, $tag, $entri) { 
        $foto = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_foto");
        $id_foto = $foto->id_max + 1;

        $config = array(
                   'allowed_types' => 'jpg|jpeg',
                   'upload_path' => realpath('./media/fotos/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 100,
                );

        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();

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
                'id_konten' => $id_konten,
                'hari' => date('W'),
                'tanggal' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'entri' => $entri
            );
            $this->db->trans_start();
            $this->db->insert('tb_foto', $data);
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else
                $this->db->trans_commit(); return true;      
        }
        else{
            return false;
        }
    }

    public function updateFoto($control, $judul, $teks_foto, $id_kat, $tabel, $id_foto, $aktif, $tag, $edit) { 
        $config = array(
                   'allowed_types' => 'jpg|jpeg|gif|png',
                   'upload_path' => realpath('./media/fotos/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 10240,
                );

        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();

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
                'tanggal2' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'edit' => $edit,
            );
            $this->db->trans_start();   
            $this->db->where('id',$id_foto); 
            $this->db->update('tb_foto',$data); 
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else{   
                $this->db->trans_commit();
                $this->resizeFoto($file2,600,2000);
                $this->createThumbnailFoto($file2);
            }
        }
        else{
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data foto gagal diupload';
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] ='';
            $this->model_public->messaga_status_user($status_property);
            redirect($control.'/view/');
        }
    }

    public function updateDataFoto($control, $judul, $teks_foto, $id_kat, $tabel, $id_foto, $aktif, $tag, $edit) { 
        $data = array(
            'id' => $id_foto,
            'judul' => $judul,
            'isi' => $teks_foto,
            'tag' => $tag,
            'id_kat' => $id_kat,
            'tanggal2' => date('Y-m-d H:i:s'),
            'aktif' => $aktif,
            'edit' => $edit,
        );
        $this->db->trans_start();   
        $this->db->where('id',$id_foto); 
        $this->db->update('tb_foto',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else   
            $this->db->trans_commit();       
    }

    public function deleteFoto($tabel, $id){ 
        $result = $this->model_public->QueryMultyValue("SELECT * from tb_foto where tabel='$tabel' and id_konten='$id'");
        foreach ($result as $row){
            $id_foto = $row->id;
            $foto = $row->foto;
            $foto = './'.$foto;
            if (!$foto == ""){
                if(file_exists($foto)){
                    unlink($foto);
                    $this->db->where('id', $id_foto);
                    $this->db->delete('tb_foto');

                    //delete thumbnail foto
                    $tahun = date('Y',strtotime($row->tanggal));
                    $bulan = date('m',strtotime($row->tanggal));
                    $this->deleteThumbnailFoto($row->foto,$tahun,$bulan);
                }
                else{
                    $this->db->where('id', $id_foto);
                    $this->db->delete('tb_foto');    
                }         
            } 
        } 
    }

    public function uploadFile($control, $judul, $teks_file, $id_kat, $tabel, $id_konten, $aktif, $entri) { 
        $file = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_file");
        $id_file= $file->id_max + 1;

        $config = array(
                   'allowed_types' => 'pdf|doc|docx|xlsx',
                   'upload_path' => realpath('./media/files/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 10240,
                );

        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();

        if($this->upload->do_upload('dokumen'))
        {
            $file1      = $this->upload->data();
            $file2      = $file1['file_name'];
            $nama_file  = $file2;            
            $ukuran     = $file1['file_size'];
            $dokumen    = 'media/files/'.date('Y').'/'.date('m').'/'.$file2;

            $data = array(
                'id' => $id_file,
                'judul' => $judul,
                'dokumen' =>  $dokumen,
                'nama_file' => $nama_file,
                'ukuran' => $ukuran,
                'isi' => $teks_file,
                'id_kat' => $id_kat,
                'tabel' => $tabel,
                'id_konten' => $id_konten,
                'hari' => date('W'),
                'tanggal' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'entri' => $entri
            );
            $this->db->trans_start();
            $this->db->insert('tb_file', $data);
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else   
                $this->db->trans_commit();
        }
        else{
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data file gagal diupload';
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'ulangi';
            $status_property['url_process'] = base_url().$control.'/edit/'.$id_konten;
            $this->model_public->messaga_status_user($status_property);
            redirect($control.'/view/');
        }
    }

    public function updateFile($control, $judul, $teks_file, $id_kat, $tabel, $id_file, $aktif, $edit) { 
        $config = array(
                   'allowed_types' => 'pdf|doc|docx|xlsx',
                   'upload_path' => realpath('./media/files/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 10240,
                );

        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();

        if($this->upload->do_upload('dokumen'))
        {
            $file1      = $this->upload->data();
            $file2      = $file1['file_name'];
            $nama_file  = $file2;            
            $ukuran     = $file1['file_size'];
            $dokumen    = 'media/files/'.date('Y').'/'.date('m').'/'.$file2;

            $data = array(
                'id' => $id_file,
                'judul' => $judul,
                'dokumen' =>  $dokumen,
                'nama_file' => $nama_file,
                'ukuran' => $ukuran,
                'isi' => $teks_file,
                'id_kat' => $id_kat,
                'tanggal2' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'edit' => $edit,
            );
            $this->db->trans_start();   
            $this->db->where('id',$id_file); 
            $this->db->update('tb_file',$data); 
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else   
                $this->db->trans_commit();
        }
        else{
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data file gagal diupload';
            $status_property['error_message'] = 'alert-warning';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] ='';
            $this->model_public->messaga_status_user($status_property);
            redirect($control.'/view/');
        }
    }

    public function updateDataFile($control, $judul, $teks_file, $id_kat, $tabel, $id_file, $aktif, $edit) { 
        $data = array(
            'id' => $id_file,
            'judul' => $judul,
            'isi' => $teks_file,
            'id_kat' => $id_kat,
            'tanggal2' => date('Y-m-d H:i:s'),
            'aktif' => $aktif,
            'edit' => $edit,
        );
        $this->db->trans_start();   
        $this->db->where('id',$id_file); 
        $this->db->update('tb_file',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else   
            $this->db->trans_commit();       
    }

    public function deleteFile($tabel, $id){ 
        $result = $this->model_public->QueryMultyValue("SELECT * from tb_file where tabel='$tabel' and id_konten='$id'");
        foreach ($result as $row){
            $id_file = $row->id;
            $dokumen = $row->dokumen;
            $dokumen = './'.$dokumen;
            if (!$dokumen == ""){
                if(file_exists($dokumen)){
                    unlink($dokumen);
                    $this->db->where('id', $id_file);
                    $this->db->delete('tb_file'); 
                }
                else{
                    $this->db->where('id', $id_file);
                    $this->db->delete('tb_file'); 
                }           
            } 
        } 
    }

    public function updateVideo($control, $preview, $judul, $teks_video, $id_kat, $tabel, $id_file, $aktif, $tag, $edit) { 
        $config = array(
                   'allowed_types' => 'flv|mp4',
                   'upload_path' => realpath('./media/videos/'.date('Y').'/'.date('m').'/'),
                   'max_size' => 512000,
                );

        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();

        if($this->upload->do_upload('video'))
        {
            $file1      = $this->upload->data();
            $file2      = $file1['file_name'];
            $nama_video  = $file2;            
            $ukuran     = $file1['file_size'];
            $video    = 'media/videos/'.date('Y').'/'.date('m').'/'.$file2;

            $data = array(
                'id' => $id_file,
                'preview' => $preview,
                'judul' => $judul,
                'video' =>  $video,
                'nama_video' => $nama_video,
                'ukuran' => $ukuran,
                'isi' => $teks_video,
                'id_kat' => $id_kat,
                'tag' => $tag,
                'tanggal2' => date('Y-m-d H:i:s'),
                'aktif' => $aktif,
                'edit' => $edit,
            );
            $this->db->trans_start();   
            $this->db->where('id',$id_file); 
            $this->db->update('tb_video',$data); 
            $this->db->trans_complete();    

            if ($this->db->trans_status()==false)
                $this->db->trans_rollback();
            else   
                return true;
        }
        else{
            return false;
        }
    }

    public function updateDataVideo($control, $preview, $judul, $teks_video, $id_kat, $tabel, $id_video, $aktif, $tag, $edit) { 
        $data = array(
            'id' => $id_video,
            'preview' => $preview,
            'judul' => $judul,
            'isi' => $teks_video,
            'tag' => $tag,
            'id_kat' => $id_kat,
            'tanggal2' => date('Y-m-d H:i:s'),
            'aktif' => $aktif,
            'edit' => $edit,
        );
        $this->db->trans_start();   
        $this->db->where('id',$id_video); 
        $this->db->update('tb_video',$data); 
        $this->db->trans_complete();    

        if ($this->db->trans_status()==false)
            $this->db->trans_rollback();
        else   
            $this->db->trans_commit();       
    }

    public function getDisplay($id_kat){
        $data = $this->model_public->QueryMultyValue("SELECT 
                                                        tb_display.judul as judul,
                                                        tb_display.isi as isi,
                                                        tb_foto.foto as foto
                                                    from tb_display, tb_foto
                                                    where tb_foto.id_konten = tb_display.id
                                                    and tb_foto.tabel ='tb_display'
                                                    and tb_display.id_kat = '$id_kat'
                                                    and tb_display.aktif ='1'
                                                    order by tb_display.no_urut asc");
        return $data;
    }

    //dipakai
    public function getTransportasi($id_kat){
        $data = $this->model_public->QueryMultyValue("SELECT 
                                                        a.*,
                                                        b.*
                                                    from tb_transportasi a, tb_kattransportasi b
                                                    where a.id_kat = b.id
                                                    order by a.no_urut ASC");
        return $data;
    }

    public function getDataT($id){
        $data = $this->model_public->QueryMultyValue("SELECT 
                                                        a.*,
                                                        b.*
                                                    from tb_transportasi a, tb_kattransportasi b
                                                    where 
                                                        a.id_kat = b.id
                                                    and
                                                        a.id ='$id'");
        return $data;
    }

    public function createFolderFoto(){
        $tahun  = date('Y');
        $bulan  = date('m');

        $dir1   = './media/fotos/'. $tahun;
        $dir2   = './media/fotos/'. $tahun . '/' . $bulan;
        $dir3   = './media/fotos/'. $tahun . '/' . $bulan . '/thumbnail';

        if( is_dir($dir1) === false )
            mkdir($dir1);

        if( is_dir($dir2) === false )
            mkdir($dir2);

        if( is_dir($dir3) === false )
            mkdir($dir3);
    }

    public function createFolderFile(){
        $tahun  = date('Y');
        $bulan  = date('m');

        $dir1   = './media/files/'. $tahun;
        $dir2   = './media/files/'. $tahun . '/' . $bulan;

        if( is_dir($dir1) === false )
            mkdir($dir1);

        if( is_dir($dir2) === false )
            mkdir($dir2);
    }

    public function createFolderVideo(){
        $tahun  = date('Y');
        $bulan  = date('m');

        $dir1   = './media/videos/'. $tahun;
        $dir2   = './media/videos/'. $tahun . '/' . $bulan;
        $dir3   = './media/videos/'. $tahun . '/' . $bulan . '/preview';

        if( is_dir($dir1) === false )
            mkdir($dir1);

        if( is_dir($dir2) === false )
            mkdir($dir2);

        if( is_dir($dir3) === false )
            mkdir($dir3);
    }

    public function getPagination($perpage,$offset,$siteurl,$total_rows,$uri_segment){;
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;
        $config['num_links'] = 5;   
        $config['uri_segment'] = $uri_segment;   
        $config['full_tag_open'] = '<ul class="pagination pagination-circle pg-blue justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '← Prev';
        $config['prev_tag_open'] = '<li class="page-item prev" >';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);        
        $data = $this->pagination->create_links();
        return $data;
    }

    public function validateCheckbox($control){
        $check = $this->input->post('checkbox',true);        
        if ( $check == ""){
            $status_property['parameter'] = 'view';
            $status_property['message'] = 'data belum dipilih';
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = '';
            $status_property['url_process'] = '';
            $this->model_public->messaga_status_user($status_property);
            redirect($control.'/view'); 
        }
    }

    public function resizeFoto($foto,$min_size,$max_size){
        $location = './media/fotos/'.date('Y').'/'.date('m').'/';
        $image_size = getimagesize($location.$foto);
        $width = $image_size[0];
        $height = $image_size[1];

        $resize['source_image'] = $location.$foto;
        $resize['maintain_ratio'] = TRUE;
        
        if ($width > $height){                   
            $resize['width'] = $max_size;      
            $resize['height'] = $min_size; 
        }
        else { 
            $resize['width'] = $min_size;             
            $resize['height'] = $max_size;
        }

        $this->image_lib->initialize($resize);
        if (!$this->image_lib->resize()) {
            echo 'resize foto gagal' . $this->image_lib->display_errors();
        }
    }

    public function createThumbnailFoto($foto) {
        $tahun = date('Y');
        $bulan = date('m');
        $config['source_image'] = './media/fotos/'.$tahun.'/'.$bulan.'/'.$foto;
        $config['new_image'] = './media/fotos/'.$tahun.'/'.$bulan.'/thumbnail/'.$foto;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 400;
        $config['height'] = 285;
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            echo 'create thumbnail foto gagal' . $this->image_lib->display_errors();
        }
    }

    public function deleteThumbnailFoto($foto,$tahun,$bulan) {
        $folder = 'media/fotos/'.$tahun.'/'.$bulan.'/';
        $temp_array = explode($folder,$foto);
        $thumbnail = './media/fotos/'.$tahun.'/'.$bulan.'/thumbnail/'.$temp_array[1];
        if(file_exists($thumbnail)){
            unlink($thumbnail);
        }
    }

    public function createPreviewVideo(){
        $config = array(
           'allowed_types' => 'jpg|jpeg|gif|png',
           'upload_path' => realpath('./media/videos/'.date('Y').'/'.date('m').'/preview/'),
           'max_size' => 10240,
        );
        $this->load->library('upload');
        $this->upload->initialize($config); 
        $this->upload->do_upload();          
        if($this->upload->do_upload('foto')){  
            $data  = $this->upload->data();
            $name  = $data['file_name'];
            $preview = 'media/videos/'.date('Y').'/'.date('m').'/preview/'.$name;
            return $preview;
        }
    }  

    public function deletePreviewVideo($preview) {
        $preview = './'.$preview;
        if(file_exists($preview)){
            unlink($preview);
        }
    }

    public function alertSuccess($control,$status,$id){
        $status_property['parameter'] = 'view';
        $status_property['message'] = 'data sukses disimpan';
        $status_property['error_message'] = 'alert-success';
        $status_property['status_message'] = $status;
        $status_property['url_process'] = base_url().$control.'/edit/'.$id;
        $this->model_public->messaga_status_user($status_property);  
    }

    public function dataflash($setdata){
        foreach ($setdata as $field => $data): 
            $this->session->set_flashdata($field,$data);
        endforeach;
    }
    
}
?>