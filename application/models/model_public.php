<?php

class Model_public extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        
    }   

    public function QueryMultyValue($tquery){           
        $query = $this->db->query($tquery);
            
        if ($query->num_rows() > 0)     
                return $query->result();                
        else 
                return array(); 
    }
    
    public function QuerySingleValue($tquery){                
        $query = $this->db->query($tquery);
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)                      
            return $row;
        }
        else
            return  NULL;
    } 
	
	public function QueryNumRows($tquery){                
        $query = $this->db->query($tquery);
        $data = $query->num_rows();
        
		return  $data;
    } 

    public function conv_validasi_to_indonesia(){
        
        $this->form_validation->set_message('required','*field %s wajib diisi.');
        $this->form_validation->set_message('min_length','*field %s sekurang-kurangnya harus berisi %s karakter.');
        $this->form_validation->set_message('max_length','*field %s tidak boleh lebih dari %s karakter.');
        $this->form_validation->set_message('valid_email','*field %s harus berisi alamat email yang valid.');
        $this->form_validation->set_message('numeric','*field %s harus bernilai numeric yang valid.');
        $this->form_validation->set_message('integer','*field %s harus bernilai integer yang valid.');
    } 
	
	public function messaga_status($status_property)
    {
        $view_status = "";
        $view_url = "";

        $parameter = $status_property['parameter'];
        $message = $status_property['message'];
        $error_message = $status_property['error_message'];

        $status_message = $status_property['status_message'];
        $url_process = $status_property['url_process'];

        if(($status_message == "save")||($status_message == "edit"))
        {
            $view_status = "Edit";
            $view_url = $url_process;
        }
        
        $view_message = '<div class="alert '.$error_message.'"><button style="margin-top:0px;" class="close" data-dismiss="alert">&times;</button><p>'.$message.'</p></div>';
						
        $this->session->set_flashdata($parameter,$view_message);
    }
	
	public function messaga_status_user($status_property)
    {
        $view_status = "";
        $view_url = "";

        $parameter = $status_property['parameter'];
        $message = $status_property['message'];
        $error_message = $status_property['error_message'];

        $status_message = $status_property['status_message'];
        $url_process = $status_property['url_process'];

        if(($status_message == "save")||($status_message == "edit"))
        {
            $view_status = "Edit";
            $view_url = $url_process;
        }
        else if(($status_message == "ulangi"))
        {
            $view_status = "Ulangi";
            $view_url = $url_process;
        }
						
		$view_message = '<div style="font-size:16px;" class="alert '.$error_message.' fade in"><button class="close" data-dismiss="alert"><span>&times;</span></button>'.$message.' <a href="'.$view_url.'" class="alert-link"><u>'.$view_status.'</u></a></div>';						
        $this->session->set_flashdata($parameter,$view_message);
    }
	
	public function bypass_privilage()
    {
        $class_name = $this->router->fetch_class();

        $white_list = $this->model_public->QuerySingleValue("SELECT count(*) as exist from _white_list where control_name = '$class_name' and status = 'A' ");
     
        if(is_null($white_list)==false)
        {   
            if($white_list->exist > 0)
            {
                return TRUE;
            }
        }

        return false;
    }
	
	public function privelage()
    {
        $class_name = $this->router->fetch_class();
        $function = $this->router->fetch_method();
        
        if( (($class_name == 'login')&&($function == "index"))||
            (($class_name == 'login')&&($function == "redirect"))||
            (($class_name == 'login')&&($function == "proses_login"))
           )             return TRUE;
        
        $session_value = $this->session->userdata('mysession');

       // echo $sessionvalue;
        $mysession = $this->model_public->QuerySingleValue("SELECT count(*) as ct from _session_login where session_value = '$session_value' and status = 'A'");
        
        if(is_null($mysession) == FALSE)
        {
            if($mysession->ct > 0)
                return TRUE;
            else
            {
                return FALSE;
            }
        }
        else
            return FALSE;  
    } 

    public function user_akses($session_value)
    {
        $session_login = $this->model_public->QuerySingleValue("SELECT id_user from _session_login where session_value = '$session_value' and status = 'A'");

        if(is_null($session_login) == false)
        {
            $data = $this->model_public->QuerySingleValue("SELECT
                                                                id_user, nama_user
                                                              from 
                                                                _user
                                                              where 
                                                                id_user = '$session_login->id_user'");
        }

        return $data;
    }

    public function log_aktivitas()
    {
        //clear log aktivitas bulan sebelumnya
        $this->db->query("DELETE from _log_aktivitas where month(tgl_jam) <> '".date('m')."'");

        $class_name = $this->router->fetch_class();
        $function = $this->router->fetch_method();

        date_default_timezone_set('Asia/Jakarta');

        $date_now = date('Y-m-d H:i:s');

        $session_value = $this->session->userdata('mysession');
        $session_login = $this->model_public->QuerySingleValue("SELECT id_user from _session_login where session_value = '$session_value' and status = 'A' ");

        $event="";
        if(is_null($session_login)==false)
        {
            $id_user = $session_login->id_user;

            if (strpos($function, 'save') === 0)
                $event = "save";

            else if (strpos($function, 'update') === 0)
                $event = "update";

            else if (strpos($function, 'delete') === 0)
                $event = "delete";
            else
                $event = "open page";

            $tgl_jam = "";
            $tanggal = "";
            $log = $this->model_public->QuerySingleValue("SELECT tgl_jam from _log_aktivitas 
                                                          where control_name = '$class_name'
                                                          and function_name = '$function'
                                                          and id_user = '$id_user'");
            if(is_null($log)==false)
            {
                $tgl_jam = $log->tgl_jam;

                $waktu = explode(" ",$tgl_jam);
                $tanggal = $waktu[0];
                $jam = $waktu[1];
            }

            if($tanggal == date('Y-m-d'))
            {
                $this->db->trans_start();
                $this->db->query("UPDATE _log_aktivitas set tgl_jam = '$date_now' where id_user = '$id_user' and control_name = '$class_name' and function_name = '$function'");
                $this->db->trans_complete();   

                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else
                { 
                    return TRUE;
                }
            }
            else
            {
                $log = $this->model_public->QuerySingleValue("SELECT max(id_log) as id_max from _log_aktivitas");
                $id_log= $log->id_max + 1; 

                $this->db->trans_start();
                $this->db->query("INSERT into _log_aktivitas values('$id_log','$id_user','$date_now','$class_name','$function','$event','')");
                $this->db->trans_complete();   

                if ($this->db->trans_status()==false)
                    $this->db->trans_rollback();
                else
                { 
                    return TRUE;
                }
            }
           
        }

        return TRUE;
    }
	
	public function cek_uri($id_group)
    {
        $class_name = $this->router->fetch_class();
		
        $role = $this->model_public->QuerySingleValue("SELECT 
                                                            *
                                                        from _module,_group_module 
                                                        where _group_module.id_module = _module.id_module 
                                                        and _group_module.id_group = '$id_group' 
                                                        and _module.module_key = '$class_name'
                                                        and _module.aktif = '1'");
		
        if(is_null($role)==true)
        {
			return false;    
        }

        return true;
    }

    public function relasi_data($data_array,$field,$value)
    {
        $relasi = "";
        foreach ($data_array as $tabel => $keterangan){            
            $cek = $this->model_public->QueryNumRows("SELECT * from $tabel where $field = '$value'"); 
            if ($cek > 0){
                $relasi = $relasi."<i class='fa fa-check'></i>".$keterangan."&nbsp;&nbsp;";                            
            }
        }      
        return $data = $relasi;     
    }

    public function saveVisitor()
    {
             
        $datetime       = date("Y-m-d H:i:s");
        $ip             = $_SERVER['REMOTE_ADDR'];
        $browser        = $_SERVER['HTTP_USER_AGENT'];
        $url            = $_SERVER['PHP_SELF'];
        $browser_md5    = md5($browser);
        $username       = '';
        $online         = time();
        
        $cekVisitor = $this->model_public->QueryNumRows("SELECT 
                                                            * 
                                                        from tb_visitor 
                                                        where ip ='$ip'
                                                        and browser_md5 = '$browser_md5'
                                                        and datetime like '".date('Y-m-d')."%'");

        if ($cekVisitor == 0){
            $visitor = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_visitor");
            $id = $visitor->id_max + 1;
            $data = array(            
                'id' => $id,
                'datetime' => $datetime,
                'ip' => $ip,
                'browser' => $browser,
                'browser_md5' => $browser_md5,
                'url' => $url,
                'username' => $username,
                'online' => $online,
                'hit' => 1
            );
            $this->db->trans_start();
            $this->db->insert('tb_visitor',$data); 
            $this->db->trans_complete(); 
        }
        else{
            $session_value = $this->session->userdata('mysession');
            $session_login = $this->model_public->QuerySingleValue("SELECT _user.username 
                                                                        from _session_login, _user
                                                                        where _user.id_user = _session_login.id_user
                                                                        and session_value = '$session_value' 
                                                                        and status = 'A' ");
            if ($session_login)
                $username = $session_login->username;
            else
                $username = '';

            $url_update = '\n'.$url;
            $this->db->trans_start();
            $this->db->query("UPDATE tb_visitor set 
                                url = concat(url,'$url_update'),
                                username = '$username',
                                online = '$online',
                                hit = hit + 1
                                where ip ='$ip'
                                and browser_md5 = '$browser_md5'
                                and datetime like '".date('Y-m-d')."%'");
            $this->db->trans_complete();
        }          
    }

    public function saveSearch($keyword,$search_result)
    {        
        $datetime       = date("Y-m-d H:i:s");
        $ip             = $_SERVER['REMOTE_ADDR'];
        $browser        = $_SERVER['HTTP_USER_AGENT'];

        $cekSearch = $this->model_public->QueryNumRows("SELECT 
                                                            * 
                                                        from tb_search 
                                                        where ip ='$ip'
                                                        and browser = '$browser'
                                                        and keyword = '$keyword'
                                                        and datetime like '".date('Y-m-d')."%'");
        if ($cekSearch == 0){
            $visitor = $this->model_public->QuerySingleValue("SELECT max(id) as id_max from tb_search");
            $id = $visitor->id_max + 1;
            $data = array(            
                'id' => $id,
                'datetime' => $datetime,
                'ip' => $ip,
                'browser' => $browser,
                'keyword' => $keyword,
                'search_result' => $search_result
            );
            $this->db->trans_start();
            $this->db->insert('tb_search',$data); 
            $this->db->trans_complete(); 
        }         
    }
}
?>
