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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>informasi/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id" value="<?php echo $data->id;?>"/>   
                    <input type="hidden" name="subjudul" id="subjudul" class="form-control" data-rule-minlength="1" value="<?php echo $data->subjudul;?>"/>      
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Judul*
                            <br><i class="sm">masukkan judul informasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="judul" id="judul" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->judul;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kategori*
                            <br><i class="sm">pilih kategori informasi</i>
                        </label>
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
                        <label class="col-sm-3 col-lg-3 control-label">Isi*
                            <br><i class="sm">masukkan isi informasi</i>
                        </label>
                        <div class="col-sm-6 col-lg-9 controls">
                            <textarea name="isi" id="isi" placeholder="isi" class="form-control input-md ckeditor" data-rule-required="true" data-rule-minlength="1"><?php echo $data->isi;?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kata Kunci*
                            <br><i class="sm">masukkan tag/keyword/kata kunci informasi, pisahkan dengan tanda koma</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="tag" id="tag" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->tag;?>"/>
                            <i class="sm">ex: rumah, bencana alam, udara</i>
                        </div>
                    </div> 
                    <input type="hidden" name="headline" id="headline"/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Foto
                            <br><i class="sm">pilih foto/gambar jika ada<br>*) ukuran max. 5 MB</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="foto" name="foto"  type="file" accept="image/*">        
                            <div style="padding-top:5px;">
                                <a class="fancybox" href="<?php echo site_url().$this->master->getDataFoto('foto','tb_informasi',$data->id); ?>">
                                <img style="width:100px;height:auto;" src="<?php echo site_url().$this->master->getDataFoto('foto','tb_informasi',$data->id); ?>" alt="gambar">
                                </a>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Teks Foto
                            <br><i class="sm">masukkan teks/keterangan foto jika ada</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="teks_foto" id="teks_foto" class="form-control" data-rule-minlength="1" value="<?php echo $this->master->getDataFoto('isi','tb_informasi',$data->id); ?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                            <br><i class="sm">apakah informasi akan ditampilkan atau tidak</i>
                        </label>
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
                            <a href="<?php echo site_url('informasi/view')?>" class="btn btn-gray">
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