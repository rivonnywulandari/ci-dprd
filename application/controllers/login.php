<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('format_login');
        $this->load->model('model_list');
    }

	public function index()
	{
		
		$session_value = $this->session->userdata('mysession');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$cek_aktif = $this->model_public->QuerySingleValue("select count(id_session) as cek_row from _session_login where session_value = '$session_value' and ip_login = '$ip' and status = 'A' ");
		
		if($cek_aktif->cek_row == 1)
		{
			redirect('dashboard');
		}
		else
		{		
			$this->load->view('login/login');
		}
		
	}

	public function proses_login()
	{
		date_default_timezone_set('Asia/Jakarta');

		$date_now = date('Y-m-d H:i:s');

        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];

		$username = $this->format_login->antiinjection($this->input->post('username'));
		$password = $this->format_login->antiinjection($this->input->post('password'));
		
		$user = $this->model_public->QuerySingleValue("select 
													COUNT(username) as ct,
													username, COUNT(id_user) as ctp,
													id_user
												FROM
													_user
												WHERE
													username = '$username'
												and
													password = md5(md5('$password'))
												and 
													aktif = '1' ");

		if(is_null($user)==FALSE)
		{      
			if($user->ct == 1)
			{   
				$id_user= $user->id_user;
				$date_array = getdate();        
				$session_time = date('c',$date_array[0]);
				$return_session = '0';
				$encrypst = $this->model_public->QuerySingleValue("select md5('$session_time') as session");
				if (is_null($encrypst) == FALSE)
				   $return_session=$encrypst->session; 
			
				$session = array('mysession' => $return_session); 

				$this->session->set_userdata($session);

				$penguna = $this->model_public->QuerySingleValue("select id_user from _user where id_user = '$id_user' ");
 
				if(is_null($user) == FALSE)
					$id_user = $user->id_user;
				
				$this->db->query("update _session_login set status = 'N' where id_user = '$id_user' ");  

				$this->db->query("insert into _session_login values (0,'$id_user','$date_now', 'A', '$ip', '$browser', '$return_session')");

				$this->format_login->login_validate();

				redirect('dashboard');                       
			}
			else
			{
				$status_property['parameter'] = 'akses_validasi';
				$status_property['message'] = 'Username dan Password anda salah!!';
				$status_property['error_message'] = 'alert-warning';
				$status_property['status_message'] = 'validation';
				$status_property['url_process'] = '';  
				$this->model_public->messaga_status($status_property); 
				redirect('login');
			}
		} 
	}
	
	public function logout(){
		if(!isset($_SESSION)) 
	        session_start(); 
	   
		unset($_SESSION['expires_by']);
			
		$session_value = $this->session->userdata('mysession');

		$this->db->query("update _session_login set status = 'N' where session_value = '$session_value' ");  

		$this->session->sess_destroy();
		session_unset();
		session_destroy();
		redirect(site_url().'login');
	}
	  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */