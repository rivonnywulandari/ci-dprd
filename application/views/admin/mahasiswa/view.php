
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <i class="fa fa-home" style="padding-right:5px;"></i>
      <li><?php echo $this->breadcrumb->output(); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->
<?php echo $this->session->flashdata('view');?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><b>MAHASISWA</b></h4>
            </div>
            <div class="panel-content">
                <br>
                <div class="btn-toolbar pull-left" style="margin-top:5px;">
                    <div class="btn-group">
                        <a class="btn" title="Tambah Data" href="<?php echo site_url();?>mahasiswa/add"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" title="Refresh" href="<?php echo site_url();?>mahasiswa/view"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <div class="btn-toolbar pull-right clearfix" style="margin-top:5px;">
                    <div class="btn-group">  
                        <form method="post" action="<?php echo site_url();?>mahasiswa/filter">
                            <label class="btn-group">                       
                                <select class="form-control" name="studi" required>
                                <?php
                                echo "<option value=''>Pilih Program Studi..</option>"; 
                                foreach ($studi_cb as $row_combo){      
                                    echo "<option value='".$row_combo->id."'>".$row_combo->judul."</option>"; 
                                } 
                                ?> 
                                </select>                       
                            </label>
                            <label class="btn-group">
                                <button style="height:34px;" class="btn btn-gray" title="Filter"  type="submit" >Filter</button>
                            </label>
                        </form>   
                    </div>                   
                    <div class="btn-group">  
                        <form method="post" action="<?php echo site_url();?>mahasiswa/tanggal">
                            <label class="btn-group">                       
                                <div class="input-group date date-picker" data-date="<?php echo date('Y-m-d'); ?>" data-date-format="<?php echo date('Y-m-d'); ?>" data-date-viewmode="years">
                                    <input class="form-control date-picker"  size="16" type="text" name="tanggal" id="tanggal" value="" placeholder="tanggal dibuat.." required>
                                </div>                        
                            </label>
                             <label class="btn-group">
                                <button style="height:34px;" class="btn btn-gray" title="Tampilkan"  type="submit" >Tampilkan</button>
                            </label>
                        </form>  
                    </div>
                    <div class="btn-group">  
                        <form method="post" action="<?php echo site_url();?>mahasiswa/search">
                            <label class="btn-group">                       
                                <div class="input-group">
                                    <input class="form-control"  size="16" type="text" name="cari" id="cari" placeholder="cari.." required>
                                </div>                        
                            </label>
                             <label class="btn-group">
                                <button style="height:34px;" class="btn btn-gray" title="Cari"  type="submit" ><i class="fa fa-search"></i></button>
                            </label>
                        </form>  
                     </div>                  
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <form id="proses" name="proses" method="post" action="<?php echo site_url()?>mahasiswa/action"> 
                    <table class="table table-bordered" id="table1">
                        <thead>
                        <tr>
                        <th class="text-center" width="3%;"><input class="form-control" name="ck_del_all" type="checkbox" id="ck_del_all" onClick="clickAll('mahasiswa','ck_del_all',7)" value=""> </th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center" width="30%;">NIM</th>                        
                        <th class="text-center">PROGRAM STUDI</th>
                        <th class="text-center">JK</th>
                        <th class="text-center">FOTO</th>
                        <th class="text-center">ACC</th>
                        <th class="text-center">HIT</th>
                        <th class="text-center">ENTRI</th>
                        <th class="text-center">EDIT</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=$offset;
                            ?>
                            <?php foreach ($data as $row): $no++;?>
                            <?php if($no%2==0) { echo "<tr bgcolor='#FFFFFF'>"; } else { echo "<tr bgcolor='#f5f5f5'>"; } ?>
                            <td align="center"><input name="checkbox[]" type="checkbox" value="<?php echo $row->id; ?>"></td>                            
                            <td align="left"><a href="<?php echo site_url()?>mahasiswa/edit/<?php echo $row->id;?>"><i class="fa fa-edit"></i> <?php echo $row->nama; ?></a></td>
                            <td align="left"><?php echo $row->nim; ?></td>
                            <td align="left"><?php echo $this->master->getData('judul','tb_studi','id',$row->id_prodi); ?></td>
                            <td align="center"><?php echo $row->jekel; ?></td>
                            <td align="center"><?php echo $this->master->countDataFoto('tb_mahasiswa',$row->id); ?></td>
                            <td align="center">
                                <?php if ($row->aktif == 1){?>
                                <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                <?php } else if ($row->aktif == 0){ ?>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                <?php } else { ?>
                                <button class="btn btn-info btn-xs"><i class="fa fa-repeat"></i></button>
                                <?php }?>
                            </td>
                            <td align="center"><?php echo $row->hit; ?></td>
                            <td align="center"><?php echo $row->entri; ?></td>
                            <td align="center"><?php echo $row->edit; ?></td>
                            </tr> 
                            <?php endforeach; ?>   

                        <?php if (!$data){ ?>
                        <tr><td colspan="10" class="text-center"> <?php echo $null;?> </td></tr>                        
                        <?php }?> 

                        <tr>
                        <td></td>
                        <td colspan="9">
                            <?php if (!$data) $disabled='disabled'; else $disabled='';?>
                            <button type="submit" name="publish" value="publish" <?php echo $disabled;?>><i class="fa fa-check"></i> Tampil</button> &nbsp; 
                            <button type="submit" name="unpublish" value="unpublish" <?php echo $disabled;?>>Tidak Tampil</button> &nbsp; 
                            <button type="submit" name="delete" value="delete" style="float:right;" <?php echo $disabled;?>><i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
                        <tr/>
                        </tbody>
                    </table>
                    </form>

                    <div class="text-center">
                        <?php echo $pagination; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->

<script type="text/javascript">    
  $(document).ready(function() {
    $('.confirm_delete').submit(function(e) {
        var currentForm = this;
        e.preventDefault();
        bootbox.confirm("yakin data ini dihapus ?", function(result) {
          if (result) {
            currentForm.submit();
          }
        });
    }); 
  });
</script>  