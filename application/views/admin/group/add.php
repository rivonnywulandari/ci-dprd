<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <i class="fa fa-home" style="padding-right:5px;"></i>
      <li><?php echo $this->breadcrumb->output(); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->

<?php echo $this->session->flashdata('add'); ?>

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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>group/add_save" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Nama Group*
                            <br><i class="sm">masukkan nama group</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="group_name" id="group_name" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $group_name;?>" />
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Hak Akses*
                            <br><i class="sm">hak akses group</i>
                        </label>
                        <div class="col-sm-9 col-lg-9 controls">
                            <?php foreach ($module as $row):?>
                            <label class="checkbox">
                            <input name="checkbox[]" type="checkbox" value="<?php echo $row->id_module; ?>"> <?php echo $row->module_name; ?>
                            </label>
                            <?php endforeach;?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">STATUS
                            <br><i class="sm">pilih status group</i>
                        </label>
                        <div class="col-sm-6 col-lg-2 controls">
                            <div class="make-switch switch-small">                           
                            <input name="aktif" type="checkbox"/>                          
                            </div>
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