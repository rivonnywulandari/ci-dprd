<?php

class Model_home extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
        $this->mydb1 = $this->load->database('default',TRUE);
    } 

    public function getMeta($modul){
        $config = $this->model_public->QuerySingleValue("SELECT * from tb_contact");
  
        $id     = abs($this->uri->segment(4,0));

        if ($id > 0 and !$modul==""){
            $function = $this->router->fetch_method();
            $tabel = 'tb_'.$modul;
            $cek_tabel = $this->db->get($tabel);
            $content = $this->model_public->QuerySingleValue("SELECT * from $tabel where id='$id'");
            if (isset($content->judul)){
                $judul = $content->judul;         
                $data['title']      = $content->judul.' - '.$config->nama; 
                $data['keyword']    = $content->judul.', '.$config->keyword;
                $data['foto']       = site_url().$this->master->getDataFoto('foto',$tabel,$id);
            }
            else{
                $data['title']      = $config->nama; 
                $data['keyword']    = $config->keyword;
                $data['foto']       = '';
            }
        }
        else if (!$modul==""){    
            $modul = ucfirst(strtolower($modul));
            $data['title']      = $modul.' - '.$config->nama; 
            $data['keyword']    = $modul.', '.$config->keyword;
            $data['foto']       = '';
        }
        else{
            $data['title']      = $config->nama; 
            $data['keyword']    = $config->keyword;
            $data['foto']       = '';
        }
        return  $data;
    }

    public function getSearchContent($cari)
    {
        $database = $this->db->database;
        $array_group = array(null);  
        $jumlah_array = 0;
        $i = 0;

        if (!$cari == "")
        {   
            $tabel = array('tb_berita','tb_pengumuman','tb_informasi','tb_artikel','tb_profil','tb_file','tb_anggaran');

            foreach ($tabel as $key=> $value){  
                $table_name = $value;
                $temp_array = explode('tb_',$table_name);
                $modul = $temp_array[1];
                $search = $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM $table_name
                                                                WHERE aktif = '1' 
                                                                and (judul like '%$cari%' or  isi like '%$cari%')
                                                                limit 10 ");
                foreach ($search as $row_search):
                    $i++;        
                    $array = array(
                                    'id'=>$row_search->id,
                                    'judul'=>$row_search->judul,
                                    'hari'=>$row_search->hari,
                                    'tanggal'=>$row_search->tanggal,
                                    'isi'=>$row_search->isi,
                                    'modul'=>$modul,
                                    'tabel'=>$table_name
                                );                   
                    array_push($array_group,$array);                  
                endforeach;
                $jumlah_array = $i;
            }

            //save pencarian
            $this->model_public->saveSearch($cari,$jumlah_array);
        }

        $perpage = 10;
        $offset = abs($this->uri->segment(3,0));
        $siteurl = site_url('home/search/');
        $total_rows = $jumlah_array;        
        $uri_segment = 3;
        $data['pagination'] = $this->master->getPagination($perpage,$offset,$siteurl,$total_rows,$uri_segment);
        $data['offset']     = abs($offset);
        $data['total_rows'] = $total_rows;

        $data['cari']       = $cari;
        $data['array_group']= array_slice($array_group, $offset+1,$perpage);

        if ($cari == ""){
            $this->breadcrumb->add(' Home ', base_url());
            $this->breadcrumb->add(' Pencarian ', base_url().'home/'.$cari);      
            $data['null'] = "Silahkan melakukan pencarian data !!!";
            $this->session->set_flashdata('cari',null);
        }
        else{            
            $this->breadcrumb->add(' Home ', base_url());
            $this->breadcrumb->add(' '.ucfirst($cari).' ', base_url().'home/'.$cari);
            $data['null'] = "tidak ditemukan !!!";
            $this->session->set_flashdata('cari',$cari);
        }
        return $data;
    }

    public function tambahFormulirPermohonan($modul, $search)
    {
        
        $database = $this->db->database;
        $array_group = array(null);  
        $jumlah_array = 0;
        $i = 0;
         
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' Formulir Permohonan ', base_url().'home/'.$search);      


        //content sidebarr
        $tabel  = 'tb_'.$modul; 
        $data['modul']     = $modul;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']    =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();
       
        return $data;
       
    }

    public function kirimFormulirPermohonan()
    {
        $data = [
            "nama_pemohon_informasi" => $this->input->post('nama_pemohon_informasi', true),
            "ktp_pemohon" => $this->input->post('ktp_pemohon', true),
            "alamat_pemohon" => $this->input->post('alamat_pemohon', true),
            "nohp_pemohon" => $this->input->post('nohp_pemohon', true),
            "email_pemohon" => $this->input->post('email_pemohon', true),
            "informasi_yang_dibutuhkan" => $this->input->post('informasi_yang_dibutuhkan', true),
            "alasan_permintaan" => $this->input->post('alasan_permintaan', true),
            "nama_pengguna_informasi" => $this->input->post('nama_pengguna_informasi', true),
            "ktp_pengguna" => $this->input->post('ktp_pengguna', true),
            "alamat_pengguna" => $this->input->post('alamat_pengguna', true),
            "nohp_pengguna" => $this->input->post('nohp_pengguna', true),
            "email_pengguna" => $this->input->post('email_pengguna', true),
            "alasan_penggunaan_informasi" => $this->input->post('alasan_penggunaan_informasi', true),
            "cara_memperoleh_informasi" => $this->input->post('cara_memperoleh_informasi', true),
            "format_bahan_informasi" => $this->input->post('format_bahan_informasi', true),
            "cara_mengirim_bahan_informasi" => $this->input->post('cara_mengirim_bahan_informasi', true),
            "tanggal_pengajuan" => $this->input->post('tanggal_pengajuan', true)

        ];

        $this->db->insert('tb_formulir_permohonan', $data);
    }


    public function getCategoryContent($modul,$id_kat,$head)
    {
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' '.$head.' ', base_url().'home/'.$modul);
        $this->breadcrumb->add(' '.$this->master->getData('nama','tb_kat'.$modul,'id',$id_kat), base_url());

        $tabel = 'tb_'.$modul;
        $tabelkat = 'tb_kat'.$modul;

        $perpage = 10;       
        $offset  = abs($this->uri->segment(5,0));
        $siteurl = site_url('home/'.$modul.'/'.$id_kat.'/0/');
        /*----------------------*/
        $total_rows = $this->model_public->QueryNumRows("SELECT * from ".$tabel." where id_kat=".$id_kat." and aktif='1'");
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;
        $config['num_links'] = 5;   
        $config['uri_segment'] = 5;   
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
        /*----------------------*/

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM $tabel
                                                                WHERE id_kat = '$id_kat'
                                                                AND aktif = '1'
                                                                ORDER BY id desc
                                                                limit ".$perpage." offset ".$offset );

        $data['pagination'] = $this->pagination->create_links();
        $data['offset']     = $offset;
        $data['total_rows'] = $total_rows;

        if (!$data['data'])
            redirect('home');

        $data['id_kat']     = $id_kat;
        $data['tabel']      = $tabel;
        $data['tabelkat']   = $tabelkat;
        $data['modul']      = $modul;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']            =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }

    public function getListContent($modul,$head)
    {
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' '.$head.' ', base_url().'home/'.$modul);

        $tabel = 'tb_'.$modul;
        $tabelkat = 'tb_kat'.$modul;

        $perpage = 10;       
        $offset  = abs($this->uri->segment(5,0));
        $siteurl = site_url('home/'.$modul.'/0/0/');
        /*----------------------*/
        $total_rows = $this->model_public->QueryNumRows("SELECT * from ".$tabel." where aktif='1'");
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;
        $config['num_links'] = 5;   
        $config['uri_segment'] = 5;   
        $config['full_tag_open'] = '<ul class="pagination pagination-circle pg-blue justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '← Prev';
        $config['prev_tag_open'] = '<li class="page-item prev">';
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
        /*----------------------*/

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM $tabel
                                                                WHERE aktif = '1'
                                                                ORDER BY id desc
                                                                limit ".$perpage." offset ".$offset );

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['total_rows'] = $total_rows;

        if (!$data['data'])
            redirect('home');

        $data['tabel']      = $tabel;
        $data['tabelkat']   = $tabelkat;
        $data['modul']      = $modul;        
        $data['head']       = $head;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']    =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }


    public function getListTransportasi($modul,$head)
    {
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' '.$head.' ', base_url().'home/'.$modul);

        $tabel = 'tb_'.$modul;
        $tabelkat = 'tb_kat'.$modul;

        $perpage = 10;       
        $offset  = $this->uri->segment(5,0);
        $siteurl = site_url('home/'.$modul.'/0/0/');
        /*----------------------*/
        $total_rows = $this->model_public->QueryNumRows("SELECT * from ".$tabel." where aktif='1'");
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;
        $config['num_links'] = 5;   
        $config['uri_segment'] = 5;   
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
        /*----------------------*/

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM $tabel
                                                                WHERE aktif = '1'
                                                                ORDER BY id desc
                                                                limit ".$perpage." offset ".$offset );

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['total_rows'] = $total_rows;

        if (!$data['data'])
            redirect('home');

        $data['tabel']      = $tabel;
        $data['tabelkat']   = $tabelkat;
        $data['modul']      = $modul;        
        $data['head']       = $head;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']            =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }

    public function getDetailContentTransportasi($modul,$id,$head)
    {
        
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' '.$head.' ', base_url().'home/'.$modul);
        $this->breadcrumb->add(' '.$this->master->getData('judul','tb_'.$modul,'id',$id), base_url());

        $tabel  = 'tb_'.$modul;  

        $this->master->hitContent($tabel,$id);        

        $data['detail'] =  $this->model_public->QuerySingleValue("SELECT 
                                                                        *                                                                                                                             
                                                                    FROM $tabel
                                                                    WHERE id = '$id'
                                                                    AND aktif = '1'"); 

        if (!$data['detail'])
            redirect('home');

        $data['lainnya'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                        *                                                                                                                             
                                                                    FROM $tabel
                                                                    WHERE aktif = '1'
                                                                    AND id <> '$id'
                                                                    ORDER BY id desc
                                                                    limit 0,6"); 

        if ($modul == "foto" || $modul == "file"){
            $data['id_konten'] = $this->master->getData('id_konten',$tabel,'id',$id); 
            $data['tabel']     = $this->master->getData('tabel',$tabel,'id',$id); 
        }
        else{
            $data['id_konten'] = $data['detail']->id;  
            $data['tabel']     = $tabel;
        }                  
        $data['modul']     = $modul;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']    =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }

    public function getDetailContent($modul,$id,$head)
    {
        
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' '.$head.' ', base_url().'home/'.$modul);
        $this->breadcrumb->add(' '.$this->master->getData('judul','tb_'.$modul,'id',$id), base_url());

        $tabel  = 'tb_'.$modul;  

        $this->master->hitContent($tabel,$id);        

        $data['detail'] =  $this->model_public->QuerySingleValue("SELECT 
                                                                        *                                                                                                                             
                                                                    FROM $tabel
                                                                    WHERE id = '$id'
                                                                    AND aktif = '1'"); 

        if (!$data['detail'])
            redirect('home');

        $data['lainnya'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                        *                                                                                                                             
                                                                    FROM $tabel
                                                                    WHERE aktif = '1'
                                                                    AND id <> '$id'
                                                                    ORDER BY id desc
                                                                    limit 0,6"); 

        if ($modul == "foto" || $modul == "file"){
            $data['id_konten'] = $this->master->getData('id_konten',$tabel,'id',$id); 
            $data['tabel']     = $this->master->getData('tabel',$tabel,'id',$id); 
        }
        else{
            $data['id_konten'] = $data['detail']->id;  
            $data['tabel']     = $tabel;
        }                  
        $data['modul']     = $modul;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']    =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }    

    public function getHome()
    {
        $data['gubernur']     = $this->master->getData('foto','tb_foto','id','24');

        $data['total_berita'] = $this->master->countData('tb_berita','aktif','1');
        
        $perpage = 5;
        $offset = abs($this->uri->segment(3,0));

        $data['berita_terbaru'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                            *                                                                                                                             
                                                                        FROM tb_berita
                                                                        WHERE aktif = '1'
                                                                        ORDER BY id desc
                                                                        limit ".$perpage." offset ".$offset );

        $siteurl = site_url('home/index/');
        $total_rows = $this->master->countData('tb_berita','aktif','1');        
        $uri_segment = 3;
        $data['pagination'] = $this->master->getPagination($perpage,$offset,$siteurl,$total_rows,$uri_segment);
        $data['offset']     = abs($offset);
        $data['total_rows'] = $total_rows; 

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(0,0,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']            =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();
        $data['pimpinan']           =  $this->pimpinan();
        return $data;
    }


    public function berita_lain($perpage,$offset){
        $data =  $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                        FROM tb_berita
                                                        WHERE aktif = '1'
                                                        ORDER BY hit desc
                                                        limit ".$perpage." offset ".$offset );


        return $data;
    }

    public function berita_populer(){
        $data =  $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                        FROM tb_berita
                                                        WHERE aktif = '1'
                                                        ORDER BY hit desc
                                                        limit 6");


        return $data;
    }

    public function artikel(){
        $data = $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                    FROM tb_artikel
                                                    WHERE aktif = '1'
                                                    ORDER BY id desc
                                                    limit 6"); 


        return $data;
    }

    public function foto_utama(){
        $data = $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                    FROM tb_foto
                                                    WHERE aktif = '1'
                                                    AND (id_kat='1' or id_kat='2' or id_kat='3')
                                                    ORDER BY id desc
                                                    limit 6"); 

        return $data;
    }

    public function pengumuman(){
        $data = $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                    FROM tb_pengumuman
                                                    WHERE aktif = '1'
                                                    ORDER BY id desc
                                                    limit 6"); 

        return $data;
    }

    public function download(){
        $data = $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                    FROM tb_file
                                                    WHERE aktif = '1'
                                                    AND id_kat = '2'
                                                    ORDER BY id desc
                                                    limit 3"); 

        return $data;
    }

    public function pimpinan(){
        $data = $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                    FROM tb_pimpinan
                                                    WHERE aktif = '1'
                                                    ORDER BY no_urut asc
                                                    limit 6"); 

        return $data;
    }

    public function tb_pimpin()
    {
        $data['profil'] = $this->model_public->QueryMultyValue("SELECT *                                                                                                                             
                                                    FROM tb_pimpin
                                                    WHERE aktif = '1'
                                                    ORDER BY no_urut asc
                                                    limit 6"); 

        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']    =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }

    public function visitor(){
        $limit_online = time() - 900;
        $online     = $this->model_public->QueryNumRows("SELECT * from tb_visitor where online > '$limit_online'");
        
        $today      = $this->model_public->QueryNumRows("SELECT * 
                                                    from tb_visitor 
                                                    where year(datetime) = '".date('Y')."'
                                                    and month(datetime) = '".date('m')."' 
                                                    and day(datetime) = '".date('d')."'");

        $yesterday  = $this->model_public->QueryNumRows("SELECT * 
                                                    from tb_visitor 
                                                    where year(datetime) = '".date('Y')."'
                                                    and month(datetime) = '".date('m')."' 
                                                    and day(datetime) = '".date('d')."'-1");

        $thismonth  = $this->model_public->QueryNumRows("SELECT * 
                                                    from tb_visitor 
                                                    where year(datetime) = '".date('Y')."'
                                                    and month(datetime) = '".date('m')."'");

        $thisyear   = $this->model_public->QueryNumRows("SELECT * 
                                                    from tb_visitor 
                                                    where year(datetime) = '".date('Y')."'"); 
        
        $total      = $this->model_public->QueryNumRows("SELECT * from tb_visitor");

        $hit        = $this->model_public->QuerySingleValue("SELECT sum(hit) as jumlah from tb_visitor");

        $data['online'] = $online;
        $data['today'] = $today;
        $data['yesterday'] = $yesterday;
        $data['thismonth'] = $thismonth;
        $data['thisyear'] = $thisyear;
        $data['total'] = $total;
        $data['hit'] = $hit->jumlah;

        return $data;
    }


    public function anggota($modul,$head)
    {
       
        $this->breadcrumb->add(' Home ', base_url());
        $this->breadcrumb->add(' '.$head.' ', base_url().'home/'.$modul);

        $tabel = 'tb_'.$modul;
        //$tabelkat = 'tb_kat'.$modul;

        $perpage = 10;       
        $offset  = $this->uri->segment(5,0);
        $siteurl = site_url('home/'.$modul.'/0/0/');
        /*----------------------*/
        $total_rows = $this->model_public->QueryNumRows("SELECT * from ".$tabel." where aktif='1'");
        $offset = abs($offset);
        $this->load->library('pagination');
        $config['base_url'] = $siteurl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;
        $config['num_links'] = 5;   
        $config['uri_segment'] = 5;   
        $config['full_tag_open'] = '<ul class="pagination pagination-circle pg-blue justify-content-center">';
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
        $config['cur_tag_open'] = '<li class="page-item active"><a clas="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        /*----------------------*/

        $data['data'] =  $this->model_public->QueryMultyValue("SELECT 
                                                                    *                                                                                                                             
                                                                FROM $tabel
                                                                WHERE aktif = '1'
                                                                ORDER BY id desc
                                                                limit ".$perpage." offset ".$offset );

        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;
        $data['total_rows'] = $total_rows;

        if (!$data['data'])
            redirect('home');

        $data['tabel']      = $tabel;
        //$data['tabelkat']   = $tabelkat;
        $data['modul']      = $modul;        
        $data['head']       = $head;

        //content lainnya
        $data['berita_lain']        =  $this->berita_lain(2,6);
        $data['berita_populer']     =  $this->berita_populer();
        $data['artikel']    =  $this->artikel(); 
        $data['foto_utama']         =  $this->foto_utama();
        $data['pengumuman']         =  $this->pengumuman();
        $data['download']           =  $this->download();

        return $data;
    }

    public function name_fraksi($id)
    {
        $query = $this->mydb1->query("SELECT 
                                            nama as exist
                                    FROM 
                                            tb_fraksi
                                    WHERE 
                                            id = '$id'");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function name_badan($id)
    {
        $query = $this->mydb1->query("SELECT 
                                            nama as exist
                                    FROM 
                                            tb_badan
                                    WHERE 
                                            id = '$id'");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }
}
?>