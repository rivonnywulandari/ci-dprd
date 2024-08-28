

<div id="get_edit">
    <input type="hidden" name="parent_id" value="<?php echo $data->parent_id;?>">
	<div class="form-group">
		<label class="col-sm-3 control-label" style="text-align:left;">Title Menu*</label>
		<div class="col-xs-12 col-sm-6">
			<input type="text" name="title" id="title" class="form-control" placeholder="Enter aplikasi name" value="<?php echo $data->title;?>" data-validation="required" data-validation-error-msg="Nama aplikasi harus diisi!">
		</div>											
	</div>

	<div class="form-group">
	    <label class="col-sm-3 control-label" for="link" style="text-align:left;">Link</label>  
	   	<div class="col-xs-12 col-sm-6">
	    <input type="text" id="link" name="link" placeholder="Enter link" class="form-control input-md" value="<?php echo $data->link;?>" >
	    </div>
	 </div>	
     <div class="form-group">
        <label class="col-sm-3 control-label" style="text-align:left;">Module</label>  
        <div class="col-xs-12 col-sm-6 controls">
            <select style="display: none;" name="id_module" data-placeholder="Pilih Module" class="form-control chosen" id="selS0V">
            <?php  
            echo "<option value='".$id_module."'>".$module_name."</option>";                            
            foreach ($module_cb as $row_combo){      
                echo "<option value='".$row_combo->id_module."'>".$row_combo->module_name."</option>"; 
            } 
            ?> 
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-3 control-label" style="text-align:left;">Target Window</label>  
       	<div class="col-xs-12 col-sm-6">
        <select class="form-control" name="id_target" id="id_target" data-rule-required="true">
        <?php  
        echo "<option value='".$id_target."'>".$nama_target."</option>";                           
        foreach ($target_cb as $row_combo){      
            echo "<option value='".$row_combo->id_target."'>".$row_combo->nama_target."</option>"; 
        } 
        ?> 
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" style="text-align:left;">Order No</label>  
       	<div class="col-xs-12 col-sm-2">
        <input type="text" id="order_no" name="order_no" placeholder="" class="form-control input-md" value="<?php echo $data->order_no;?>" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" style="text-align:left;">Icon</label>  
       	<div class="col-xs-12 col-sm-4">
        <input type="text" id="icon" name="icon" placeholder="" class="form-control input-md" value="<?php echo $data->icon;?>" >
        <span class="help-inline">ex: fa fa-user</span>
        </div>
    </div>
	<!-- checkbox-->
	<div class="form-group">
	<label class="col-sm-3 control-label" style="text-align:left;" >Status</label>  
	<div class="col-xs-12 col-sm-4" class="checkbox">
	<label>
        <?php 
        if($data->aktif == '1')
            $check = "checked";
        else 
            $check = "";
        ?>
	  <input type="checkbox" id="aktif" name="aktif" class="square-green" <?php echo $check; ?> >
	  <span style="padding-left:2px;">Check for active</span>
	</label>
	</div>
</div>

<script src="<?php echo base_url();?>assets/flat/js/flaty.js"></script>
