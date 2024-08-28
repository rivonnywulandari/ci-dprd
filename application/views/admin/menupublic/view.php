<!-- BEGIN Page Title -->
<div class="page-title"><div></div></div>
<!-- END Page Title -->

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <i class="fa fa-home" style="padding-right:5px;"></i>
      <li><?php echo $this->breadcrumb->output(); ?></li>
  </ul>
</div>
<!-- END Breadcrumb -->

<?php echo $this->session->flashdata('view'); ?>

<!-- BEGIN Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><b>MENU PUBLIC</b></h4>
            </div>
            <div class="panel-content">
                <br>
                <div class="btn-toolbar pull-left" style="margin-top:5px;">
                    <div class="btn-group">
                        <a class="btn" title="Tambah Data" href="#menu-baru" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn" title="Refresh" href="<?php echo site_url();?>menupublic/view"><i class="fa fa-repeat"></i></a>
                    </div>
                </div>
                <br/><br/>
                <div class="clearfix"></div>
                <div class="table-responsive" style="border:0">
                    <?php echo $list_menu; ?>
                </div>
            </div>
	    </div>
	          
	</div>
</div>      

<!-- BEGIN MODALS -->
<div id="menu-baru" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" role="form" action="<?php echo site_url('menupublic/add_save'); ?>" method="post">
                <div class="modal-body">
                	<div class="tabbable">
						<div class="tab-content">
		                	<h5 class="smaller lighter blue" id="subjudul-parent"></h5>
		                	<div class="form-group">
								<label class="col-sm-3 control-label" style="text-align:left;"> Title Menu* </label>
								<div class="col-xs-12 col-sm-8">
									<input type="hidden" id="parent_id" name="parent_id" value="0">
									<input type="text" name="title" id="title" class="form-control" placeholder="" data-validation="required" data-validation-error-msg="Nama aplikasi harus diisi!">
								</div>
							</div>
							<div class="form-group">
				                <label class="col-sm-3 control-label" style="text-align:left;">Link</label>  
				               	<div class="col-xs-12 col-sm-8">
				                <input type="text" id="link" name="link" placeholder="" class="form-control input-md" value="" >
				                </div>
				            </div>

				            <div class="form-group">
				                <label class="col-sm-3 control-label" style="text-align:left;">Menu Item Type</label>  
				               	<div class="col-xs-12 col-sm-8">
				                <select class="form-control" name="id_type" id="id_type" data-rule-required="true">
		                        <?php                            
		                        foreach ($type_menu_cb as $row_combo){      
		                            echo "<option value='".$row_combo->id_type."'>".$row_combo->nama_type."</option>"; 
		                        } 
		                        ?> 
		                        </select>
				                </div>
				            </div>
				            <div class="form-group">
				                <label class="col-sm-3 control-label" style="text-align:left;">Target Window</label>  
				               	<div class="col-xs-12 col-sm-8">
				                <select class="form-control" name="id_target" id="id_target" data-rule-required="true">
		                        <?php                            
		                        foreach ($target_cb as $row_combo){      
		                            echo "<option value='".$row_combo->id_target."'>".$row_combo->nama_target."</option>"; 
		                        } 
		                        ?> 
		                        </select>
				                </div>
				            </div>
				            <div class="form-group">
				                <label class="col-sm-3 control-label" style="text-align:left;">Icon</label>  
				               	<div class="col-xs-12 col-sm-4">
				                <input type="text" id="icon" name="icon" placeholder="" class="form-control input-md" value="" >
				                <span class="help-inline">ex: fa fa-user</span>
				                </div>
				            </div>
			              	<div class="form-group">
				                <label class="col-md-3 control-label" style="text-align:left;">Status</label>  
				                <div class="col-xs-12 col-sm-8">
				                <div class="checkbox">
				                  <label>
				                    <input type="checkbox" id="aktif" name="aktif" class="square-green" checked>
				                    <span style="padding-left:2px;">Check for active</span>
				                  </label>
				                </div>
				                </div>
			              	</div>
			            </div>
			        </div>
                </div>

                <div class="modal-footer">
                	<button class="btn btn-sm btn-danger" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Batal
					</button>
					<button class="btn btn-sm btn-info" type="submit" name="submit">
						<i class="ace-icon fa fa-check"></i>
						Ya, Simpan
					</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- BEGIN MODALS -->
