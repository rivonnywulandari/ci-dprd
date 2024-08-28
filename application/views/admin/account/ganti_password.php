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

<?php echo $this->session->flashdata('password');?>

<!-- BEGIN Main Content -->
<div class="row">
	<div class="col-md-12">
		<div class="box box-orange">
			<div class="box-title">
				<h3><i class="fa fa-cog"></i> Form Ubah</h3>
				<div class="box-tool">
					<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
					<a data-action="close" href="#"><i class="fa fa-times"></i></a>
				</div>
			</div>

			<div class="box-content">
				<br>
				<form action="<?php echo site_url(); ?>account/ganti_password" class="form-horizontal" method="post" id="wizard-validation">				

				<div class="form-group">
					<label class="col-lg-3 control-label">Password Lama</label>
					<div class="col-lg-3">
						<input type="password" class="form-control" name="lama" placeholder="isi password lama" required="" data-validation="required" data-validation-error-msg="Wajib diisi">
					</div>
				</div>

				<hr>

				<div class="form-group">
					<label class="col-lg-3 control-label">Password Baru</label>
					<div class="col-lg-3">
						<input type="password" class="form-control" name="baru" placeholder="isi password baru" required="" data-validation="required" data-validation-error-msg="Wajib diisi">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-3 control-label">Konfirmasi Password Baru</label>
					<div class="col-lg-3">
						<input type="password" class="form-control" name="konfirmasi" placeholder="konfirmasi password baru" required="" data-validation="required" data-validation-error-msg="Wajib diisi">
					</div>
				</div>				
										
				<input type="hidden" class="form-control" name="id_user" value="<?php echo $id_user;?>" readonly>
				<input type="hidden" class="form-control" name="nama_user" value="<?php echo $nama_user;?>" readonly>
		
				<!--===================================================-->
	
				<div class="form-group">
					<label class="col-lg-3 control-label"></label>
					<div class="col-lg-3">
						<button class="btn btn-primary" type="submit">Simpan</button>
						<button type="button" class="btn" onclick="self.history.back()">Kembali</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END Main Content -->

	