<?php

/**
* 
*/
class Model_lock extends CI_Model
{
	
	public function __construct()
    {
        parent::__construct();
    } 

    public function init_data_lock($session_value)
    {
    	$id_user = "";  
		$session_login = $this->model_public->QuerySingleValue("SELECT id_user from _session_login where session_value = '$session_value' and status = 'A' ");
		if(is_null($session_login) == false)
		{
		    $id_user = $session_login->id_user;
		    $nama_user = "";
		    $username = "";
	
		    $user = $this->model_public->QuerySingleValue("SELECT
		    													username, 
		                                                        nama_user
		                                                      from 
		                                                        _user
		                                                      where 
		                                                        _user.id_user = '$id_user'");

		    if(is_null($user) == false)
		    {
		      $nama_user = $user->nama_user;
		      $username = $user->username;
		    }

		    $data['username'] = $username;
		    $data['nama_user'] = $nama_user;
		}

		return $data;
    }
}