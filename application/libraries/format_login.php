<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class format_login
{	
	public function __construct(){
        session_start();
    }
    
	public function antiinjection($data){
		$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlentities(htmlspecialchars($data,ENT_QUOTES)))));
		return $filter_sql;
	}

	public function login_validate() {
		$timeout = 2400;
		$_SESSION['expires_by'] = time() + $timeout;
	}

	public function login_check() {
		// $exp_time = $_SESSION['expires_by'];
		// if (time() < $exp_time) {
			$this->login_validate();
			return true;
		// } else {
		// 	unset($_SESSION['expires_by']);
		// 	return false;
		// }
	}
	
}