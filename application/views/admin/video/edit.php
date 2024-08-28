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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>video/edit_save" class="form-horizontal validation-video" method="post">
                    <input type="hidden" name="id" value="<?php echo $data->id;?>"/> 
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Foto Preview*
                        <br><i class="sm">*) pilih foto/gambar preview Video</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input name="preview"  type="hidden" value="<?php echo $data->preview; ?>">
                            <input id="foto" name="foto"  accept="image/*" type="file"/>                            
                            <div style="padding-top:5px;">
                                <a class="fancybox" href="<?php echo site_url().$data->preview; ?>" />
                                <img style="width:100px;height:auto;" src="<?php echo site_url().$data->preview; ?>" alt="gambar">
                                </a>
                            </div>
                        </div>
                    </div>  
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">video*
                        <br><i class="sm">*) ukuran max. 500 MB, format video (flv/mp4)</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="video" name="video" accept="video/*" type="file"/>
                            <div style="padding-top:5px;">
                                <a target="_blank" href="<?php echo site_url().$this->master->getData('video','tb_video','id',$data->id); ?>">
                                <?php echo $this->master->getData('nama_video','tb_video','id',$data->id); ?> (<?php echo $this->master->getData('ukuran','tb_video','id',$data->id); ?>KB)
                                </a>
                            </div>
                        </div>
                    </div>                                       
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kategori*<br><i class="sm">pilih kategori video</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <select class="form-control" name="id_kat" id="id_kat" required>
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
                        <label class="col-sm-3 col-lg-3 control-label">Judul*
                            <br><i class="sm">masukkan judul video</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $data->judul;?>" required/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Teks video*
                            <br><i class="sm">masukkan teks/keterangan video</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <textarea name="teks_video" id="teks_video" class="form-control" rows="10" required><?php echo $data->isi;?></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kata Kunci*
                            <br><i class="sm">masukkan tag/keyword/kata kunci foto, pisahkan dengan tanda koma</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="tag" id="tag" class="form-control" value="<?php echo $data->tag;?>" required/>
                            <i class="sm">ex: rumah, bencana alam, udara</i>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                        <br><i class="sm">apakah video akan ditampilkan atau tidak</i></label>
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
                            <a href="<?php echo site_url('video/view')?>" class="btn btn-gray">
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

<div id="progress" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Proses Penyimpanan Data</h3>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="bar"></div >
                    <div class="percent">0%</div >
                </div>
                <div id="status"></div>
            </div>
        </div>
    </div>
</div>