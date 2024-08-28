<!DOCTYPE html>
<html>

<!-- Mirrored from shamsoft.net/flaty/extra_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 01:29:26 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login - Panel Admin</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

<!--base css styles-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/assets/font-awesome/css/font-awesome.min.css">

<!--page specific css styles-->

<!--flaty css styles-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/css/flaty.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/flat/css/flaty-responsive.css">

<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/icon.png">
</head>
<body class="login-page">
    <!-- BEGIN Main Content -->
    <div class="login-wrapper">
        <!-- BEGIN Login Form -->
        <form id="form-login" action="<?php echo site_url(); ?>login/proses_login" method="post">        
        
        <h3><img width="60px" src="<?php echo base_url(); ?>assets/img/logo.png"><br>Panel Admin</h3>
        <hr/>
        <?php echo $this->session->flashdata('akses_validasi'); ?>
        <p>Masukan Username dan Password dengan benar</p>
        <div class="form-group">
            <div class="controls">
                <input type="text" name="username" placeholder="username" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <div class="controls">
            <input type="password" name="password" placeholder="password" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary form-control">Sign In</button>
            </div>
        </div>
        <hr/>
        <p class="clearfix">
        <a href="#" class="goto-forgot pull-left">Copyright © <?php echo date('Y'); ?></a>
        <a href="#" class="goto-register pull-right">Team<b>IT</b></a>
        </p>
        </form>
        <!-- END Login Form -->
    <!-- END Forgot Password Form -->
    </div>

    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/flat/assets/jquery/jquery-2.1.1.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>assets/flat/assets/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
