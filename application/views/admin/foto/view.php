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
                <h4 class="panel-title"><b>FOTO</b></h4>
            </div>
            <div class="panel-content">
                <br>
                <div class="btn-toolbar pull-left" style="margin-top:5px;">
                    <div class="btn-group">
                        <a class="btn" title="Tambah Data" href="<?php echo site_url();?>foto/add"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" title="Refresh" href="<?php echo site_url();?>foto/view"><i class="fa fa-repeat"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" title="Refresh" href="<?php echo site_url();?>foto/category">KATEGORI FOTO</a>
                    </div>
                </div>
                <div class="btn-toolbar pull-right clearfix">  
                    <div class="btn-group">  
                        <form method="post" action="<?php echo site_url();?>foto/filter">
                            <label class="btn-group">                       
                                <select class="form-control" name="kategori" required>
                                <?php
                                echo "<option value=''>Pilih Kategori..</option>"; 
                                foreach ($kategori_cb as $row_combo){      
                                    echo "<option value='".$row_combo->id."'>".$row_combo->nama."</option>"; 
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
                        <form method="post" action="<?php echo site_url();?>foto/tanggal">
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
                        <form method="post" action="<?php echo site_url();?>foto/search">
                            <label class="btn-group">                       
                                <div class="input-group">
                                    <input class="form-control"  size="16" type="text" name="cari" id="cari" placeholder="cari.." required>
                                </div>                        
                            </label>
                             <label class="btn-group">
                                <button style="height:34px;" class="btn btn-gray" title="Search"  type="submit" ><i class="fa fa-search"></i></button>
                            </label>
                        </form>  
                    </div>                     
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <form id="proses" name="proses" method="post" action="<?php echo site_url()?>foto/action"> 
                    <table class="table table-bordered" id="table1">
                        <thead>
                        <tr>
                        <th class="text-center" width="3%;"><input class="form-control" name="ck_del_all" type="checkbox" id="ck_del_all" onClick="clickAll('foto','ck_del_all',7)" value=""> </th>
                        <th class="text-center">WAKTU</th>
                        <th class="text-center" width="40%;">JUDUL FOTO</th>
                        <th class="text-center">FOTO</th>
                        <th class="text-center">KATEGORI</th>
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
                            <td align="center"><?php echo $row->tanggal; ?></td>                            
                            <td align="left"><a href="<?php echo site_url()?>foto/edit/<?php echo $row->id;?>"><i class="fa fa-edit"></i> <?php echo substr($row->judul,0,60); ?>..</a></td>
                            <td align="center">
                                <div class="foto">
                                <a href="<?php echo site_url().$row->foto; ?>" target="_blank"><img src="<?php echo $this->master->getDataThumb($row->tabel,$row->id_konten); ?>"></a></img>
                                </div>
                            </td>
                            <td align="center"><?php echo $this->master->getData('nama','tb_katfoto','id',$row->id_kat); ?></td>
                            <td align="center">
                                <?php if ($row->aktif == 1){?>
                                <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                <?php } else { ?>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                <?php }?>
                            </td>
                            <td align="center"><?php echo $row->hit; ?></td>
                            <td align="center"><?php echo $row->entri; ?></td>
                            <td align="center"><?php echo $row->edit; ?></td>
                            </tr> 
                            <?php endforeach; ?>   

                        <?php if (!$data){ ?>
                        <tr><td colspan="9" class="text-center"> <?php echo $null;?> </td></tr>                        
                        <?php }?> 

                        <tr>
                        <td></td>
                        <td colspan="8">
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