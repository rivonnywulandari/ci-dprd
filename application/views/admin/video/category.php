<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <i class="fa fa-home" style="padding-right:5px;"></i>
      <li><?php echo $this->breadcrumb->output(); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->

<?php echo $this->session->flashdata('category');?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-title">
                <h4 class="panel-title"><b><?php echo $title;?> KATEGORI VIDEO</b></h4>
            </div>
            <div class="box-content">
                <br>
                <form action="<?php echo site_url();?>video/category_action" class="form-horizontal" id="validation-form" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="action" value="<?php echo $action;?>">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-4 control-label" for="nama">Nama Kategori <br><i class="sm">isi nama kategori video</i></label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <input type="text" name="nama" class="form-control" data-rule-required="true" data-rule-minlength="2" value="<?php echo $nama;?>"/>
                        </div>
                    </div>                
                    <div class="form-group">
                        <label for="id_jabatan" class="col-sm-3 col-lg-4 control-label">Kategori Induk</label>
                        <div class="col-sm-6 col-lg-4 controls">
                            <select class="form-control" name="induk" id="induk" data-rule-required="true">
                            <?php
                            echo "<option value='$id_induk'>".$nama_induk."</option>"; 
                            foreach ($category_cb as $row_combo){      
                                echo "<option value='".$row_combo->id."'>".$row_combo->nama."</option>"; 
                            } 
                            ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4 col-lg-8 col-lg-offset-4">  
                            <a href="<?php echo site_url();?>video" class="btn btn-gray btn-sm" type="button" ><i class="fa fa-arrow-circle-left"></i> Kembali</a>                          
                            <a href="<?php echo site_url();?>video/category" class="btn btn-gray btn-sm" type="button"><i class="fa fa-undo"></i> Reset</a>                          
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-save"></i> <?php echo $button;?></button>                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-content">
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <table class="table table-bordered" id="table1">
                        <thead>
                        <tr>
                        <th class="text-center" width="3%;">NO</th>
                        <th class="text-center" width="50%;">NAMA</th>
                        <th class="text-center">KATEGORI INDUK</th>
                        <th class="text-center">JUMLAH ISI</th>
                        <th class="text-center">ATUR</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=$offset;
                            ?>
                            <?php foreach ($data as $row): $no++;?>
                            <?php if($no%2==0) { echo "<tr bgcolor='#FFFFFF'>"; } else { echo "<tr bgcolor='#f5f5f5'>"; } ?>
                            <td align="center"><?php echo $no; ?></td>                          
                            <td align="left"><a href="<?php echo site_url();?>video/category/<?php echo $row->id;?>"><i class="fa fa-edit"></i> <?php echo $row->nama; ?></a></td>
                            <td align="left"><?php echo $this->master->category('nama','tb_katvideo',$row->induk) ?></td>
                            <td align="left"><?php echo $this->master->categoryCount('tb_video',$row->id) ?></td>
                            <td align="center" width="60px" style="min-width:60px">
                                <div class="action">
                                    <form class="confirm_delete" action="<?php echo site_url();?>video/category_action" class="form-horizontal" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row->id;?>">
                                        <input type="hidden" name="induk" value="<?php echo $row->induk;?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button class="btn btn-warning btn-xs" type="submit"><i class="fa fa-trash-o"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                            </tr> 
                        <?php endforeach; ?>                      

                        </tbody>
                    </table>
                    <div class="text-center">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->