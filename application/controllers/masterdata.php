<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masterdata extends CI_Controller {

	public function __construct(){
        parent::__construct();

        $this->load->model('model_list');
        $this->load->model('model_public');
        $session_value = $this->session->userdata('mysession');
        $this->load->library('grocery_CRUD');
        $this->load->library('format_login');	
    }

	public function index()
	{
		
	}

	public function _example_output($output = null)
	{
		
		$session_value = $this->session->userdata('mysession');
		$data = $this->model_list->init_profile($session_value);
		
		$this->load->view('header.php',$data );
		
            
        $this->load->view('masterdata/master_data',$output);


        $this->load->view('footer.php');
	}

    public function group()
    {
        $this->breadcrumb->add(' Home ', base_url().'dashboard');
        $this->breadcrumb->add(' Master Data ', base_url().'masterdata/group');
        $this->breadcrumb->add(' Group ', base_url().'masterdata/group');

        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('_group');
            $crud->set_subject('Group');

            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_export();
            
            $crud->columns('id_group','nama_group','aktif');

            $crud->display_as('id_group',' ID Group')
                 ->display_as('nama_group','Nama Groups')
                 ->display_as('aktif','Aktif'); 
           			
            $crud->fields('nama_group','aktif');

            $crud->required_fields('nama_group','aktif');
        
            $crud->callback_before_insert(array($this,'content_user_insert_callback'));
            $crud->callback_before_update(array($this, 'content_user_update_callback'));

            //$crud->set_field_upload('photo','data_upload');
            $output = $crud->render();
                                
            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }

    }

    public function content_user_insert_callback($post_array) {        
        $post_array['password'] = md5($post_array['password']);        
        return $post_array;
    } 
    public function content_user_update_callback($post_array,$primary_key){   

        if( (!empty($post_array['password']))&&(!empty($post_array['repassword'])) )
        {
            if($post_array['password'] == $post_array['repassword'])
                $post_array['password'] = md5($post_array['password']);
            else
                unset($post_array['password']);
        }
        else
            unset($post_array['password']);
        
        return $post_array;
    }
    public function set_password_input_to_empty($value) {
        return '<input type="password" value="'.$value.'" disabled class="form-control"/><a href="#mypassword" data-toggle="collapse"> change password</a>
                <div id = "mypassword" class="form-group collapse">
                <input placeholder="New Password"  type="password" name="password" value="" class="form-control"/>
                <input placeholder="Confirm Password" type="password" name="repassword" value="" class="form-control"/>
                </div>';
    }

    public function user()
    {
        $this->breadcrumb->add(' Home ', base_url().'dashboard');
        $this->breadcrumb->add(' Master Data ', base_url().'masterdata/user');
        $this->breadcrumb->add(' User ', base_url().'masterdata/user');

        try{
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('user');
            $crud->set_subject('User');

            $crud->unset_read();
            $crud->unset_print();
            $crud->unset_export();
            $crud->unset_texteditor('alamat', 'full_text');
            
            $crud->columns('id_user','nama_user','telepon','id_group','username','aktif');

            $crud->display_as('id_user',' ID User')
                 ->display_as('nama_user','Nama User')
                 ->display_as('id_jekel','ID Jekel')
                 ->display_as('alamat','Alamat')
                 ->display_as('telepon','Telepon')
                 ->display_as('id_group','ID Group')
                 ->display_as('username','Username')
                 ->display_as('password','Password')
                 ->display_as('aktif','Status'); 
           
           
            $crud->set_relation('aktif','_aktif','status_aktif');   
            $crud->set_relation('id_jekel','_jekel','nama_jekel'); 
            $crud->set_relation('id_group','_group','nama_group'); 
            $crud->set_relation('aktif','_aktif','status_aktif'); 
            
            $crud->fields('id_user','nama_user','id_jekel','alamat','telepon','id_group','username','password','aktif');

            $crud->required_fields('id_user','nama_user','id_jekel','alamat','telepon','id_group','username','aktif');

            $crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
            $crud->callback_add_field('password',array($this,'set_password_input_to_empty'));
        
            $crud->callback_before_insert(array($this,'content_user_insert_callback'));
            $crud->callback_before_update(array($this, 'content_user_update_callback'));

            //$crud->set_field_upload('photo','data_upload');
            $output = $crud->render();
                                
            $this->_example_output($output);

        }catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }

    }
	  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */