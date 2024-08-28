<div class="page-title"><div></div></div>

<div id="breadcrumbs">
    <ul class="breadcrumb">
        <i class="fa fa-home" style="padding-right:5px;"></i>
        <li><?php echo $this->breadcrumb->output(); ?></li>
    </ul>
</div>
			
<div id="page-content">
	
	<div class="row demo-nifty-panel">
		<div class="col-lg-12">	
	
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-control">	
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#demo-tabs-box-1">Akun</a>
							</li>
							<li><a data-toggle="tab" href="#demo-tabs-box-2">Data Pengguna</a>
							</li>
						</ul>
	
					</div>
				</div>
	
				<!--Panel body-->
				<div class="panel-body">
					<div class="tab-content">
						<div id="demo-tabs-box-1" class="tab-pane fade in active">
							<form id="form_entry_agenda" class="form-horizontal" >
								<div class="panel-body">	
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Username</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $username;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Password</label>
											<div class="col-lg-2">
												<input type="password" class="form-control" name="lama" value="**********" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
												<a href="<?php echo site_url()?>account/password" class="btn btn-warning btn-xs"><i class="fa fa-cogs"></i> ganti password</a>
											</div>														
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Group</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $group_name;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Status</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $status_aktif;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>				
								</div>								
							</form>
						</div>
						
						
						<div id="demo-tabs-box-2" class="tab-pane fade">
							<form id="form_entry_agenda" class="form-horizontal" >
								<div class="panel-body">
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Nama</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $nama_user;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Gender</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $nama_jekel;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Alamat</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $alamat;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>
									<fieldset>
										<div class="form-group">
											<label class="col-lg-3 control-label">Telepon</label>
											<div class="col-lg-2">
												<input type="text" class="form-control" name="lama" value="<?php echo $telepon;?>" required="" data-validation="required" data-validation-error-msg="Wajib diisi" disabled>
											</div>														
									</fieldset>				
								</div>								
							</form>
						</div>										
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>