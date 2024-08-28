<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	private $theme 	= 'theme99';
	public function __construct(){
        parent::__construct();
        $this->load->model(array('master','model_home'));

        //save visitor
        $this->model_public->saveVisitor();	
    }

	public function index()
	{
	   // echo "please wait...";
		$data = $this->model_home->getHome();
		$this->load->view('public/'.$this->theme.'/header',$this->meta(''));
		$this->load->view('public/'.$this->theme.'/home',$data);	
		$this->load->view('public/'.$this->theme.'/footer');	
	}

	public function meta($modul)
	{
		$data = $this->model_home->getMeta($modul);
		return $data;
	}

	public function search()
	{
		if (!$_POST ==""){
			$cari	= $this->format_data->string($this->input->post('cari'));
		}
		else
			$cari = $this->session->flashdata('cari');
				
		$modul 	= $cari;	
		$data = $this->model_home->getSearchContent($cari);
		$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
		$this->load->view('public/'.$this->theme.'/content_search',$data);	
		$this->load->view('public/'.$this->theme.'/footer');	
	}

	public function formulir_permohonan()
	{
		$this->load->library('form_validation');
		$modul = 'search';	

		$data = $this->model_home->tambahFormulirPermohonan($modul);

		$this->form_validation->set_rules('nama_pemohon_informasi', 'Nama Pemohon Informasi', 'required');
		$this->form_validation->set_rules('ktp_pemohon', 'KTP Pemohon', 'required|exact_length[16]|numeric');
        $this->form_validation->set_rules('alamat_pemohon', 'Alamat Pemohon', 'required');
        $this->form_validation->set_rules('nohp_pemohon', 'No HP Pemohon', 'required');
        $this->form_validation->set_rules('email_pemohon', 'Email Pemohon', 'required|valid_email');
		$this->form_validation->set_rules('informasi_yang_dibutuhkan', 'Informasi yang dibutuhkan', 'required');
        $this->form_validation->set_rules('alasan_permintaan', 'Alasan Permintaan', 'required');
        $this->form_validation->set_rules('nama_pengguna_informasi', 'Nama Pengguna Informasi', 'required');
		$this->form_validation->set_rules('ktp_pengguna', 'KTP Pengguna', 'required|exact_length[16]|numeric');
        $this->form_validation->set_rules('alamat_pengguna', 'Alamat Ppengguna', 'required');
        $this->form_validation->set_rules('nohp_pengguna', 'No HP Pengguna', 'required');
        $this->form_validation->set_rules('email_pengguna', 'Email Pengguna', 'required|valid_email');
        $this->form_validation->set_rules('alasan_penggunaan_informasi', 'Email Pengguna', 'required');
        $this->form_validation->set_rules('tanggal_pengajuan', 'Tanggal Pengajuan', 'required');

		$this->form_validation->set_message('valid_email', 'mohon masukkan @ dan domain email pada field email');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


		if($this->form_validation->run() == FALSE ){
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_formulir_permohonan',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else
		{
			// echo "berhasil";
			$this->model_home->kirimFormulirPermohonan();
			$this->session->set_flashdata('flash', 'dikirim');
            redirect('home/formulir_permohonan');

			
		}
	
    }

	public function berita()
	{
		$modul 	='berita';
		$head 	='Berita';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function transportasi()
	{
		$modul 	='transportasi';
		$head 	='Transportasi';
		$id_kat	= $this->format_data->string($this->uri->segment(3,0));
		$id 	= $this->format_data->string($this->uri->segment(4,0));
		
		if ($id > 0){
			//$data = $this->model_home->getDetailContentTransportasi($modul,$id,$head);
			//$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_transportasi',$data);	
			//$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			//$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			//$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_transportasi',$data);	
			//$this->load->view('public/'.$this->theme.'/footer');	
		}
		else { //dsni
			$data = $this->model_home->getListTransportasi($modul,$head);
			//$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_transportasi',$data);	
			//$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function artikel()
	{
		$modul 	='artikel';
		$head 	='Artikel';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function pengumuman()
	{
		$modul 	='pengumuman';
		$head 	='Pengumuman';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function profil()
	{
		$modul 	='profil';
		$head 	='Profil';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));

		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}	
	}


	public function informasi()
	{
		$modul 	='informasi';
		$head 	='Informasi';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function file()
	{
		$modul 	='file';
		$head 	='File';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
	}

	public function foto()
	{
		$modul 	='foto';
		$head 	='Foto';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/content_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
	}


	public function ppid()
	{
		$modul 	='ppid';
		$head 	='PPID';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/ppid_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/ppid_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/ppid_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}	   

	public function anggaran()
	{
		$modul 	='anggaran';
		$head 	='KEUANGAN';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/keuangan_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/keuangan_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/keuangan_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function kliping()
	{
		$modul 	='kliping';
		$head 	='e-KLIPING';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/kliping_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/kliping_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/kliping_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}	
	
	public function sekretariat()
	{
		$modul 	='sekretariat';
		$head 	='Sekretariat';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			$data = $this->model_home->getDetailContent($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/profil_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->getCategoryContent($modul,$id_kat,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/profil_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
			
		}
		else {
			$data = $this->model_home->getListContent($modul,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/profil_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
// 			echo "list";
		}
		
	}

	public function pimpinan()
	{
		$modul 	='Pimpinan';
		$head 	='pimpinan';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));
		
		if ($id > 0){
			//$view_data = $this->model_home->tb_pimpin();
			//$data = $this->model_home->getListContent($modul,$head);

			$data = $this->model_home->tb_pimpin($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/profil_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->tb_pimpin($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/profil_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
			
		}
		else {
			$data = $this->model_home->tb_pimpin($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/profil_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		
	}

	public function anggota()
	{
		$modul 	='anggota';
		$head 	='anggota';
		$id_kat	= abs($this->format_data->string($this->uri->segment(3,0)));
		$id 	= abs($this->format_data->string($this->uri->segment(4,0)));

		if ($id > 0){
			//$view_data = $this->model_home->tb_pimpin();
			//$data = $this->model_home->getListContent($modul,$head);

			$data = $this->model_home->anggota($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/anggota_detail',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
		else if ($id_kat > 0){
			$data = $this->model_home->anggota($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/anggota_category',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
			
		}
		else {
			$data = $this->model_home->anggota($modul,$id,$head);
			$this->load->view('public/'.$this->theme.'/header',$this->meta($modul));	
			$this->load->view('public/'.$this->theme.'/anggota_list',$data);	
			$this->load->view('public/'.$this->theme.'/footer');	
		}
	}
}