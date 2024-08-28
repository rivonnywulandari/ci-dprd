<?php
/**
* 
*/
class Model_menupublic extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function init_view()
	{
		$data['list_menu']=  $this->menu_parent();   
    $data['type_menu_cb'] = $this->model_public->QueryMultyValue("SELECT * from _type_menu");   
    $data['target_cb'] = $this->model_public->QueryMultyValue("SELECT * from _target");   
    return $data;
	}

	private function menu_parent()
	{
		  $id = $this->uri->segment(3,0);

      $induk = "";     

      $query = $this->model_public->QueryMultyValue(" SELECT *                                                       
	                                                   FROM _menu
	                                                   WHERE parent_id = 0
	                                                   ORDER BY id_menu ASC ");   
    
	    $induk .= '<table id="tree-3" class="table table-condensed" cellspacing="0" width="100%">           
	                <thead>
	                  <tr>
	                    <th>TITLE MENU</th>
	                    <th>LINK</th>
                      <th>TYPE</th>
	                    <th>STATUS</th>
	                  </tr>
	                </thead>
	                <tbody>';
	    //------------------------------------------------------------------
	    // main list_table
	    //------------------------------------------------------------------            
	    if(!empty($query))
	    {
  	      foreach($query as $row):  
    	        $id_menu  	  = $row->id_menu;
    	        $title			  = $row->title;
    	        $link			    = $row->link;
              $aktif        = $row->aktif;
    	        $nama_type		= $this->master->getData('nama_type','_type_menu','id_type',$row->id_type);
    	        $parent_id   	= $row->parent_id;
              $class        = 'treegrid-alfa'.$id_menu;

              if ($aktif == 1)
                  $aktif = '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>';
              else 
                  $aktif  = '<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>';


              $cek = $this->model_public->QueryNumRows("SELECT * from _menu where parent_id='".$id_menu."'");
    	        if ($id == $id_menu && $cek > 0){
                  $induk .= '<tr class="'.$class.'" id="'.$id_menu.'">
                            <td><a href="#menu-child" data-toggle="modal" class="selectdata" data-id="'.$id_menu.'" data-name="'.$title.'"><b>'.$title.'</b></a></td>
                            <td>'.$link.'</td>
                            <td>'.$nama_type.'</td>
                            <td>'.$aktif.'</td>
                            </tr>';
              }
              else{
                  $induk .= '<tr class="'.$class.'" id="'.$id_menu.'">
                            <td><a href="#menu-child" data-toggle="modal" class="selectdata" data-id="'.$id_menu.'" data-name="'.$title.'"><b>'.$title.'</b></a></td>
                            <td>'.$link.'</td>
                            <td>'.$nama_type.'</td>
                            <td>'.$aktif.'</td>
                            </tr>';
              }
               

    	        $table_induk = $this->model_public->QuerySingleValue("SELECT count(*) as ct from _menu where parent_id = '$id_menu'");
    	        if(is_null($table_induk)==FALSE)
    	        {                          
      	          if($table_induk->ct > 0)
      	          {
                      $induk .= $this->menu_child($id_menu);
      	          }
    	        } 
  	      endforeach;
	    }
	    else{
        	$induk .= '<tr><td>Belum ada menu</td></tr>'; 
	    }   
	    $induk .= '</tbody>
	            </table>';
	      
	    return $induk;
	}

	private function menu_child($parent_id)
	{
	    $id = $this->uri->segment(3,0);
      //----------------------------------------------------------------------
	    // dropdown menu
	    //----------------------------------------------------------------------
	    $anak = '';
	    $query = $this->model_public->QueryMultyValue(" SELECT 
                                                        id_menu,
	                                                      id_type,
	                                                      title,	                                                      
	                                                      link,	                                                      
	                                                      aktif,	                                                      
	                                                      parent_id                                                        
	                                                    FROM
	                                                      _menu
	                                                    WHERE 
	                                                      parent_id = '$parent_id'
	                                                    ORDER BY id_menu ASC ");
	    if(!empty($query))
	    {
  	      foreach($query as $row):	      
    	        $id_menu  	= $row->id_menu;
    	        $title			= $row->title;
    	        $link			  = $row->link;
    	        $aktif		  = $row->aktif;
              $nama_type  = $this->master->getData('nama_type','_type_menu','id_type',$row->id_type);
    	        $parent_id  = $row->parent_id;
              $class        = 'treegrid-alfa'.$id_menu.' '.'treegrid-parent-alfa'.$parent_id;

              if ($aktif == 1)
                  $aktif = '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>';
              else 
                  $aktif  = '<button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>';

              if ($id == $parent_id){
                  $anak .= '<tr  id="'.$id_menu.'" class="'.$class.'">
                          <td><a href="#menu-child" data-toggle="modal"  class="selectdata" data-id="'.$id_menu.'" data-name="'.$title.'">'.$title.'</a></td>
                          <td>'.$link.'</td>                                                           
                          <td>'.$nama_type.'</td>                                      
                          <td>'.$aktif.'</td>     
                          <tr>';
              }
              else{
                  $anak .= '<tr id="'.$id_menu.'" class="'.$class.'">
                            <td ><a href="#menu-child" data-toggle="modal"  class="selectdata" data-id="'.$id_menu.'" data-name="'.$title.'">'.$title.'</a></td>                                      
                            <td>'.$link.'</td>                                      
                            <td>'.$nama_type.'</td>                                      
                            <td>'.$aktif.'</td>                                      
                        </tr>';
              }    	        

    	        $table_anak = $this->model_public->QuerySingleValue("SELECT count(*) as ct from _menu where parent_id = '$id_menu'");
    	        if(is_null($table_anak)==FALSE)
    	        {
      	          if($table_anak->ct > 0) 
      	          {                 
      	             $anak .= $this->menu_child($id_menu);
      	          }                              
    	        }                
  	      endforeach;
	    }
	    return $anak;
	}

  public function validate($action,$id)
  {
      $this->form_validation->set_rules('title', 'title', 'required'); 
      $this->form_validation->set_rules('link', 'link', 'required'); 
      $this->model_public->conv_validasi_to_indonesia();  
      if($this->form_validation->run() == FALSE)
      {
          $status_property['parameter'] = $action;
          $status_property['message'] = validation_errors();
          $status_property['error_message'] = 'alert-danger';
          $status_property['status_message'] = 'validation';
          $status_property['url_process'] = '';  
          $this->model_public->messaga_status_user($status_property); 
          redirect('menupublic/'.$action.'/'.$id);         
      }    
  }

	public function init_add_save()
	{
	    //validate
      $this->validate('view','');

      //ambil data  
      $id_type   = $this->format_data->string($this->input->post('id_type'));
      $title     = $this->format_data->string($this->input->post('title'));      
      $id_target = $this->format_data->string($this->input->post('id_target'));
      $link      = $this->format_data->string($this->input->post('link'));
      $icon      = $this->format_data->string($this->input->post('icon'));
      $parent_id = $this->format_data->string($this->input->post('parent_id'));  
      $order_no  = $this->master->maxDataDetail('order_no','_menu','parent_id',$parent_id);        
      $aktif     = $this->input->post('aktif');

      if(!$aktif == false)
        $aktif = '1';
      else
        $aktif = '0';

      $menu = $this->model_public->QuerySingleValue("SELECT max(id_menu) as id_max from _menu");
      $id_menu = $menu->id_max + 1;  

      $data = array(
          'id_menu' => $id_menu,          
          'id_type' => $id_type,
          'id_target' => $id_target, 
          'title' => $title,
          'link' => $link,
          'icon' => $icon,              
          'parent_id' => $parent_id,           
          'order_no' => $order_no,           
          'aktif' => $aktif,                    
      );

      $this->db->trans_start();
      $this->db->insert('_menu', $data);
      $this->db->trans_complete();    
      
      if ($this->db->trans_status()==false)
          $this->db->trans_rollback();
      else
      {   
          $status_property['parameter'] = 'view';
          $status_property['message'] = 'data sukses disimpan';
          $status_property['error_message'] = 'alert-success';
          $status_property['status_message'] = '';
          $status_property['url_process'] = '';
          $this->model_public->messaga_status_user($status_property);
          redirect('menupublic/view/');
       }
	}

	public function init_edit_save()
	{
		    //validate
      $this->validate('view','');

      //ambil data  
      $id_menu   = $this->format_data->string($this->input->post('id_menu'));
      $id_type   = $this->format_data->string($this->input->post('id_type'));
      $title     = $this->format_data->string($this->input->post('title'));      
      $id_target = $this->format_data->string($this->input->post('id_target'));
      $link      = $this->format_data->string($this->input->post('link'));
      $icon      = $this->format_data->string($this->input->post('icon'));
      $parent_id = $this->format_data->string($this->input->post('parent_id'));        
      $order_no  = $this->format_data->string($this->input->post('order_no'));
      $aktif     = $this->input->post('aktif');

      if(!$aktif == false)
        $aktif = '1';
      else
        $aktif = '0'; 

      $data = array(        
          'id_type' => $id_type,
          'id_target' => $id_target, 
          'title' => $title,
          'link' => $link,
          'icon' => $icon,                     
          'order_no' => $order_no,           
          'aktif' => $aktif                  
      );

      $this->db->trans_start();   
      $this->db->where('id_menu',$id_menu); 
      $this->db->update('_menu',$data); 
      $this->db->trans_complete();        
      
      if ($this->db->trans_status()==false)
          $this->db->trans_rollback();
      else
      {   
          $status_property['parameter'] = 'view';
          $status_property['message'] = 'data sukses disimpan';
          $status_property['error_message'] = 'alert-success';
          $status_property['status_message'] = '';
          $status_property['url_process'] = '';
          $this->model_public->messaga_status_user($status_property);
          redirect('menupublic/view/'.$parent_id);
      }
	}

	public function init_delete()
	{
		    $id_menu = $this->input->post('id_menu_hapus');

        $cek = $this->model_public->QueryNumRows("SELECT * FROM _menu WHERE parent_id = '$id_menu' ");
        if($cek > 0)
        {
          $status_property['parameter'] = 'view';
          $status_property['message'] = 'Maaf data tidak bisa dihapus karena sub data masih ada.';
          $status_property['error_message'] = 'alert-danger';
          $status_property['status_message'] = 'delete';
          $status_property['url_process'] = '';  
          $this->model_public->messaga_status_user($status_property); 
        }
        else
        {
          //------------------ Hapus Gambar --------------------
          $this->db->delete('_menu', array('id_menu' => $id_menu));

          $status_property['parameter'] = 'view';
          $status_property['message'] = 'data sukses dihapus</b>';
          $status_property['error_message'] = 'alert-success';
          $status_property['status_message'] = '';
          $status_property['url_process'] = '';
          $this->model_public->messaga_status_user($status_property); 
        }        
        redirect('menupublic/view/');
	}

  public function init_edit($id_menu)
  {
      $menu = $this->model_public->QuerySingleValue("SELECT *
                                                      FROM _menu
                                                      WHERE _menu.id_menu = '$id_menu' "); 

      $data['data'] = $menu;

      $type = $this->model_public->QuerySingleValue("SELECT * FROM _type_menu WHERE id_type='".$menu->id_type."'");
      $data['id_type'] = $type->id_type;
      $data['nama_type'] = $type->nama_type;
      $data['type_cb'] = $this->model_public->QueryMultyValue("SELECT * from _type_menu where id_type <> '".$menu->id_type."'"); 

      $target = $this->model_public->QuerySingleValue("SELECT * FROM _target WHERE id_target='".$menu->id_target."'");
      $data['id_target'] = $target->id_target;
      $data['nama_target'] = $target->nama_target;
      $data['target_cb'] = $this->model_public->QueryMultyValue("SELECT * from _target where id_target <> '".$menu->id_target."'");   

      return $data;
  }

  public function parent_id($id_menu)
  {
      $_menu = $this->model_public->QuerySingleValue("Select 
                                                          parent_id
                                                      FROM 
                                                          _menu
                                                      WHERE
                                                          id_menu = '$id_menu' ");   
      $data = $_menu->parent_id;

      return $data;

  }
}

?>