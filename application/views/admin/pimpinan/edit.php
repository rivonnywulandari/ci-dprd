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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>pimpinan/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id" value="<?php echo $data->id;?>"/>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Nama*
                            <br><i class="sm">masukkan nama lengkap pimpinan</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="nama" id="nama" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->nama;?>"/>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">JABATAN
                            <br><i class="sm">masukkan jabatan pimpinan</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="jabatan" id="jabatan" class="form-control" data-rule-minlength="1" value="<?php echo $data->jabatan;?>"/>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">TTL
                            <br><i class="sm">masukkan tempat tgl lahir pimpinan</i>
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
                            <br><i class="sm">pilih jenis kelamin pimpinan</i>
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
                        <label class="col-sm-3 col-lg-3 control-label">Agama*<br><i class="sm">pilih agama pimpinan</i></label>
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
                            <br><i class="sm">masukkan alamat pimpinan</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="alamat" id="alamat" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->alamat;?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. Telepon
                            <br><i class="sm">masukkan nomor telepon pimpinan</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="telepon" id="telepon" class="form-control" data-rule-minlength="1" value="<?php echo $data->telepon;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. HP
                            <br><i class="sm">masukkan nomor HP pimpinan</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="hp" id="hp" class="form-control" data-rule-minlength="1" value="<?php echo $data->hp;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Email
                            <br><i class="sm">masukkan alamat email pimpinan</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="email" id="email" class="form-control" data-rule-minlength="1" value="<?php echo $data->email;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Web
                            <br><i class="sm">masukkan alamat web pimpinan</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="web" id="web" class="form-control" data-rule-minlength="1" value="<?php echo $data->web;?>" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Riwayat Pendidikan
                            <br><i class="sm">masukkan riwayat pimpinan</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="pendidikan" id="pendidikan" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->pendidikan;?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Keterangan Lain
                            <br><i class="sm">masukkan alamat pimpinan</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="ket" id="ket" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->ket;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. Urut
                            <br><i class="sm">masukkan nomor urut penampilan data</i>
                        </label>
                        <div class="col-sm-2 col-lg-2 controls">
                            <input type="number" name="no_urut" id="no_urut" class="form-control" data-rule-minlength="1" value="<?php echo $data->no_urut;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Foto*
                        <br><i class="sm">pilih foto/gambar jika ada<br>*) ukuran max. 5 MB</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="foto" name="foto"  type="file" accept="image/*">
                            <div style="padding-top:5px;">
                                <a class="fancybox" href="<?php echo site_url().$this->master->getDataFoto('foto','tb_pimpinan',$data->id); ?>">
                                <img style="width:100px;height:auto;" src="<?php echo site_url().$this->master->getDataFoto('foto','tb_pimpinan',$data->id); ?>" alt="gambar">
                                </a>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Teks Foto*
                            <br><i class="sm">masukkan teks/keterangan foto jika ada</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="teks_foto" id="teks_foto" class="form-control" data-rule-minlength="1" value="<?php echo $this->master->getDataFoto('isi','tb_pimpinan',$data->id); ?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                        <br><i class="sm">apakah pimpinan akan ditampilkan atau tidak</i></label>
                        <div class="col-sm-6 col-lg-2 controls">
                            <select class="form-control" name="aktif" id="aktif" data-rule-required="true">
                            <?php if ($data->aktif == '1') { $a="selected"; $b="";} else {$a=""; $b="selected";}?>
                            <option <?php echo $a; ?> value="1">Tampil</value>
                            <option <?php echo $b; ?> value="0">Tidak Tampil</value>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>  Simpan</button>                           
                            <a href="<?php echo site_url('pimpinan/view')?>" class="btn btn-gray">
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