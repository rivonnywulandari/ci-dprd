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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>file/add_save" class="form-horizontal" id="validation-form" method="post">     
                    
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">File*
                        <br><i class="sm">*) ukuran max. 10 MB<br>format file (pdf, doc, docx, xlsx)</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input id="dokumen" name="dokumen"  type="file">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Judul*
                            <br><i class="sm">masukkan judul file</i>
                        </label>
                        <div class="col-sm-6 col-lg-7 controls">
                            <input type="text" name="judul" id="judul" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Teks File*
                            <br><i class="sm">masukkan teks/keterangan file</i>
                        </label>
                         <div class="col-sm-6 col-lg-7 controls">
                            <textarea name="teks_file" id="teks_file" class="form-control" data-rule-required="true" data-rule-minlength="1" rows="10"></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kategori*<br><i class="sm">pilih kategori file</i></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <select class="form-control" name="id_kat" id="id_kat" data-rule-required="true">
                            <?php
                            echo "<option value=''>".$nama_kategori."</option>"; 
                            foreach ($kategori_cb as $row_combo){      
                                echo "<option value='".$row_combo->id."'>".$row_combo->nama."</option>"; 
                            } 
                            ?> 
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">PUBLISH*
                        <br><i class="sm">apakah file akan ditampilkan atau tidak</i></label>
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
</script>  