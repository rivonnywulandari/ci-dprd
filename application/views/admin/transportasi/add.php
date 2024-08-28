<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <i class="fa fa-home" style="padding-right:5px;"></i>
      <li><?php echo $this->breadcrumb->output(); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->

<?php echo $this->session->flashdata('add');?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-title">
                <h3><i class="fa fa-bars"></i> Form Tambah</h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form enctype="multipart/form-data" action="<?php echo site_url();?>transportasi/add_save" class="form-horizontal" id="validation-form" method="post">     
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kategori*<br><i class="sm">pilih kategori transportasi</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <select class="form-control" name="id_kat" id="id_kat" data-rule-required="true">
                            <?php                            
                            echo "<option value='".$id_kategori."'>".$nama_kategori."</option>";
                            foreach ($kategori_cb as $row_combo){      
                                echo "<option value='".$row_combo->id."'>".$row_combo->nama."</option>"; 
                            } 
                            ?> 
                            </select>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Foto*
                        <br><i class="sm">pilih foto/gambar untuk transportasi<br>*) ukuran max. 5 MB ( jpg, png, gif )</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="foto" name="foto"  type="file" accept="image/*">
                        </div>
                    </div>--> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Rute Awal*
                            <br><i class="sm">masukkan rute awal transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="rute_awal" id="rute_awal" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Rute Tujuan*
                            <br><i class="sm">masukkan rute tujuan transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="rute_tujuan" id="rute_tujuan" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Merek Mobil*
                            <br><i class="sm">masukkan merek mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="merek_mobil" id="merek_mobil" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Type Mobil*
                            <br><i class="sm">masukkan type mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="type" id="type" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Ongkos Mobil*
                            <br><i class="sm">masukkan ongkos mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="ongkos" id="ongkos" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Lama Perjalanan*
                            <br><i class="sm">masukkan lama perjalanan mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="lama_perjalanan" id="lama_perjalanan" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Keterangan
                            <br><i class="sm">masukkan isi/keterangan transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <textarea name="keterangan" id="keterangan" class="form-control" data-rule-minlength="1" rows="10"></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                        <br><i class="sm">apakah transportasi akan ditampilkan atau tidak</i></label>
                        <div class="col-sm-6 col-lg-2 controls">
                            <select class="form-control" name="aktif" id="aktif" data-rule-required="true">
                            <option value="1">Tampil</value>
                            <option value="0">Tidak Tampil</value>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-9 col-lg-offset-3">                            
                            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>  Simpan</button>                            
                            <button class="btn btn-gray" type="button" onclick="self.history.back()"><i class="fa fa-undo"></i> Kembali</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->