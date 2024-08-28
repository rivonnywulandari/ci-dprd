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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>transportasi/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="text" name="id" value="<?php echo $data->id;?>"/>    
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
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Rute Awal*
                            <br><i class="sm">masukkan rute awal transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="rute_awal" id="rute_awal" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->rute_awal;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Rute Tujuan*
                            <br><i class="sm">masukkan rute tujuan transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="rute_tujuan" id="rute_tujuan" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->rute_tujuan;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Merek Mobil*
                            <br><i class="sm">masukkan merek mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="merek_mobil" id="merek_mobil" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->merek_mobil;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Type Mobil*
                            <br><i class="sm">masukkan type mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="type" id="type" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->type;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Ongkos Mobil*
                            <br><i class="sm">masukkan ongkos mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="ongkos" id="ongkos" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->ongkos;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Lama Perjalanan*
                            <br><i class="sm">masukkan lama perjalanan mobil transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="lama_perjalanan" id="lama_perjalanan" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->lama_perjalanan;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Keterangan
                            <br><i class="sm">masukkan isi/keterangan transportasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <textarea name="keterangan" id="keterangan" class="form-control" data-rule-minlength="1" rows="10"><?php echo $data->keterangan;?></textarea>
                        </div>
                    </div>                     
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No Urut
                            <br><i class="sm">masukkan nomor urut penampilan transportasi <br> ex : 1</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="no_urut" id="no_urut" class="form-control" data-rule-minlength="1" value="<?php echo $data->no_urut;?>"/>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                        <br><i class="sm">apakah transportasi akan ditampilkan atau tidak</i></label>
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
                            <a href="<?php echo site_url('transportasi/view')?>" class="btn btn-gray">
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