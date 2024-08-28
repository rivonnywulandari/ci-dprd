<?php
class Hook_akses {
   	public function run() 
   	{
   		$ci =& get_instance();
		//echo "pertama";
		//  if ($ci->session->userdata('mysession') != 'myapp') die;
	    if($ci->model_public->bypass_privilage()==FALSE)
   		{
   			if($ci->model_public->privelage()==FALSE) 
		    {
		   		redirect('home');  
		    };
   		}

	    if($ci->model_public->log_aktivitas()==FALSE) 
	    {
			
	    };	      	
   }
}