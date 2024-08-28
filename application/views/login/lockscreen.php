<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Panel Admin</title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/icon.png">
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/icon.png"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lockscreen/css/style.css" />
    <body>
        <div class="container">
			
			<header>			
				<p><img width="64px;" src="<?php echo base_url();?>assets/img/logo.png"></p>
				<h1>Panel<strong> Admin</strong></h1>
				<p style="color:#2294be; text-decoration:none;">Silahkan masukan kata sandi anda</p>
				
				<section class="main">
					<form class="form-1" action="<?php echo site_url(); ?>lock/proses_unlock" method="post">
						
						<img width="30px" src="<?php echo base_url();?>assets/img/user.png">
						<div style="padding: 0px 35px 0px 35px;">
							<p style>Pengguna: <?php echo $nama_user; ?></p>
						</div>
						<p class="field">
							<input type="hidden" name="username" value="<?php echo $username; ?>">
							<input type="password" name="password" placeholder="Password">
							<i class="icon-lock icon-large"></i>
						</p>
						<p class="submit">
							<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
						</p>
						<?php echo $this->session->flashdata('akses_validasi'); ?>
					</form>
				</section>
				
				<p><a href="<?php echo site_url();?>login/logout">Masuk sebagai user lain</a></p>
				<h2>Copyright © <?php echo date('Y'); ?><br>TeamIT</h2>
			
			</header>
			
			
        </div>
    </body>

    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/flat/assets/jquery/jquery-2.1.1.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>assets/flat/assets/bootstrap/js/bootstrap.min.js"></script>

</html>