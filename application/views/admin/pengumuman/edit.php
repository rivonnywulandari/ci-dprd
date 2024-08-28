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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>pengumuman/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id" value="<?php echo $data->id;?>"/>         
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Judul*
                            <br><i class="sm">masukkan judul pengumuman</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="judul" id="judul" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->judul;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kategori*
                            <br><i class="sm">pilih kategori pengumuman</i>
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
                            <br><i class="sm">masukkan isi pengumuman</i>
                        </label>
                        <div class="col-sm-6 col-lg-9 controls">
                            <textarea name="isi" id="isi" placeholder="isi" class="form-control input-md ckeditor" data-rule-required="true" data-rule-minlength="1"><?php echo $data->isi;?></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Foto
                            <br><i class="sm">pilih foto/gambar jika ada<br>*) ukuran max. 5 MB</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="foto" name="foto"  type="file" accept="image/*">
                            <div style="padding-top:5px;">
                                <a class="fancybox" href="<?php echo site_url().$this->master->getDataFoto('foto','tb_pengumuman',$data->id); ?>">
                                <img style="width:100px;height:auto;" src="<?php echo site_url().$this->master->getDataFoto('foto','tb_pengumuman',$data->id); ?>" alt="gambar">
                                </a>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Teks Foto
                            <br><i class="sm">masukkan teks/keterangan foto jika ada</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="teks_foto" id="teks_foto" class="form-control" data-rule-minlength="1" value="<?php echo $this->master->getDataFoto('isi','tb_pengumuman',$data->id); ?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">File
                            <br><i class="sm">pilih file/dokumen file<br>*) ukuran max. 10 Mb<br>format file (pdf, doc, docx, xlsx)</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="dokumen" name="dokumen" type="file">
                            <div style="padding-top:5px;">
                                <a target="_blank" href="<?php echo site_url().$this->master->getDataFile('dokumen','tb_pengumuman',$data->id); ?>">
                                <?php 
                                if ($this->master->countDataFile('tb_pengumuman',$data->id))
                                echo $this->master->getDataFile('nama_file','tb_pengumuman',$data->id)." (".$this->master->getDataFile('ukuran','tb_pengumuman',$data->id)." KB)"; 
                                ?>
                                </a>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Teks File
                            <br><i class="sm">masukkan teks/keterangan foto jika ada</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="teks_file" id="teks_file" class="form-control" data-rule-minlength="1" value="<?php echo $this->master->getDataFile('isi','tb_pengumuman',$data->id); ?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                            <br><i class="sm">apakah pengumuman akan ditampilkan atau tidak</i>
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
                            <a href="<?php echo site_url('pengumuman/view')?>" class="btn btn-gray">
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