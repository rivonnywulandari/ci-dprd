jQuery(function($) 
{	
	$(".select-data").select2({
		minimumResultsForSearch: Infinity,
		allowClear: false
	});

	$(".select-all").select2({
		allowClear: false
	});

	$("#instansi_child").select2({
		allowClear: false
	});

	$("#klasifikasi_child").select2({
		allowClear: false
	});

	$("#golongan").select2({
		allowClear: false
	});

	$('.chosen-select').chosen({allow_single_deselect:true}); 
	//---------------------------- Basic Validation ----------------------------//
	$.validate({
	    modules : 'security,date,file,location',
	    errorMessagePosition : 'left',
	    onModulesLoaded : function() {  
	        /*var optionalConfig = {
	        fontSize: '12pt',
	        padding: '4px',
	        bad : 'Buruk',
	        weak : 'Lemah',
	        good : 'Baik',
	        strong : 'Kuat'
	      };
	        $('input[name="password"]').displayPasswordStrength(optionalConfig);  */
	          //$('#password').displayPasswordStrength();
	    },
	    /*onError : function() {
	                  if( !$.formUtils.haltValidation ) {         
	            bootbox.alert("terjadi kesalahan input data");
	                  }
	              },*/
	    onSuccess : function() {               
	      return true;               
	    }
	}); 

	//-------------------------- form wizard ---------------------------------//

	//save
	var $validation = false;
	$('#fuelux-wizard-container')
		.ace_wizard({
			//step: 2 //optional argument. wizard will jump to step "2" at first
			//buttons: '.wizard-actions:eq(0)'
	})
	.on('actionclicked.fu.wizard' , function(e, info){
		if(info.step == 1 && $validation) {
			if(!$('#new-user').valid()) e.preventDefault();
		}
	})
	.on('finished.fu.wizard', function(e) {
	   	var form = $('#new-user');
		bootbox.dialog({
		  	title:"Konfirmasi",
		  	message: "Benar ingin menyimpan data ini?",
			buttons: {
			    "cancel" : {
			      	"label" : "<i class='ace-icon fa fa-times'></i> Tidak",
			      	"className" : "btn-sm btn-danger"
			    },
			    "main" : {
			      	"label" : "<i class='ace-icon fa fa-check'></i> Ya, Simpan",
			      	"className" : "btn-sm btn-primary",
			      	callback:function(){
			        	form.submit();
			    	}
			    }
			}
		});
	}).on('stepclick.fu.wizard', function(e){
		//e.preventDefault();//this will prevent clicking and selecting steps
	});			

	//edit
	var $validation = false;
	$('#fuelux-wizard-container-edit')
		.ace_wizard({
			//step: 2 //optional argument. wizard will jump to step "2" at first
			//buttons: '.wizard-actions:eq(0)'
	})
	.on('actionclicked.fu.wizard' , function(e, info){
		if(info.step == 1 && $validation) {
			if(!$('#update-user').valid()) e.preventDefault();
		}
	})
	.on('finished.fu.wizard', function(e) {
	   	var form = $('#update-user');
		bootbox.dialog({
		  	title:"Konfirmasi",
		  	message: "Benar ingin menyimpan data ini?",
			buttons: {
			    "cancel" : {
			      	"label" : "<i class='ace-icon fa fa-times'></i> Tidak",
			      	"className" : "btn-sm btn-danger"
			    },
			    "main" : {
			      	"label" : "<i class='ace-icon fa fa-check'></i> Ya, Simpan",
			      	"className" : "btn-sm btn-primary",
			      	callback:function(){
			        	form.submit();
			    	}
			    }
			}
		});
	}).on('stepclick.fu.wizard', function(e){
		//e.preventDefault();//this will prevent clicking and selecting steps
	});

	//----------------------- bootbox dialog --------------------------------//

	$('.confirm-save').submit(function(e) {
	    var currentForm = this;
	    e.preventDefault();
	    bootbox.confirm("Apakah kamu yakin ingin menyimpan data ini ?", function(result) {
			if (result) {
				currentForm.submit();
			}
	    });
	}); 

	$('.confirm-edit').on('click', function (e) { 
	    var href = this.href;
	    if (!$(this).data('response')) 
	    {           
	       e.preventDefault();
	    }
	    bootbox.dialog({
		  	title:"Konfirmasi",
		  	message: "Benar ingin merubah data ini?",
			buttons: {
			    "cancel" : {
			      	"label" : "<i class='ace-icon fa fa-times'></i> Tidak",
			      	"className" : "btn-sm btn-danger"
			    },
			    "main" : {
			      	"label" : "<i class='ace-icon fa fa-check'></i> Ya, Lanjutkan",
			      	"className" : "btn-sm btn-primary",
			      	callback:function(response){
			        	if (response) {
							window.location = href;
						}
			    	}
			    }
			}
		});       
	});

	$('.confirm-delete').on('click', function (e) { 
	    var href = this.href;
	    if (!$(this).data('response')) 
	    {           
	       e.preventDefault();
	    }
	    bootbox.dialog({
		  	title:"Konfirmasi",
		  	message: "Benar ingin menghapus data ini?",
			buttons: {
			    "cancel" : {
			      	"label" : "<i class='ace-icon fa fa-times'></i> Tidak",
			      	"className" : "btn-sm btn-danger"
			    },
			    "main" : {
			      	"label" : "<i class='ace-icon fa fa-check'></i> Ya, Hapus",
			      	"className" : "btn-sm btn-primary",
			      	callback:function(response){
			        	if (response) {
							window.location = href;
						}
			    	}
			    }
			}
		});       
	});

	$('#confirm-delete').submit(function(e) {
	    var currentForm = this;
	    e.preventDefault();
	    bootbox.dialog({
		  	title:"Konfirmasi",
		  	message: "Benar ingin menghapus data ini?",
			buttons: {
			    "cancel" : {
			      	"label" : "<i class='ace-icon fa fa-times'></i> Tidak",
			      	"className" : "btn-sm btn-danger"
			    },
			    "main" : {
			      	"label" : "<i class='ace-icon fa fa-check'></i> Ya, Hapus",
			      	"className" : "btn-sm btn-primary",
			      	callback:function(result){
			        	if (result) {
							currentForm.submit();
						}
			    	}
			    }
			}
		});
	}); 

	//------------------------------------- datetime -----------------------------------//

	$('#jam_masuk').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true
	}).on('focus', function() {
		$('#jam_masuk').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	$('#file_lampiran33').ace_file_input({
		no_file:'Tidak ada file ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:false //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		//blacklist:'exe|php'
		//onchange:''
		//
	});

	$('#file_lampiran_ubah33').ace_file_input({
		no_file:'Tidak ada file ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:false //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		//blacklist:'exe|php'
		//onchange:''
		//
	});

	// ------------------------------ Drop Box Upload FIle ------------------------- //

	$('#file_lampiran').ace_file_input({
			style: 'well',
			btn_choose: 'Drop files here or click to choose',
			btn_change: null,
			no_icon: 'ace-icon fa fa-cloud-upload',
			droppable: true,
			thumbnail: 'small'//large | fit
			//,icon_remove:null//set null, to hide remove/reset button
			/**,before_change:function(files, dropped) {
				//Check an example below
				//or examples/file-upload.html
				return true;
			}*/
			/**,before_remove : function() {
				return true;
			}*/
			,
			preview_error : function(filename, error_code) {
				//name of the file that failed
				//error_code values
				//1 = 'FILE_LOAD_FAILED',
				//2 = 'IMAGE_LOAD_FAILED',
				//3 = 'THUMBNAIL_FAILED'
				//alert(error_code);
			}
	
		}).on('change', function(){
			//console.log($(this).data('ace_input_files'));
			//console.log($(this).data('ace_input_method'));
		});

		$('#file_lampiran_ubah').ace_file_input({
			style: 'well',
			btn_choose: 'Drop files here or click to choose',
			btn_change: null,
			no_icon: 'ace-icon fa fa-cloud-upload',
			droppable: true,
			thumbnail: 'small'//large | fit
			//,icon_remove:null//set null, to hide remove/reset button
			/**,before_change:function(files, dropped) {
				//Check an example below
				//or examples/file-upload.html
				return true;
			}*/
			/**,before_remove : function() {
				return true;
			}*/
			,
			preview_error : function(filename, error_code) {
				//name of the file that failed
				//error_code values
				//1 = 'FILE_LOAD_FAILED',
				//2 = 'IMAGE_LOAD_FAILED',
				//3 = 'THUMBNAIL_FAILED'
				//alert(error_code);
			}
	
		}).on('change', function(){
			//console.log($(this).data('ace_input_files'));
			//console.log($(this).data('ace_input_method'));
		});
		
		
		$('#id-file-format').removeAttr('checked').on('change', function() {
			var whitelist_ext, whitelist_mime;
			var btn_choose
			var no_icon
			if(this.checked) {
				btn_choose = "Drop images here or click to choose";
				no_icon = "ace-icon fa fa-picture-o";
	
				whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp", "pdf"];
				whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp", "image/pdf"];
			}
			else {
				btn_choose = "Drop files here or click to choose";
				no_icon = "ace-icon fa fa-cloud-upload";
				
				whitelist_ext = null;//all extensions are acceptable
				whitelist_mime = null;//all mimes are acceptable
			}
			var file_input = $('#file_lampiran');
			file_input
			.ace_file_input('update_settings',
			{
				'btn_choose': btn_choose,
				'no_icon': no_icon,
				'allowExt': whitelist_ext,
				'allowMime': whitelist_mime
			})
			file_input.ace_file_input('reset_input');
			
			file_input
			.off('file.error.ace')
			.on('file.error.ace', function(e, info) {
				
			});
			var file_input = $('#file_lampiran_ubah');
			file_input
			.ace_file_input('update_settings',
			{
				'btn_choose': btn_choose,
				'no_icon': no_icon,
				'allowExt': whitelist_ext,
				'allowMime': whitelist_mime
			})
			file_input.ace_file_input('reset_input');
			
			file_input
			.off('file.error.ace')
			.on('file.error.ace', function(e, info) {
				
			});
		
		});

	// ----------------------------------------------------------------------------- //




	//------------------------------------- modal ------------------------------------//
	
  	$(document).on('click', '.pilih-module', function (e) {
      document.getElementById("id_module").value = $(this).attr('data-id');  
      document.getElementById("nama_module").value = $(this).attr('data-nm');                
      $('#modal-module').modal('hide');
  	}); 

  	//select/deselect a row when the checkbox is checked/unchecked
	$("#status_identitas").change(function() {
	    if(this.checked) 
	    {
	       	$('#jns_id').removeClass('hidden');
	       	$('#digit_id').removeClass('hidden');
	       	$('#jenis_identitas').attr('data-validation','required');
	       	$('#jenis_identitas').attr('data-validation-error-msg','Jenis nomor identitas harus diisi!');

	       	$('#digit_identitas').attr('data-validation','required number');
	       	$('#digit_identitas').attr('data-validation-allowing','range[1;100]');
	       	$('#digit_identitas').attr('data-validation-error-msg','Jumlah digit nomor identitas harus diisi dengan angka dari 1-100!');
	    }
	    else
	    {
	    	$('#jns_id').addClass('hidden');
	    	$('#digit_id').addClass('hidden');

	    	$('#jns_id div').removeClass('has-error');
	       	$('#digit_id div').removeClass('has-error');

	       	$('#jns_id span').remove();
	       	$('#digit_id span').remove();

	       	$('#jenis_identitas').removeAttr('data-validation');
	       	$('#jenis_identitas').removeAttr('data-validation-error-msg');
	       	$('#jenis_identitas').removeAttr('data-validation-current-error');
	       	$('#jenis_identitas').removeAttr('style');
	       	$('#jenis_identitas').val('');

	       	$('#digit_identitas').removeAttr('data-validation');
	       	$('#digit_identitas').removeAttr('data-validation-allowing');
	       	$('#digit_identitas').removeAttr('data-validation-error-msg');
	       	$('#digit_identitas').removeAttr('data-validation-current-error');
	       	$('#digit_identitas').removeAttr('style');
	       	$('#digit_identitas').val('');
	    }
	});
	
	//----------------------------------------------------------------------------------------------------------------------------------------------//
	$('#spinner_tim').ace_spinner({value:1,min:1,max:100,step:1, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-primary' , btn_down_class:'btn-danger'});
	$('#form-spt .spinbox-down').click(function(){
		$('#tujuan').val('');
		$('#tgl_berangkat').val('');
		$('#tgl_kembali').val('');
		$('#nama_pegawai').val('');
		$('#id_pegawai').val('');
	});
	$('#form-spt .spinbox-up').click(function(){
		$('#tujuan').val('');
		$('#tgl_berangkat').val('');
		$('#tgl_kembali').val('');
		$('#nama_pegawai').val('');
		$('#id_pegawai').val('');
	});
})