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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>module/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id_module" value="<?php echo $data->id_module;?>"/>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Module Key*
                            <br><i class="sm">masukkan module key</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="module_key" id="module_key" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->module_key;?>" />
                        </div>
                    </div>    
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Module Name*
                            <br><i class="sm">masukkan module name</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="module_name" id="module_name" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $data->module_name;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">STATUS
                            <br><i class="sm">pilih status module</i>
                        </label>
                        <div class="col-sm-6 col-lg-2 controls">
                            <div class="make-switch switch-small">                           
                            <input name="aktif" type="checkbox" <?php if($data->aktif == 1) echo "checked";?> />                          
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>  Simpan</button>                           
                            <a href="<?php echo site_url('module/view')?>" class="btn btn-gray">
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