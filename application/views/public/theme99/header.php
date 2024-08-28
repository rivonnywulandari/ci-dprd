<!DOCTYPE html>
<html lang="en" class="">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Sekretariat DPRD Provinsi Sumatera Barat</title>

  <link rel="shortcut icon" href="<?php echo site_url();?>assets/public/img/favicon.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/public/theme2/fontawesome-free/css/all.css');?>">
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/public/theme2/css/bootstrap.min.css');?>" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo base_url('assets/public/theme2/css/mdb.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/public/theme2/css/custom.css');?>" rel="stylesheet">

  <!-- Owl Carousel -->
  <link rel="stylesheet" href="<?php echo base_url('assets/public/theme2/owlcarousel/dist/assets/owl.carousel.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/public/theme2/owlcarousel/dist/assets/owl.theme.default.min.css');?>">

  <script> var base_url = "<?php echo base_url();?>"; </script>
</head>

<body>
<!--Big blue-->
<div class="preloader-wrapper active">
  <div class="spinner-layer spinner-blue-only">
    <div class="circle-clipper left">
      <div class="circle"></div>
    </div>
    <div class="gap-patch">
      <div class="circle"></div>
    </div>
    <div class="circle-clipper right">
      <div class="circle"></div>
    </div>
  </div>
</div>
 <!--Main Navigation-->
 <header>
 <style type="text/css">
 .asd{
  border: 1px solid red;
 }
 </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top scrolling-navbar white ">
        <div class="container">
          <!-- Navbar brand -->
          <a class="navbar-brand" href="#">
            
            <img class="full-width img-fluid" src="<?php echo site_url('assets/dprd.png');?>" alt="">
          </a>
          <!-- Collapse button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Collapsible content -->
          <div class="collapse navbar-collapse " id="navbarSupportedContent">        
                <!-- Links -->
                <ul class="navbar-nav mr-auto ">
                  <?php echo $this->menu->getMenuPublic();?>
                </ul>
                <!-- Links -->
          </div>
          <!-- Collapsible content -->
      </div>
    </nav>
<!-- Navbar -->
</header>