<div id="menu-child" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
   				<div class="tabbable">
   					
					<ul class="nav nav-tabs" id="myTab">
						<li class="active">
							<a data-toggle="tab" href="#tambah">Tambah Menu</a>
						</li>
						<li>
							<a data-toggle="tab" href="#ubah">Ubah Menu</a>
						</li>
						<li>
							<a data-toggle="tab" href="#hapus">Hapus Menu</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="tambah" class="tab-pane fade in active">
							<form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo site_url('menupublic/add_save'); ?>" method="post">
	                        	<h5 class="smaller lighter blue">Buat submenu baru di bawah menu <b id="judul-child-new"></b></h5>	                        	
	                        	<div class="form-group">
									<label class="col-sm-3 control-label" style="text-align:left;"> Title Menu* </label>
									<div class="col-xs-12 col-sm-8">
										<input type="hidden" id="parent_id_new" name="parent_id">
										<input type="text" name="title" id="title" class="form-control" placeholder="" data-validation="required" data-validation-error-msg="Nama aplikasi harus diisi!">
									</div>
								</div>
								<div class="form-group">
					                <label class="col-sm-3 control-label" style="text-align:left;">Link</label>  
					               	<div class="col-xs-12 col-sm-8">
					                <input type="text" id="link" name="link" placeholder="" class="form-control input-md" value="" >
					                </div>
					            </div>
					            <div class="form-group">
					                <label class="col-sm-3 control-label" style="text-align:left;">Menu Item Type</label>  
					               	<div class="col-xs-12 col-sm-8">
					                <select class="form-control" name="id_type" id="id_type" data-rule-required="true">
			                        <?php                            
			                        foreach ($type_menu_cb as $row_combo){      
			                            echo "<option value='".$row_combo->id_type."'>".$row_combo->nama_type."</option>"; 
			                        } 
			                        ?> 
			                        </select>
					                </div>
					            </div>
					            <div class="form-group">
					                <label class="col-sm-3 control-label" style="text-align:left;">Target Window</label>  
					               	<div class="col-xs-12 col-sm-8">
					                <select class="form-control" name="id_target" id="id_target" data-rule-required="true">
			                        <?php                            
			                        foreach ($target_cb as $row_combo){      
			                            echo "<option value='".$row_combo->id_target."'>".$row_combo->nama_target."</option>"; 
			                        } 
			                        ?> 
			                        </select>
					                </div>
					            </div>
				              	<div class="form-group">
					                <label class="col-md-3 control-label" style="text-align:left;">Status</label>  
					                <div class="col-xs-12 col-sm-8">
						                <div class="checkbox">
						                  <label>
						                    <input type="checkbox" id="aktif" name="aktif" class="square-green" checked>
						                    <span style="padding-left:2px;">Check for active</span>
						                  </label>
						                </div>
					                </div>
				              	</div>

								<br class="clearfix" />
                     		
	                     		<div class="modal-footer">
		                        	<button class="btn btn-sm btn-danger" data-dismiss="modal">
										<i class="ace-icon fa fa-times"></i>
										Batal
									</button>
									<button class="btn btn-sm btn-info" type="submit" name="submit">
										<i class="ace-icon fa fa-check"></i>
										Ya, Simpan
									</button>
		                        </div>
	                        </form>
						</div>

						<div id="ubah" class="tab-pane fade">
							<form class="form-horizontal" role="form" action="<?php echo site_url('menupublic/edit_save'); ?>" method="post">
	                        	<h5 class="smaller lighter blue">Ubah data menu <b id="judul-child-ubah"></b> menjadi</h5>
	                        	<input type="hidden" id="id_menu_ubah" name="id_menu">    
								<div id="get_edit"></div>
								<br class="clearfix" />
                     		
	                     		<div class="modal-footer">
		                        	<button class="btn btn-sm btn-danger" data-dismiss="modal">
										<i class="ace-icon fa fa-times"></i>
										Batal
									</button>
									<button class="btn btn-sm btn-info" type="submit" name="update">
										<i class="ace-icon fa fa-check"></i>
										Ya, Ubah
									</button>
		                        </div>
	                        </form>
						</div>

						<div id="hapus" class="tab-pane fade">
							<form class="form-horizontal" role="form" action="<?php echo site_url('menupublic/delete'); ?>" method="post">
	                        	<h5 class="smaller lighter blue">Benar ingin menghapus menu <b id="judul-child-hapus"></b> ?</h5>			                     
								<input type="hidden" id="id_menu_hapus" name="id_menu_hapus">
								<input type="hidden" id="id_gov" name="id_gov" value="<?php //echo $id_gov;?>">
								<br/>
	                     		<div class="modal-footer">
		                        	<button class="btn btn-sm btn-danger" data-dismiss="modal">
										<i class="ace-icon fa fa-times"></i>
										Batal
									</button>
									<button class="btn btn-sm btn-info" type="submit" name="delete">
										<i class="ace-icon fa fa-check"></i>
										Ya, Hapus
									</button>
		                        </div>
	                        </form>
						</div>
					</div>
				</div>
   			</div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('.selectdata').click(function (e) {
		$("#label-menu-child").text($(this).attr('data-name'));
		$("#judul-child-new").text($(this).attr('data-name'));
		$("#judul-child-ubah").text($(this).attr('data-name'));
		$("#judul-child-hapus").text($(this).attr('data-name'));

		document.getElementById("parent_id_new").value = $(this).attr('data-id');
		document.getElementById("id_menu_ubah").value = $(this).attr('data-id');
		document.getElementById("id_menu_hapus").value = $(this).attr('data-id');             
	}); 
    $(".selectdata").click(function(){
        var id_menu = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url : "<?php echo base_url('menupublic/edit'); ?>",
            data: "id_menu="+id_menu,
            cache:false,
            success: function(data){
                $('#get_edit').html(data);
            }
        });
    });  
</script>

