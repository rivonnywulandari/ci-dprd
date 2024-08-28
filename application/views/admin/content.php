<!-- BEGIN Page Title -->
<div class="page-title">
	<div>
	<h1><i class="fa fa-home"></i> Dashboard</h1>
	<h4>welcome to my panel admin</h4>
	</div>
</div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<i class="fa fa-home" style="padding-right:5px;"></i>
			<li><?php echo $this->breadcrumb->output(); ?></li>
	</ul>
</div>
<!-- END Breadcrumb -->

<!-- BEGIN Tiles -->
<div class="row">
	<div class="col-md-5">
	<div class="tile">
	<p class="title">Selamat Datang - di Panel Admin</p>
	<p>Untuk Keamananan Data, Silahkan
	<a href="<?php echo site_url(); ?>lock" style="color:yellow;">lock</a>  atau
	<a href="<?php echo site_url(); ?>login/logout" style="color:yellow;">logout</a>
	apabila telah selesai menggunakan aplikasi.</p>
	<div class="img img-bottom">
	<i class="fa fa-desktop"></i>
	</div>
	</div>
	</div>	

	<a href="<?php echo site_url();?>berita/view">
	<div class="col-md-3">		
		<div class="tile tile-orange">
		<div class="img">
		<i class="fa fa-pencil-square"></i>

		</div>
		<div class="content">
		<p class="big"><?php echo $this->master->countData('tb_berita','aktif','1');?></p>
		<p class="title">Berita</p>
		</div>
		</div>
	</div>
	</a>	

	<a href="<?php echo site_url();?>foto/view">
	<div class="col-md-2">
		<div class="tile tile-green">
			<div class="img">
				<i class="fa fa-image"></i>
			</div>
			<div class="content">
				<p class="big"><?php echo $this->master->countData('tb_foto','aktif','1');?></p>
				<p class="title">Foto</p>
			</div>
		</div>
	</div>
	</a>

	<a href="<?php echo site_url();?>file/view">
	<div class="col-md-2">
		<div class="tile tile-dark-mint">
			<div class="img">
				<i class="fa fa-clipboard"></i>
			</div>
			<div class="content">
				<p class="big"><?php echo $this->master->countData('tb_file','aktif','1');?></p>
				<p class="title">File</p>
			</div>
		</div>
	</div>
	</a>

</div>
<!-- END Tiles -->

