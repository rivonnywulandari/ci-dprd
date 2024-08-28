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
                <h4 class="panel-title"><b>CONTACT</b></h4>
            </div>
            <div class="panel-content">
                <br>
                <div class="btn-toolbar pull-left" style="margin-top:5px;">
                    <div class="btn-group">
                        <a class="btn" title="Refresh" href="<?php echo site_url();?>contact/view"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <form id="proses" name="proses" method="post" action="<?php echo site_url()?>contact/action"> 
                    <table class="table table-bordered" id="table1">
                        <thead>
                        <tr>
                        <th class="text-left">WAKTU</th>
                        <th class="text-left" width="40%;">NAMA</th>
                        <th class="text-left">WEB</th>
                        <th class="text-center">ENTRI</th>
                        <th class="text-center">EDIT</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=0;
                            ?>
                            <?php foreach ($data as $row): $no++;?>
                            <?php if($no%2==0) { echo "<tr bgcolor='#FFFFFF'>"; } else { echo "<tr bgcolor='#f5f5f5'>"; } ?>
                            <td align="left"><?php echo $row->tanggal; ?></td> 
                            <td align="left"><a href="<?php echo site_url()?>contact/edit/<?php echo $row->id;?>"><b><i class="fa fa-edit"></i> <?php echo $row->nama; ?></b></a></td>
                            <td align="left"><a href="<?php echo $row->web; ?>" target="_blank"><?php echo $row->web; ?></a></td>
                            <td align="center"><?php echo $row->entri; ?></td>
                            <td align="center"><?php echo $row->edit; ?></td>
                            </tr> 
                            <?php endforeach; ?>   

                        <?php if (!$data){ ?>
                        <tr><td colspan="10" class="text-center"> <?php echo $null;?> </td></tr>                        
                        <?php }?> 
                        </tbody>
                    </table>
                    </form>
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