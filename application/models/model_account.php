<?php

class Model_account extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_ganti_password($session_value)
    { 
		$session_login = $this->model_public->QuerySingleValue("SELECT id_user 
																from _session_login 
																where session_value = '$session_value'");

		$id_user = $session_login->id_user;
		
		$user =  $this->model_public->QuerySingleValue("SELECT _user.password as password																															
													  FROM _user
													  WHERE _user.id_user = '$id_user' ");  
															
		$password_lama = $user->password;		
		
		$lama 		= md5(md5($this->input->post('lama')));
		$baru 		= md5(md5($this->input->post('baru')));
		$konfirmasi	= md5(md5($this->input->post('konfirmasi')));
		
		if ($password_lama == $lama)
		{
			if ($baru == $konfirmasi)
			{
				$this->db->trans_start();
				
				$this->db->query("update _user set password = '$baru' where id_user = '$id_user' ");
			
				$this->db->trans_complete();    

				
				if ($this->db->trans_status()==false)
					$this->db->trans_rollback();
				else
				{   
					$this->db->trans_commit();
					
					$status_property['parameter'] = 'password';
					$status_property['message'] = 'ganti password berhasil';
					$status_property['error_message'] = 'alert-success';
					$status_property['status_message'] = 'validation';
					$status_property['url_process'] = '';  
					$this->model_public->messaga_status_user($status_property); 
					
					redirect('account/password');
				
				} 

				
			}
			else{
				$status_property['parameter'] = 'password';
				$status_property['message'] = 'konfirmasi password baru salah';
				$status_property['error_message'] = 'alert-danger';
				$status_property['status_message'] = 'validation';
				$status_property['url_process'] = '';  
				$this->model_public->messaga_status_user($status_property); 
				redirect('account/password'); 				
			}
		}
		else
		{
			$status_property['parameter'] = 'password';
            $status_property['message'] = 'password lama yang dimasukan salah';
            $status_property['error_message'] = 'alert-danger';
            $status_property['status_message'] = 'validation';
            $status_property['url_process'] = '';  
            $this->model_public->messaga_status_user($status_property); 
            redirect('account/password'); 
		}
	}
}  
?>