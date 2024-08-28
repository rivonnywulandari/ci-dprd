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
                <h4 class="panel-title"><b>GROUP</b></h4>
            </div>
            <div class="panel-content">
                <br>
                <div class="btn-toolbar pull-left" style="margin-top:5px;">
                    <div class="btn-group">
                        <a class="btn" title="Tambah Data" href="<?php echo site_url();?>group/add"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" title="Refresh" href="<?php echo site_url();?>group/view"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <div class="btn-toolbar pull-right" style="margin-top:5px;">  
                    <div class="btn-group">  
                        <form method="post" action="<?php echo site_url();?>group/search">
                            <label class="btn-group">                       
                                <div class="input-group">
                                    <input class="form-control"  size="16" type="text" name="cari" id="cari" placeholder="cari.." required>
                                </div>                        
                            </label>
                             <label class="btn-group">
                                <button style="height:34px;" class="btn btn-gray" title="Refresh"  type="submit" ><i class="fa fa-search"></i></button>
                            </label>
                        </form>  
                    </div>                                 
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <form id="proses" name="proses" method="post" action="<?php echo site_url()?>group/action"> 
                    <table class="table table-bordered" id="table1">
                        <thead>
                        <tr>
                        <th class="text-center" width="3%;"><input class="form-control" name="ck_del_all" type="checkbox" id="ck_del_all" onClick="clickAll('group','ck_del_all',7)" value=""> </th>
                        <th class="text-center" width="30%;" style="min-width:150px;">NAMA GROUP</th>
                        <th class="text-center" width="30%;" style="min-width:150px;">HAK AKSES</th>
                        <th class="text-center" width="10%;">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=$offset;
                            ?>
                            <?php foreach ($data as $row): $no++;?>
                            <?php if($no%2==0) { echo "<tr bgcolor='#FFFFFF'>"; } else { echo "<tr bgcolor='#f5f5f5'>"; } ?>
                            <td align="center"><input name="checkbox[]" type="checkbox" value="<?php echo $row->id_group; ?>"></td>                         
                            <td align="left"><a href="<?php echo site_url()?>group/edit/<?php echo $row->id_group;?>"><i class="fa fa-edit"></i> <?php echo $row->group_name; ?></a></td>
                            <td align="left">
                                <?php foreach ($this->model_group->getModule($row->id_group) as $module): ?>
                                <label class="btn btn-xs" style="margin-top:2px; margin-bottom:2px;"><?php echo $module->module_name;?></label>
                                <?php endforeach; ?>
                            </td>
                            <td align="center">
                                <?php if ($row->aktif == 1){?>
                                <button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                <?php } else { ?>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                <?php }?>
                            </td>
                            </tr> 
                            <?php endforeach; ?>   

                        <?php if (!$data){ ?>
                        <tr><td colspan="9" class="text-center"> <?php echo $null;?> </td></tr>                        
                        <?php }?> 

                        <tr>
                        <td></td>
                        <td colspan="8">
                            <?php if (!$data) $disabled='disabled'; else $disabled='';?>
                            <button type="submit" name="publish" value="publish" <?php echo $disabled;?>><i class="fa fa-check"></i> Aktif</button> &nbsp; 
                            <button type="submit" name="unpublish" value="unpublish" <?php echo $disabled;?>>Tidak Aktif</button> &nbsp; 
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