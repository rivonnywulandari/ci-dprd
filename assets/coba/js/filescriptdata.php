<!--- Modal filedata ///////////////////////////////////////////////////////////////////////////////////-->
			<div class="modal fade" id="modal-file-new" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
                            <h3 class="modal-title red" id="label-file-new">filedata Baru</h3>
                        </div>
                        <div class="row">
	                        <div class="col-xs-12">
								<?php echo $this->session->flashdata('add_user'); ?>
	                        <div class="modal-body">
								<div id="fuelux-wizard-container">
									<div>
										<ul class="steps">
											<li data-step="1" class="active">
												<span class="step">1</span>
												<span class="title">Profil</span>
											</li>

											<li data-step="2">
												<span class="step">2</span>
												<span class="title">Password</span>
											</li>

											<li data-step="3">
												<span class="step">3</span>
												<span class="title">Telepon dan Email</span>
											</li>

											<li data-step="4">
												<span class="step">4</span>
												<span class="title">Jenis Pengguna</span>
											</li>
										</ul>
									</div>

									<hr />
									
									<div class="step-content pos-rel">
										<form id="new-user" class="form-horizontal" role="form" action="<?php echo site_url('administrator/save-pengguna'); ?>" method="post">
											<input type="hidden" id="id_inventaris_parent" name="id_inventaris_parent" value="<?php echo $id_inventaris ?>">
											<input type="hidden" id="id_inventaris" name="id_inventaris">
											<h5 class="smaller lighter black">Buat filedata baru di inventaris <b id="judul-file-new"></b></h5>

											<fieldset>
												<div class="step-pane active" data-step="1">
													<h3 class="lighter block green">Scan Data</h3>

													<div class="form-group">
														<label class="col-sm-3 control-label" for="file_lampiran" style="text-align:left;"> Copy Digital </label>
														<div class="col-xs-12 col-sm-8">
															<input type="file" name="file_lampiran" id="file_lampiran" />
															<span><i>*Max upload file 10 MB</i></span>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label" for="keterangan" style="text-align:left;"> Keterangan </label>
														<div class="col-xs-12 col-sm-8">
															<input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan File" data-validation="required" data-validation-error-msg="Keterangan file harus diisi!">
														</div>
													</div>

						                        	<div class="form-group">
														<label class="col-sm-3 control-label" for="tahun_pembuatan" style="text-align:left;"> Tahun </label>
														<div class="col-xs-12 col-sm-5 ">
															<div class="input-group">
															<input type="text" id="tahun_pembuatan" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control" placeholder="Tahun pembuatan" data-validation="required" data-validation-error-msg="Tahun pembuatan harus diisi!">
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label" for="jumlah_fisik" style="text-align:left;"> Jumlah Fisik </label>
														<div class="col-xs-12 col-sm-8">
															<input type="text" id="jumlah_fisik" name="jumlah_fisik" id="jumlah_fisik" class="form-control" placeholder="Jumlah Fisik" data-validation="required" data-validation-error-msg="Nama file harus diisi berupa angka!">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label" for="id_media" style="text-align:left;"> Jenis Media File </label>
														<div class="col-xs-12 col-sm-8">
															<select class="form-control select-data" style="width:100%" id="id_media" name="id_media">
																<option value="">Pilih Kategori</option>
																<?php foreach ($data_media as $key): ?>
																	<option value="<?php echo $key->id_media; ?>"><?php echo $key->nm_media; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label" for="id_jenis_scan" style="text-align:left;"> Jenis Scan File </label>
														<div class="col-xs-12 col-sm-8">
															<select class="form-control select-data" style="width:100%" id="id_jenis_scan" name="id_jenis_scan">
																<option value="">Pilih Kategori</option>
																<?php foreach ($data_jenis as $key): ?>
																	<option value="<?php echo $key->id_jenis_scan; ?>"><?php echo $key->nm_jenis_scan; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>

												</div>
												<!-- Step 2 -->
												<div class="step-pane" data-step="2">
													<h3 class="lighter block green">Isi Sandi</h3>
													<h5 class="lighter block red">Kata sandi minimal 6 karakter</h5>

													<div class="form-group">
														<label class="col-sm-2 control-label" for="password" style="text-align:left;"> Kata Sandi </label>
														<div class="col-sm-10">
															<input type="password" id="password" name="password" placeholder="Kata Sandi Baru" class="col-xs-10 col-sm-5"/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label" for="passconf" style="text-align:left;"> Ulangi Kata Sandi </label>
														<div class="col-sm-10">
															<input type="password" id="passconf" name="passconf" placeholder="Ulangi Kata Sandi Baru" class="col-xs-10 col-sm-5"/>
														</div>
													</div>	
												</div>

												<div class="step-pane" data-step="3">
													<h3 class="lighter block green">Isi Nomor Telepon dan Alamat Email</h3>

													<div class="form-group">
														<label class="col-sm-2 control-label" for="telp" style="text-align:left;"> No. Telepon </label>
														<div class="col-sm-10">
															<input type="text" id="telp" name="telp" placeholder="Nomor Telepon" class="col-xs-10 col-sm-5"/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label" for="email" style="text-align:left;"> Email </label>
														<div class="col-sm-10">
															<input type="text" id="email" name="email" placeholder="Alamat Email" class="col-xs-10 col-sm-5"/>
														</div>
													</div>

												</div>

												<div class="step-pane" data-step="4">
													<h3 class="lighter block green">Pilih Jenis Pengguna</h3>

													<div class="form-group">
														<label class="col-sm-2 control-label" for="groups" style="text-align:left;"> Grup Pengguna </label>
														<div class="col-sm-10">
															<?php foreach ($group as $key): ?>
																<div class="radio col-xs-12 col-sm-3 no-padding-left">
																	<?php 
						                                                if($key->id_groups == '3')
						                                                  $pilih = "checked";
						                                                else 
						                                                  $pilih = "";
				                                            		?>
																	<label>
																		<input class="ace" type="radio" name="group" id="group" value="<?php echo $key->id_groups; ?>" <?php echo $pilih; ?> />
																		<span class="lbl"> <?php echo $key->nama_groups; ?> </span>
																	</label>
																	<div id="<?php echo $key->kode_groups; ?>-role-akses" class="user-role-akses">
																		<?php foreach ($module as $row): 
																			$getData = $this->model_public->QuerySingleValue("SELECT count(id_groups_module) as numrows FROM _groups_module WHERE id_groups = '$key->id_groups' and id_modules = '$row->id_modules'");
																			if($getData->numrows == '1')
																				$check = "checked";
																			else
																				$check = "";
																		?>
																			<div class="checkbox">
																				<label>
																					<input id="id_<?php echo $row->kode_modules; ?>" name="<?php echo $key->kode_groups; ?>-modules[]" class="ace" type="checkbox" value="<?php echo $row->id_modules; ?>" <?php echo $check; ?> />
																					<span class="lbl"> <?php echo $row->nama_modules; ?></span>
																				</label>
																			</div>
																		<?php endforeach ?>
																	</div>
																</div>
															<?php endforeach ?>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label" for="status" style="text-align:left;"> Aktifkan Pengguna </label>
														<div class="col-sm-1 checkbox">
															<label>
																<input class="ace ace-switch ace-switch-5" type="checkbox" name="status" />
																<span class="lbl"></span>
															</label>
														</div>
													</div>

												</div>
											</fieldset>
										</form>
									</div>
								</div>

								<hr />

								<div class="pull-left hidden">
									<a href="javascript:history.back()" class="btn btn-danger"><i class="ace-icon fa fa-chevron-left"></i>Batal</a>
								</div>
								<div class="wizard-actions">
									<button class="btn btn-prev">
										<i class="ace-icon fa fa-arrow-left"></i>
										Kembali
									</button>

									<button class="btn btn-success btn-next" data-last="Finish">
										Berikutnya
										<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>

			<div class="modal fade" id="modal-file-ubah" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title red" id="label-file-ubah">Ubah filedata</h3>
                        </div>
                        <form class="form-horizontal" role="form" action="<?php echo site_url('pengolahan/update-file'); ?>" method="post" enctype="multipart/form-data">
	                        <div class="modal-body">
	                        	<h5 class="smaller lighter black">Ubah filedata inventaris <b id="judul-file-ubah"></b> </h5>
	                        	<input type="hidden" id="id_file" name="id_file">
								<input type="hidden" name="id_inventaris" value="<?php  echo $id_inventaris;?>">

								<div class="form-group">
									<label class="col-sm-3 control-label" for="file_lampiran" style="text-align:left;"> Copy Digital </label>
									<div class="col-xs-12 col-sm-8">
										<input type="file" name="file_lampiran" id="file_lampiran33" />
										<span><i>*Max upload file 10 MB</i></span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="keterangan" style="text-align:left;"> Keterangan </label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan File" data-validation="required" data-validation-error-msg="Keterrangan file harus diisi!">
									</div>
								</div>

	                        	<div class="form-group">
									<label class="col-sm-3 control-label" for="tahun_pembuatan" style="text-align:left;"> Tahun Pembuatan </label>
									<div class="col-xs-12 col-sm-5 ">
										<div class="input-group">
										<input type="text" name="tahun_pembuatan" id="tahun_pembuatan" class="form-control" placeholder="Tahun pembuatan" data-validation="required" data-validation-error-msg="Tahun pembuatan harus diisi!">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="jumlah_fisik" style="text-align:left;"> Jumlah Fisik </label>
									<div class="col-xs-12 col-sm-8">
										<input type="text" name="jumlah_fisik" id="jumlah_fisik" class="form-control" placeholder="Jumlah Fisik" data-validation="required" data-validation-error-msg="Nama file harus diisi berupa angka!">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="id_media" style="text-align:left;"> Jenis Media File </label>
									<div class="col-xs-12 col-sm-8">
										<select class="form-control select-data" style="width:100%" id="id_media" name="id_media">
											<option value="0">Pilih Kategori</option>
											<?php foreach ($data_media as $key): ?>
												<option value="<?php echo $key->id_media; ?>"><?php echo $key->nm_media; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="id_jenis_scan" style="text-align:left;"> Jenis Scan File </label>
									<div class="col-xs-12 col-sm-8">
										<select class="form-control select-data" style="width:100%" id="id_jenis_scan" name="id_jenis_scan">
											<option value="0">Pilih Kategori</option>
											<?php foreach ($data_jenis as $key): ?>
												<option value="<?php echo $key->id_jenis_scan; ?>"><?php echo $key->nm_jenis_scan; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label" for="status" style="text-align:left;"> Aktifkan </label>
									<div class="col-sm-1 checkbox" style="padding-left:2px;">
										<label>
											<input class="ace ace-switch ace-switch-5" type="checkbox" name="status" id="status_ubah" onclick="check_active_ubah()"/>
											<span class="lbl"></span>
										</label>
									</div>
								</div>

	                        </div>
	                        <div class="modal-footer">
	                        	<button class="btn btn-sm btn-danger" data-dismiss="modal" id="close-modal-ubah">
									<i class="ace-icon fa fa-times"></i>
									Batal
								</button>
								<button class="btn btn-sm btn-primary" type="submit" name="update" id="update-file" disabled="disabled">
									<i class="ace-icon fa fa-check"></i>
									Ya, Ubah
								</button>
	                        </div>
                        </form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="modal-file-hapus" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title red" id="label-file-hapus">Hapus filedata</h3>
                        </div>
                        <form class="form-horizontal" role="form" action="<?php echo site_url('pengolahan/delete-file'); ?>" method="post">
	                        <div class="modal-body">
	                        	<h5 class="smaller lighter black"> Benar ingin menghapus filedata <b id="judul-file-hapus"></b> ?</h5>
	                        	<input type="hidden" id="id_file_hapus" name="id_file_hapus">
								<input type="hidden" name="id_inventaris" value="<?php  echo $id_inventaris;?>">

								<div class="form-group">
									<label class="col-sm-3 control-label" for="status" style="text-align:left;"> Validasi Hapus </label>
									<div class="col-sm-1 checkbox" style="padding-left:2px;">
										<label>
											<input class="ace ace-switch ace-switch-5" type="checkbox" name="status" id="status_hapus" onclick="check_active_hapus()"/>
											<span class="lbl"></span>
										</label>
									</div>
								</div>

	                        </div>
	                        <div class="modal-footer">
	                        	<button class="btn btn-sm btn-danger" data-dismiss="modal" id="close-modal-hapus">
									<i class="ace-icon fa fa-times"></i>
									Batal
								</button>
								<button class="btn btn-sm btn-primary" type="submit" name="delete" id="delete-file" disabled="disabled">
									<i class="ace-icon fa fa-check"></i>
									Ya, Hapus
								</button>
	                        </div>
                        </form>
					</div>
				</div>
			</div>