<?php

class Menu extends CI_Model {
    
    public function getMenuPublic()
    {
        $menu = '';         
        $menu .= '<ul class="nav navbar-nav">';
                
        $menu_side = $this->model_public->QueryMultyValue(" SELECT *
                                                            FROM _menu 
                                                            WHERE _menu.parent_id = '0'
                                                            AND _menu.aktif = '1'
                                                            ORDER BY _menu.order_no ASC ");

        if(is_null($menu_side)==false)
        {
            foreach ($menu_side as $key):
                $id_menu    = $key->id_menu;
                $title      = $key->title;
                $icon       = $key->icon;
                $url        = $key->link;
                $parent_id  = $key->parent_id;
                $id_type    = $key->id_type;
                $id_target  = $key->id_target;
                $target     = $this->master->getdata('nama_target','_target','id_target',$id_target); 

                $ct_menu = $this->model_public->QueryNumRows("SELECT * FROM _menu WHERE parent_id = '$id_menu'");

                if($ct_menu == 0)
                {
                    if($id_type == 1){
                        $menu .= '<li class="nav-item  ml-4 mb-0">
                                    <a class="nav-link" href="'.site_url().$url.'" target="'.$target.'">
                                    <i class="'.$icon.'"></i>
                                    <span class="menu-text">'.$title.'</span>
                                    </a>
                                    <b class="arrow"></b>
                                  </li>';                        
                    }
                    else if($id_type == 2){                     
                        $menu .= '<li class="nav-item  ml-4 mb-0">
                                    <a class="nav-link" href="'.$url.'" target="'.$target.'">
                                    <i class="'.$icon.'"></i>
                                    <span class="menu-text">'.$title.'</span>
                                    </a>
                                    <b class="arrow"></b>
                                  </li>';
                    }                         
                }
                else if($ct_menu != 0)
                {
                    $menu .= '<li class="nav-item  ml-4 mb-0 dropdown">
                                <a href="'.site_url().$url.'" target="'.$target.'" class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                <i class="'.$icon.'"></i>
                                <span class="menu-text">'.$title.'</span>
                                </a>
                                <ul class="dropdown-menu">';

                    $menu .= $this->menu_child($id_menu);
                     
                    $menu .= '</ul></li>';
                }
            endforeach;            
        }

        $menu .= '</ul>';
            
        return $menu;
    }

    private function menu_child($parent_id)
    {   
        $menu = '';        
        $menu_parent = $this->model_public->QueryMultyValue("SELECT *
                                                            FROM _menu 
                                                            WHERE _menu.parent_id = '$parent_id'
                                                            AND _menu.aktif = '1'
                                                            ORDER BY _menu.order_no ASC ");

        if(is_null($menu_parent)==false)
        {
            foreach ($menu_parent as $key):
                $id_menu    = $key->id_menu;
                $title      = $key->title;
                $icon       = $key->icon;
                $url        = $key->link;
                $parent_id  = $key->parent_id;
                $id_type    = $key->id_type;
                $id_target  = $key->id_target;
                $target     = $this->master->getdata('nama_target','_target','id_target',$id_target); 

                
                if ($id_type == 1)
                {         
                    $ct_menu = $this->model_public->QueryNumRows("SELECT * FROM _menu WHERE parent_id = '$id_menu'");

                    if($ct_menu == 0){
                        $menu .= '<li">
                                    <a class="nav-link" href="'.site_url().$url.'" target="'.$target.'">
                                        '.$title.'
                                    </a>
                                  </li>';
                    }
                    else if($ct_menu != 0){
                        $menu .= '<li class="dropdown-submenu">
                                    <a href="'.site_url().$url.'" target="'.$target.'" class="dropdown-item dropdown-toggle" >
                                        '.$title.'
                                    </a>
                                    <ul class="dropdown-menu">';
                        $menu .= $this->menu_child($id_menu);
                        $menu .=    '</ul>
                                   </li>';
                    }
                }

                else if ($id_type == 2)
                {
                    $menu .= '<li>
                                <a class="nav-link" href="'.$url.'" target="'.$target.'">
                                    <i class="'.$icon.'"></i>
                                    <span class="menu-text">'.$title.'</span>
                                </a>
                                <b class="arrow"></b>
                              </li>';
                }

                else if ($id_type == 3)
                {
                    $menu .= $this->data_content($url,$target);
                } 

                else if ($id_type == 4)
                {
                    $menu .= $this->data_category($url,$target);
                }
                else if ($id_type==5)
                {
                    $menu .= $this->data_profil($url,$target);
                }
            endforeach;
        }
            
        return $menu;
    } 

    private function data_content($modul,$target){
        $menu = '';
        $tabel = 'tb_'.$modul;
        $cek = $this->model_public->QueryNumRows("SHOW TABLES LIKE '".$tabel."'");
        if ($cek > 0){
            $data = $this->model_public->QueryMultyValue("SELECT * from $tabel where aktif='1' limit 0,10");
            foreach ($data as $key) {
                $id         = $key->id;
                $judul      = $key->judul;
                $menu .= '<li>
                            <a href="'.site_url().'home/'.$modul.'/0/'.$id.'" target="'.$target.'">
                                '.$judul.'
                            </a>
                          </li>';
            }
        }
        else{
            $menu .= '<li><a href="#">sub menu '.$modul.' tidak ditemukan</a></li>';
        }
        return $menu;
    } 

    private function data_category($modul,$target){
        $menu = '';
        $tabel = 'tb_kat'.$modul;
        $cek = $this->model_public->QueryNumRows("SHOW TABLES LIKE '".$tabel."'");
        if ($cek > 0){
            $data = $this->model_public->QueryMultyValue("SELECT * from $tabel limit 0,10");
            foreach ($data as $key) {
                $id         = $key->id;
                $nama      = $key->nama;
                $menu .= '<li>
                            <a href="'.site_url().'home/'.$modul.'/'.$id.'" target="'.$target.'">
                                '.$nama.'
                            </a>
                          </li>';
            }
        }
        else{
            $menu .= '<li><a href="#">sub menu kategori '.$modul.' tidak ditemukan</a></li>';
        }
        return $menu;
    }
    
    private function data_profil($modul,$target){
        $menu = '';
        $tabel = 'tb_kat'.$modul;
        $cek = $this->model_public->QueryNumRows("SHOW TABLES LIKE '".$tabel."'");
        if ($cek > 0){
            $data = $this->model_public->QueryMultyValue("SELECT * from $tabel limit 0,10");
            foreach ($data as $key) {
                $id         = $key->id;
                $nama      = $key->nama;
                $menu .= '<li>
                            <a href="'.site_url().'home/'.$modul.'/'.$id.'" target="'.$target.'">
                                '.$nama.'
                            </a>
                          </li>';
            }
        }
        else{
            $menu .= '<li><a href="#">sub menu kategori '.$modul.' tidak ditemukan</a></li>';
        }
        return $menu;
    }



    public function getMenuAdmin($id_group,$link)
    {
        $menu = '';         
        $menu .= '<ul class="nav nav-list"><br>';
        $class_active = "";        
                
        $menu_side = $this->model_public->QueryMultyValue(" SELECT *
                                                            FROM _menu_admin,_group_module 
                                                            WHERE _group_module.id_module = _menu_admin.id_module
                                                            AND _group_module.id_group = '$id_group'
                                                            AND _menu_admin.parent_id = '0'
                                                            AND _menu_admin.aktif = '1'
                                                            ORDER BY _menu_admin.order_no ASC ");


        if(is_null($menu_side)==false)
        {
            foreach ($menu_side as $key) 
            {
                $id_menu    = $key->id_menu;
                $title      = $key->title;
                $icon       = $key->icon;
                $url        = $key->link;
                $parent_id  = $key->parent_id;
                $id_target  = $key->id_target;
                $target     = $this->master->getdata('nama_target','_target','id_target',$id_target); 

                $getMenu = $this->model_public->QuerySingleValue("SELECT parent_id FROM _menu_admin WHERE link = '$link' ");
                if ($getMenu){
                    if($link == $url || $id_menu == $getMenu->parent_id)
                        $class_active = "active";                    
                    else
                        $class_active = "";
                }

                $ct_menu = $this->model_public->QueryNumRows("SELECT * FROM _menu_admin WHERE parent_id = '$id_menu'");

                if($ct_menu == 0)
                {
                  $menu .= '<li class="'.$class_active.'">
                                <a href="'.site_url().$url.'" target="'.$target.'">
                                    <i class="'.$icon.'"></i>
                                    <span class="menu-text">'.$title.'</span>
                                </a>
                                <b class="arrow"></b>
                              </li>';
                  
                    
                }
                elseif($ct_menu != 0)
                {
                    $menu .= '<li class="dropdown '.$class_active.'">
                                <a href="#" target="'.$target.'" class="dropdown-toggle">
                                    <i class="'.$icon.'"></i>
                                    <span class="menu-text">'.$title.'</span>
                                    <b class="arrow fa fa-angle-right"></b>
                                </a>
                                <ul class="submenu">';

                    $menu .= $this->menu_child_admin($id_menu,$id_group,$link);
                     
                    $menu .= '</ul>
                            </li>';
                }
            }
            
        }

        $menu .= '</ul>';
            
        return $menu;
    }

    private function menu_child_admin($parent_id,$id_group,$link)
    {   
        $menu = '';        
        $class_active = "";
        $menu_parent = $this->model_public->QueryMultyValue("SELECT *
                                                            FROM _menu_admin,_group_module 
                                                            WHERE _group_module.id_module = _menu_admin.id_module
                                                            AND _group_module.id_group = '$id_group'
                                                            AND _menu_admin.parent_id = '$parent_id'
                                                            AND _menu_admin.aktif = '1'
                                                            ORDER BY _menu_admin.order_no ASC ");

        if(is_null($menu_parent)==false)
        {
            foreach ($menu_parent as $key) 
            {
                $id_menu    = $key->id_menu;
                $title      = $key->title;
                $icon       = $key->icon;
                $url        = $key->link;
                $parent_id  = $key->parent_id;
                $id_target  = $key->id_target;
                $target     = $this->master->getdata('nama_target','_target','id_target',$id_target); 

                $getMenu = $this->model_public->QuerySingleValue("SELECT parent_id FROM _menu_admin WHERE link = '$link' ");
                if ($getMenu){
                    if($link == $url || $id_menu == $getMenu->parent_id)
                        $class_active = "active";                    
                    else
                        $class_active = "";
                }
            
                        
                $ct_menu = $this->model_public->QueryNumRows("SELECT * FROM _menu_admin WHERE parent_id = '$id_menu'");

                if($ct_menu == 0)
                {
                    $menu .= '<li class="'.$class_active.'">
                                <a href="'.site_url().$url.'" target="'.$target.'">
                                    '.$title.'
                                </a>
                              </li>';
                }
                else if($ct_menu != 0)
                {
                    $menu .= '<li class="dropdown '.$class_active.'">
                                <a href="#" target="'.$target.'" class="dropdown-toggle">
                                    '.$title.'
                                    <b class="arrow fa fa-angle-right"></b>
                                </a>
                                <ul class="submenu">';
                    $menu .= $this->menu_child_admin($id_menu,$id_group);
                    $menu .=    '</ul>
                               </li>';
                }                
            }
        }
            
        return $menu;
    }     
}
?>