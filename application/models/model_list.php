<?php

class Model_list extends CI_Model {
    public function __construct()
    {
        parent::__construct();  
    } 

    public function init_profile($session_value)
    {  
        $data = array();
        $id_user = "";
        $nama_user = "";
        $nama_jekel = "";
        $alamat = "";
        $telepon = "";
        $group_name = "";

        $session_login = $this->model_public->QuerySingleValue("SELECT id_user,tgl_jam from _session_login where session_value = '$session_value' and status = 'A' ");

        if(is_null($session_login)==false)
        {
            $profile =  $this->model_public->QuerySingleValue("SELECT 
                                                                    p.id_user as id_user,
                                                                    p.nama_user as nama_user,
                                                                    p.username as username,
                                                                    p.id_group as id_group,
                                                                    jk.nama_jekel as nama_jekel,
                                                                    p.alamat as alamat,
                                                                    p.telepon as telepon,
                                                                    g.group_name as group_name,
            														a.status_aktif as status_aktif
                                                                                                                                       
                                                                FROM _user p, _jekel jk, _group g, _aktif a
                                                                WHERE p.id_user = '$session_login->id_user'
                                                                AND p.id_jekel=jk.id_jekel
                                                                AND p.id_group=g.id_group
                                                                AND a.aktif=p.aktif

                                                                ");   
            if(is_null($profile) == false)
            {
                $id_user = $profile->id_user;
                $username = $profile->username;
                $nama_user = $profile->nama_user;
                $nama_jekel = $profile->nama_jekel;
                $alamat = $profile->alamat;
                $telepon = $profile->telepon;
                $id_group = $profile->id_group;
                $group_name = $profile->group_name;
                $status_aktif = $profile->status_aktif;
                $tgl_jam = $session_login->tgl_jam;
            } 
        }

        $data['id_user'] = $id_user;
        $data['username'] = $username;
        $data['nama_user'] = $nama_user;
        $data['nama_jekel'] = $nama_jekel;
        $data['alamat'] = $alamat;
        $data['telepon'] = $telepon;
        $data['id_group'] = $id_group;
        $data['group_name'] = $group_name;
        $data['status_aktif'] = $status_aktif;
        $data['tgl_jam'] = $tgl_jam;

        return $data;
    }
} 
?>