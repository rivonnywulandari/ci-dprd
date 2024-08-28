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
                <form enctype="multipart/form-data" action="<?php echo site_url();?>contact/edit_save" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id" value="<?php echo $data->id;?>"/>      
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Nama*
                            <br><i class="sm">masukkan nama website</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="nama" id="nama" class="form-control"  data-rule-minlength="1" value="<?php echo $data->nama;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Slogan
                            <br><i class="sm">masukkan slogan website</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <input type="text" name="slogan" id="slogan" class="form-control" data-rule-minlength="1" value="<?php echo $data->slogan;?>"/>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat
                            <br><i class="sm">masukkan alamat instansi, atau perusahaan, atau organisasi, atau lainnya</i>
                        </label>
                        <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="alamat" id="alamat" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->alamat;?></textarea>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kota/Kab
                            <br><i class="sm">masukkan nama kota/kab instansi, atau perusahaan, atau organisasi, atau lainnya</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="kota" id="kota" class="form-control" data-rule-minlength="1" value="<?php echo $data->kota;?>"/>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Provinsi
                            <br><i class="sm">masukkan nama provinsi instansi, atau perusahaan, atau organisasi, atau lainnya</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="prov" id="prov" class="form-control" data-rule-minlength="1" value="<?php echo $data->prov;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Kode Pos
                            <br><i class="sm">masukkan kode pos instansi, atau perusahaan, atau organisasi, atau lainnya</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="kodepos" id="kodepos" class="form-control" data-rule-number="true" data-rule-minlength="1" value="<?php echo $data->kodepos;?>"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. Telepon
                            <br><i class="sm">masukkan nomor telepon</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" name="tlp" id="tlp" class="form-control" data-rule-minlength="1" value="<?php echo $data->tlp;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. Fax
                            <br><i class="sm">masukkan nomor fax</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-print"></i></span>
                                <input type="text" name="fax" id="fax" class="form-control" data-rule-minlength="1" value="<?php echo $data->fax;?>"/>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">No. HP
                            <br><i class="sm">masukkan nomor hp</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-mobile fa-lg"></i></span>
                                <input type="text" name="hp" id="hp" class="form-control" data-rule-minlength="1" value="<?php echo $data->hp;?>"/>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Email
                            <br><i class="sm">masukkan alamat email</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" name="email" id="email" class="form-control" data-rule-email="true" data-rule-minlength="1" value="<?php echo $data->email;?>"/>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Web
                            <br><i class="sm">masukkan alamat website (url)</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input type="text" name="web" id="web" class="form-control" data-rule-minlength="1" value="<?php echo $data->web;?>" />
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Deskripsi Web
                            <br><i class="sm">masukkan deskripsi website</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="deskripsi" id="deskripsi" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->deskripsi;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Keyword Web
                            <br><i class="sm">masukkan keyword website</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="keyword" id="keyword" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->keyword;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Keterangan Lain
                            <br><i class="sm">masukkan keterangan lainnya</i>
                        </label>
                         <div class="col-sm-6 col-lg-6 controls">
                            <textarea name="ket" id="ket" class="form-control"  data-rule-minlength="1" rows="5"><?php echo $data->ket;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Facebook
                            <br><i class="sm">masukkan alamat facebook</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                <input type="text" name="facebook" id="facebook" class="form-control" data-rule-minlength="1" value="<?php echo $data->facebook;?>"/>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Twitter
                            <br><i class="sm">masukkan alamat twitter</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                <input type="text" name="twitter" id="twitter" class="form-control" data-rule-minlength="1" value="<?php echo $data->twitter;?>"/>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-3 control-label">Alamat Google Plus
                            <br><i class="sm">masukkan alamat google plus</i>
                        </label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                                <input type="text" name="gplus" id="gplus" class="form-control" data-rule-minlength="1" value="<?php echo $data->gplus;?>"/>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>  Simpan</button>                           
                            <a href="<?php echo site_url('contact/view')?>" class="btn btn-gray">
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

<script type="text/javascript">    
    $(document).ready(function() {
        $('#validation-form').submit(function(e) {
            var currentForm = this;
            e.preventDefault();
            bootbox.confirm("yakin data ini disimpan ?", function(result) {
              if (result) {
                currentForm.submit();
              }
            });
        }); 
    });
</script>  