<?php

class Fungsi extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function tulisIsi($var,$jum) {
        $hitung=strlen($var);
        if ($hitung<=$jum) {
            echo $this->bersihkanEntity($var);
        } else {
            $isi = strip_tags($var);
            $isi = substr($isi,0,$jum);
            $isi = substr($isi,0,strrpos($isi," "));
            echo $this->bersihkanEntity($isi);        
        }   
    }

    public function bersihkanEntity($isi) {
        $isi = str_replace('\"', '"', $isi);
        $isi = str_replace("\'", "'", $isi);
        $isi = str_replace(' & ', ' &amp; ', $isi);
        $isi = str_replace('"', '&quot;', $isi);
        $isi = str_replace("'", '&#39;', $isi);     
        $isi = str_replace("‘", '&lsquo;', $isi);
        $isi = str_replace("’", '&rsquo;', $isi);
        $isi = str_replace("“", '&ldquo;', $isi);
        $isi = str_replace("”", '&rdquo;', $isi);
        $isi = str_replace("—", '&mdash;', $isi);
        return $isi;
    }
}
?>