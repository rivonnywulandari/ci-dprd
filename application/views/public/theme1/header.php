<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="robots" content="all"/>
	<meta name="keywords" content="<?php echo $keyword; ?>" />
	<meta content="<?php echo $title; ?>" itemprop="about"/>
	<meta content="<?php echo $title; ?>" property="og:title"/>
	<meta name="description" content="<?php echo $title; ?>"/>
	<meta name="abstract" content="<?php echo $title; ?>"/>
	<meta name="distribution" content="global" />
	<meta name="audience" content="all"/>
	<meta name="rating" content="general" />        
	<meta name="author" content="RBS TIM" />
	<meta name="language" content="id" />
	<meta name="geo.country" content="id" />
	<meta name="geo.placename" content="Indonesia" />
	<meta name="spiders" content="ALL" />
	<meta name="MSSmartTagsPreventParsing" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<meta property="og:image" content="<?php echo $foto;?>" />
	
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo site_url();?>assets/public/theme1/img/favicon.png">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/css/shop.style.css">

	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/css/headers/header-v5.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/css/footers/footer-v4.css">

	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/animate.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/owl-carousel/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/revolution-slider/rs-plugin/css/settings.css">

	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/css/theme-colors/default.css" id="style_color">

	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/plugins/image-hover/css/img-hover.css">
	
	<link rel="stylesheet" href="<?php echo site_url();?>assets/public/theme1/css/custom.css">
</head>

<body class="header-fixed">

	<div class="wrapper">
		<!--=== Header v5 ===-->
		<div class="header-v5 header-static">
			<!-- Topbar v3 -->
			<div class="topbar-v3">
				<div class="search-open">
					<div class="container">
						<form method="post" action="<?php echo site_url();?>home/search">
						<input type="text" name="cari" class="form-control" placeholder="masukkan kata kunci">
						</form>
						<div class="search-close"><i class="icon-close"></i></div>
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<!-- Topbar Navigation -->
							<ul class="left-topbar">
								<li>
									<a href="http://dprd.sumbarprov.go.id/" style="text-transform:none;">
									<i class="fa fa-globe"></i> dprd.sumbarprov.go.id
									</a>
								</li>
							</ul><!--/end left-topbar-->
						</div>
						<div class="col-sm-6">
							<ul class="list-inline right-topbar pull-right">
								<li><a target="_blank" href="http://sumbarprov.go.id/">Provinsi Sumatera Barat</a></li>
								<li><i class="search fa fa-search search-button"></i></li>
							</ul>
						</div>
					</div>
				</div><!--/container-->
			</div>
			<!-- End Topbar v3 -->

			<!-- Navbar -->
			<div class="navbar navbar-default mega-menu" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo site_url();?>">
							<?php foreach ($this->master->getDisplay(4) as $row):?>
							<img width="100%" src="<?php echo site_url().$row->foto;?>"></img>
							<?php endforeach; ?>
						</a>
					</div>

					<!-- Shopping Cart -->
					<div class="shop-badge badge-icons pull-right">
						<a href="#"><i style="color:#231CE1;" class="fa fa-home"></i></a>
						<div class="badge-open">
							<ul class="list-unstyled mCustomScrollbar" data-mcs-theme="minimal-dark">
								<li>
									<button type="button" class="close"><i class="fa fa-home"></i></button>
									<div class="overflow-h">
										<span>Alamat</span>
										<small><?php echo $this->master->getData('alamat','tb_contact','id','1');?></small>
									</div>
								</li>
								<li>
									<button type="button" class="close"><i class="fa fa-phone"></i></button>
									<div class="overflow-h">
										<span>Telepon</span>
										<small><?php echo $this->master->getData('tlp','tb_contact','id','1');?></small>
									</div>
								</li>
								<li>
									<button type="button" class="close"><i class="fa fa-envelope-o"></i></button>
									<div class="overflow-h">
										<span>email</span>
										<small><?php echo $this->master->getData('email','tb_contact','id','1');?></small>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- End Shopping Cart -->

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<?php echo $this->menu->getMenuPublic();?>
					</div>
				</div>
			</div>
			<!-- End Navbar -->
		</div>
		<!--=== End Header v5 ===-->