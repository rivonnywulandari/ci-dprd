<!-- BEGIN Page Title -->
<div class="page-title"><div></div></div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<i class="fa fa-home" style="padding-right:5px;"></i>
			<li><?php echo $this->breadcrumb->output(); ?></li>
	</ul>
</div>
<!-- END Breadcrumb -->

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

	<a href="<?php echo site_url();?>user/view">
	<div class="col-md-3">		
		<div class="tile tile-orange">
		<div class="img">
		<i class="fa fa-child"></i>

		</div>
		<div class="content">
		<p class="big"><?php echo $user;?></p>
		<p class="title">User</p>
		</div>
		</div>
	</div>
	</a>	

	<a href="<?php echo site_url();?>group/view">
	<div class="col-md-2">
		<div class="tile tile-green">
			<div class="img">
				<i class="fa fa-cube"></i>
			</div>
			<div class="content">
				<p class="big"><?php echo $this->master->countData('_group','aktif','1');?></p>
				<p class="title">Group</p>
			</div>
		</div>
	</div>
	</a>

	<a href="<?php echo site_url();?>module/view">
	<div class="col-md-2">
		<div class="tile tile-dark-mint">
			<div class="img">
				<i class="fa fa-wrench"></i>
			</div>
			<div class="content">
				<p class="big"><?php echo $this->master->countData('_module','aktif','1');?></p>
				<p class="title">Module</p>
			</div>
		</div>
	</div>
	</a>

</div>
<!-- END Tiles -->