<?php
	if($nama_user == null || $nama_user == "")
	{
		redirect('login/logout');
		exit(0);
	}
	$cek_uri = $this->model_public->cek_uri($id_group);
	
	if ( $cek_uri == false){
		redirect('dashboard');
	}
	
	$session_value = $this->session->userdata('mysession');
	if($session_value != null || $session_value != "")
	{
		if (!$this->format_login->login_check()) 
		{
		  redirect('lock');
		  exit(0);
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Panel Admin</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--base css styles-->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/assets/chosen-bootstrap/chosen.min.css" />

	<!--flaty css styles-->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/css/flaty.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/css/flaty-responsive.css">

	<!--date-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/flat/assets/bootstrap-datepicker/css/datepicker.css" />

	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/icon.png">
	
	<!--switch-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/flat/assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />

	<!--progress bar-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/progress.bar.css" />

	<!--form validator-->
	<script src="<?php echo base_url(); ?>assets/flat/form-validator/jQuery-2.1.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/flat/form-validator/bootbox/js/bootbox.js"></script>

	<!-- Untuk Text Area -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets_textarea/kc_ck/ckeditor/ckeditor.js"></script>

	<!-- treegrid-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/treegrid/css/jquery.treegrid.css">

</head>

<body>

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
	<button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar"><span class="fa fa-bars"></span></button>
	<a class="navbar-brand" href="<?php echo base_url(); ?>dashboard"><small><i><img width="24px" src="<?php echo base_url();?>assets/img/icon.png"></i> <b>PANEL ADMIN</b></small></a>
	<ul class="nav flaty-nav pull-right">	
		<li class="hidden-xs active">
			<a href="<?php echo base_url(); ?>" target="_blank">
			<b><i class="fa fa-globe"></i> KUNJUNGI WEB</b>
			</a>
		</li>
		
		<!-- BEGIN Button User -->
		<li class="user-profile">
			<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
			<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/img/user_login.png" alt="Penny's Photo" />
			<span class="hhh" id="user_info">
			<?php echo $nama_user;?>
			</span>
			<i class="fa fa-caret-down"></i>
			</a>

			<!-- BEGIN User Dropdown -->
			<ul class="dropdown-menu dropdown-navbar" id="user_menu">
			<li class="nav-header">
			<i class="fa fa-clock-o"></i>
			Logined From <?php echo date("h:i", strtotime($tgl_jam));?> 
			</li>

			<li>
			<a href="<?php echo site_url(); ?>account/profile">
			<i class="fa fa-user"></i>
			Profil Pengguna
			</a>
			</li>

			<li>
			<a href="<?php echo site_url(); ?>account/password">
			<i class="fa fa-cog"></i>
			Ganti Password
			</a>
			</li>	

			<li class="divider"></li>
			<li>
			<a href="<?php echo site_url(); ?>lock">
			<i class="fa fa-lock"></i>
			Lock
			</a>
			</li>

			<li class="divider"></li>
			<li>
			<a href="<?php echo site_url(); ?>login/logout">
			<i class="fa fa-power-off"></i>
			Logout
			</a>
			</li>
			</ul>
			<!-- BEGIN User Dropdown -->
		</li>
		<!-- END Button User -->
	</ul>
</div>
<!-- END Navbar -->

<!-- BEGIN Container -->
<div class="container" id="main-container">

	<!-- BEGIN Sidebar -->
	<div id="sidebar" class="navbar-collapse collapse">
		<?php echo $this->menu->getMenuAdmin($id_group,$link);?>
		<!-- END Navlist -->

		<!-- BEGIN Sidebar Collapse Button -->
		<div id="sidebar-collapse" class="visible-lg">
		<i class="fa fa-angle-double-left"></i>
		</div>
		<!-- END Sidebar Collapse Button -->
	</div>
	<!-- END Sidebar -->

	<!-- BEGIN Content -->
	<div id="main-content">
