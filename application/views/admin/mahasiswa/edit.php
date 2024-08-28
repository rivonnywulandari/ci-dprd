<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <i class="fa fa-home" style="padding-right:5px;"></i>
      <li><?php echo $this->breadcrumb->output(); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->

<?php echo $this->session->flashdata('edit');?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> Form Ubah</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form enctype="multipart/form-data" action="<?php echo site_url();?>mahasiswa/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id" value="<?php echo $data->id;?>"/>     
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Program Studi*<br><i class="sm">pilih program studi</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <select class="form-control" name="id_prodi" id="id_prodi" data-rule-required="true">
                            <?php
                            echo "<option value='".$id_prodi."'>".$judul_prodi."</option>"; 
                            foreach ($prodi_cb as $row_combo){      
                                echo "<option value='".$row_combo->id."'>".$row_combo->judul."</option>"; 
                            } 
                            ?> 
                            </select>
                        </div>
                        <div class="col-sm-6 col-lg-2 controls">
                            <input type="text" name="tahun_masuk" id="tahun_masuk" class="form-control"  data-mask="9999" placeholder="isi tahun masuk.." data-rule-minlength="4" data-rule-maxlength="4" data-rule-required="true" value="<?php echo $data->tahun_masuk;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Nama*
                            <br><i class="sm">masukkan nama lengkap mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="nama" id="nama" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->nama;?>"/>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">NIM
                            <br><i class="sm">masukkan NIM mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="nim" id="nim" class="form-control" data-rule-minlength="1" value="<?php echo $data->nim;?>" data-rule-required="true"/>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">TTL
                            <br><i class="sm">masukkan tempat tgl lahir mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"  placeholder="tempat lahir.." data-rule-minlength="1" value="<?php echo $data->tempat_lahir;?>" />
                        </div>
                        <div class="col-sm-6 col-lg-2 controls" data-date="<?php echo date('Y-m-d'); ?>" data-date-format="<?php echo date('Y-m-d'); ?>" data-date-viewmode="years">
                            <input class="form-control date-picker"  size="16" type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="tanggal lahir.." value="<?php echo $data->tanggal_lahir;?>" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Jenis Kelamin
                            <br><i class="sm">pilih jenis kelamin mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <select name="jekel" class="form-control" >
                            <?php if ($data->jekel == 'L') { $a="selected"; $b="";} else {$a=""; $b="selected";}?> 
                            <option <?php echo $a;?> value="L">Laki-laki</option>
                            <option <?php echo $b;?> value="P">Perempuan</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Agama*<br><i class="sm">pilih agama mahasiswa</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <select class="form-control" name="id_agama" id="id_agama" data-rule-required="true">
                            <?php
                            echo "<option value='".$id_agama."'>".$nama_agama."</option>"; 
                            foreach ($agama_cb as $row_combo){      
                                echo "<option value='".$row_combo->id."'>".$row_combo->nama."</option>"; 
                            } 
                            ?> 
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat
                            <br><i class="sm">masukkan alamat mahasiswa</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="alamat" id="alamat" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->alamat;?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. Telepon
                            <br><i class="sm">masukkan nomor telepon mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="telepon" id="telepon" class="form-control" data-rule-minlength="1" value="<?php echo $data->telepon;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. HP
                            <br><i class="sm">masukkan nomor HP mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="hp" id="hp" class="form-control" data-rule-minlength="1" value="<?php echo $data->hp;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Email
                            <br><i class="sm">masukkan alamat email mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="email" id="email" class="form-control" data-rule-minlength="1" value="<?php echo $data->email;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Web
                            <br><i class="sm">masukkan alamat web mahasiswa</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="web" id="web" class="form-control" data-rule-minlength="1" value="<?php echo $data->web;?>" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Riwayat Pendidikan
                            <br><i class="sm">masukkan riwayat mahasiswa</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="pendidikan" id="pendidikan" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->pendidikan;?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Keterangan Lain
                            <br><i class="sm">masukkan keterangan lainnya<br>seperti organisasi, dll</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="ket" id="ket" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->ket;?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Foto*
                        <br><i class="sm">pilih foto/gambar jika ada<br>*) ukuran max. 3000 KB</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="foto" name="foto"  type="file">
                            <div style="padding-top:5px;">
                                <a class="fancybox" href="<?php echo site_url().$this->master->getDataFoto('foto','tb_mahasiswa',$data->id); ?>">
                                <img style="width:100px;height:auto;" src="<?php echo site_url().$this->master->getDataFoto('foto','tb_mahasiswa',$data->id); ?>" alt="gambar">
                                </a>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                        <br><i class="sm">apakah data mahasiswa akan ditampilkan atau tidak</i></label>
                        <div class="col-sm-6 col-lg-2 controls">
                            <select class="form-control" name="aktif" id="aktif" data-rule-required="true">
                            <?php 
                            if ($data->aktif == '1') { 
                                $a="selected"; $b=""; $c="";
                            } 
                            else if ($data->aktif == '0') {
                                $a=""; $b="selected"; $c="";
                            }
                            else {
                                $a=""; $b=""; $c="selected";
                            }
                            ?>
                            <option <?php echo $a; ?> value="1">Tampil</value>
                            <option <?php echo $b; ?> value="0">Tidak Tampil</value>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>  Simpan</button>                           
                            <a href="<?php echo site_url('mahasiswa/view')?>" class="btn btn-gray">
                                <i class="fa fa-undo"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->

<script type="text/javascript">    
    $(document).ready(function() {
        $('#validation-form').submit(function(e) {
            var currentForm = this;
            e.preventDefault();
            bootbox.confirm("yakin data ini disimpan ?", function(result) {
              if (result) {
                currentForm.submit();
              }
            });
        }); 
    });
</script>  