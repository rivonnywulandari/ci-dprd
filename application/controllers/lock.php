<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lock extends CI_Controller {

	public function __construct(){
        parent::__construct();	
		$this->load->model('model_lock');
        $this->load->library('format_login');
    }
    
	public function index()
	{
		if(!isset($_SESSION)) 
	        session_start(); 
	    
		unset($_SESSION['expires_by']);
		$this->lockscreen();
	}

	private function lockscreen()
	{
		$session_value = $this->session->userdata('mysession');
		$data = $this->model_lock->init_data_lock($session_value);
		$this->load->view('login/lockscreen', $data);
	}
	
	public function proses_unlock()
	{
		date_default_timezone_set('Asia/Jakarta');
		$date_now = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$session_value = $this->session->userdata('mysession');

		$username = $this->format_login->antiinjection($this->input->post('username'));
		$password = $this->format_login->antiinjection($this->input->post('password'));
		
		$user = $this->model_public->QuerySingleValue("select 
															COUNT(_user.username) as ct,
                                                            _user.username,
                                                            _user.id_user
														FROM
															_user, _session_login
														WHERE
															_user.id_user = _session_login.id_user
														and
															_user.username = '$username'
														and
															_session_login.ip_login = '$ip'
														and
															_session_login.status = 'A'
														and
															_session_login.session_value = '$session_value'
														and
															_user.password = md5(md5('$password'))
														and 
															_user.aktif = '1' ");
		
		if(is_null($user)==FALSE)
	    {      
	        if($user->ct == 1)
	        {   
	        	$id_user = $user->id_user;
				$date_array = getdate();        
				$session_time = date('c',$date_array[0]);
				$return_session = '0';
				$encrypst = $this->model_public->QuerySingleValue("select md5('$session_time') as session");
				if (is_null($encrypst) == FALSE)
				   $return_session=$encrypst->session; 
			
				$session = array('mysession' => $return_session); 

				$this->session->set_userdata($session);

				$penguna = $this->model_public->QuerySingleValue("select id_group from _user where id_user = '$id_user' ");
 
				if(is_null($user) == FALSE)
					$id_group = $penguna->id_group;

				$this->db->query("update _session_login set status = 'N' where id_user = '$id_user' ");  

				$this->db->query("insert into _session_login values (0,'$id_user','$date_now', 'A', '$ip', '$browser', '$return_session')");

				$this->format_login->login_validate();

				redirect('dashboard');                       
	        }
            else
            {
            	$status_property['parameter'] = 'akses_validasi';
			    $status_property['message'] = '<p align="center" style="color:#5dc35a;">Password anda salah!!</p>';
				$status_property['error_message'] = 'alert-danger';
				$status_property['status_message'] = 'validation';
				$status_property['url_process'] = '';  
				$this->model_public->messaga_status($status_property); 
				redirect('lock');
            }
	    }
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */