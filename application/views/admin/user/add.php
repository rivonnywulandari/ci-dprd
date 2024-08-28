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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>user/add_save" class="form-horizontal" id="validation-form" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Nama Lengkap*
                            <br><i class="sm">masukkan nama lengkap pengguna</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="nama" id="nama" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $nama;?>" />
                        </div>
                    </div>       
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Jenis Kelamin
                            <br><i class="sm">pilih jenis kelamin user</i>
                        </label>
                        <div class="col-sm-3 col-lg-3 controls">
                            <select name="id_jekel" class="form-control" >
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat
                            <br><i class="sm">masukkan alamat user</i>
                        </label>
                         <div class="col-sm-9 col-lg-6 controls">
                            <textarea name="alamat" id="alamat" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $alamat;?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. Telepon
                            <br><i class="sm">masukkan nomor telepon user</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="telepon" id="telepon" class="form-control" data-rule-minlength="1" value="<?php echo $telepon;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Username*
                            <br><i class="sm">masukkan usernname</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" name="username" id="username" class="form-control" data-rule-required="true" data-rule-minlength="1" value="<?php echo $username;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Password*
                            <br><i class="sm">masukkan password</i>
                        </label>
                        <div class="col-sm-4 col-lg-2 controls">
                            <input type="password" name="password" id="password" class="form-control" data-rule-required="true" data-rule-minlength="1"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Group*
                            <br><i class="sm">pilih group user</i>
                        </label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <select class="form-control" name="id_group" id="id_group" data-rule-required="true">
                            <?php                            
                            echo "<option value='".$id_group."'>".$group_name."</option>";
                            foreach ($group_cb as $row_combo){      
                                echo "<option value='".$row_combo->id_group."'>".$row_combo->group_name."</option>"; 
                            } 
                            ?> 
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">STATUS
                            <br><i class="sm">pilih status user</i>
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