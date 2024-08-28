$("#table-inventaris").treetable({ expandable: true }).treetable('expandAll');
	$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata.').disabled = true;

	$("#table-inventaris .selectdata").click(function () {
		var id = $(this).attr('data-id-inventaris');
		var level = $(this).attr('data-id-level');
		var metafile = $("#table-inventaris").attr('data-metafile')+'pengolahan/view-meta-file';
		var metadata = $("#table-inventaris").attr('data-metadata')+'pengolahan/view-meta';
		var n = $('#check_'+id+':checked').length;
		
		if(n > 0)
		{	
			$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata.').disabled = true;
		  	$("#tampil-meta").html('');

			if ( $(this).attr('data-id-level') == 5){			
				$("#check_"+id).prop('checked', false);
				$(this).removeClass("selected");
				$(".selected").not(this).removeClass("selected");
				document.getElementById("new-inventaris").disabled = true;
				document.getElementById("edit-inventaris").disabled = true;
		  		document.getElementById("delete-inventaris").disabled = true;
			} else {
				$("#check_"+id).prop('checked', false);
				$(this).removeClass("selected");
				$(".selected").not(this).removeClass("selected");
				document.getElementById("new-inventaris").disabled = true;
				document.getElementById("edit-inventaris").disabled = true;
		  		document.getElementById("delete-inventaris").disabled = true;
			}			
		}	
		else
		{
			if ($(this).attr('data-id-level') == 5){

				$(".selected").not(this).removeClass("selected");
		  		$(this).toggleClass("selected");
		  		$("#check_"+id).prop('checked', true);
		  		$("#table-inventaris").find('input:checkbox').not("#check_"+id).prop('checked', false);
		  		document.getElementById("new-inventaris").disabled = false;
		  		document.getElementById("edit-inventaris").disabled = false;
		  		document.getElementById("delete-inventaris").disabled = false;
		  		$("#kosong").text('').disabled = false;
		  		metadatafile(id, metafile);
			} else {

				$(".selected").not(this).removeClass("selected");
		  		$(this).toggleClass("selected");
		  		$("#check_"+id).prop('checked', true);
		  		$("#table-inventaris").find('input:checkbox').not("#check_"+id).prop('checked', false);
		  		document.getElementById("new-inventaris").disabled = false;
		  		document.getElementById("edit-inventaris").disabled = false;
		  		document.getElementById("delete-inventaris").disabled = false;
		  		$("#kosong").text('').disabled = false;
		  		metadatameta(id, metadata);
			}
			
		}
	});

	$("#table-inventaris .pilih").click(function () {
		$(".selected").not(this).removeClass("selected");
  		$(this).toggleClass("selected");

  		var metafile = $(this).attr('data-metafile');
  		var metadata = $(this).attr('data-metadata');
  		var akses = $(this).attr('data-akses');

  		if(akses == 'user')
 			document.cookie = 'menu_akses=user; expires=86500;';
 		else if(akses == 'useradmin')
 			document.cookie = 'menu_akses=useradmin; expires=86500;';
  		
  		window.location.assign(url);
	});

	function metadatameta(id_inventaris, metadata)
	{
		var data_inventaris = {
			id_inventaris: id_inventaris
		}; 

		$.ajax({
			type: 'POST',
            url: metadata,
            dataType: 'html',
            data: data_inventaris,
            cache: false,
            success: function(res){
             	$("#tampil-meta").html(res);
            }
		});
	}

	function metadatafile(id_inventaris, metafile)
	{
		var data_inventaris = {
			id_inventaris: id_inventaris
		}; 

		$.ajax({
			type: 'POST',
            url: metafile,
            dataType: 'html',
            data: data_inventaris,
            cache: false,
            success: function(res){
             	$("#tampil-meta").html(res);
            }
		});
	}

	//------------------------------------- modal inventaris ------------------------------------//	
  	$("#new-inventaris").click(function (e) {
	    e.preventDefault();
	    var g = $("#table-inventaris").attr('data-ig');
	    var n = $("#table-inventaris").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id = $("#table-inventaris .selected").attr('data-id-inventaris');
	    	var level = $("#table-inventaris .selected").attr('data-id-level');
	    	var nama = $("#table-inventaris .selected").attr('data-name');
	    	var nama_lvl_parent = $("#table-inventaris .selected").attr('data-nm-level');
	    }
	    else
	    {
	    	if(g == 1)
	    	{
	    		var id = 0;
	    		var nama = "Induk";
	    	}
	    	else
	    	{
	    		var id = $("#table-inventaris .selectdata").attr('data-id-inventaris');
	    		var level = $("#table-inventaris .selectdata").attr('data-id-level');
	    		var nama = $("#table-inventaris .selectdata").attr('data-name');
	    	}
	    }

	   	$("#label-inventaris").text(nama);
	   	$("#label-lvl-parent").text(nama_lvl_parent);
	   	$("#subjudul").text(nama);
	    document.getElementById("parent_id").value = id;
	    document.getElementById("id_level_parent").value = level;
	    $("#modal-inventaris-new").modal();
	});

	$("#edit-inventaris").click(function (e) {
	    e.preventDefault();
	    var n = $("#table-inventaris").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id = $("#table-inventaris .selected").attr('data-id-inventaris');
	    	var nama = $("#table-inventaris .selected").attr('data-name');
	    	var level = $("#table-inventaris .selected").attr('data-id-level');
	    	var upline = $("#table-inventaris .selected").attr('data-id-upline');
	    	var nama_lvl_parent = $("#table-inventaris .selected").attr('data-nm-level');

	    	$("#label-inventaris-ubah").text(nama);
	    	$("#label-lvl-parent-ubah").text(nama_lvl_parent);
		   	$("#judul-ubah").text(nama);
		    document.getElementById("id_inventaris_ubah").value = id;
		    document.getElementById("judul_inventaris_ubah").value = nama;
		    document.getElementById("id_level_ubah").value = level;
		    document.getElementById("id_upline").value = upline;
		    $("#modal-inventaris-edit").modal();
	    }
	});

	$("#delete-inventaris").click(function (e) {
	    e.preventDefault();
	    var n = $("#table-inventaris").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id = $("#table-inventaris .selected").attr('data-id-inventaris');
	    	var nama = $("#table-inventaris .selected").attr('data-name');
	    	var level = $("#table-inventaris .selected").attr('data-id-level');

	    	$("#label-inventaris-hapus").text(nama);
		   	$("#judul-hapus").text(nama);
		    document.getElementById("id_inventaris_hapus").value = id;
		    document.getElementById("id_level_hapus").value = level
		    $("#modal-inventaris-delete").modal();
	    }
	});

	//------------------------------------- modal inventaris ------------------------------------//

	//------------------------------------- modal metadata ------------------------------------//

		$(document).on('click', '#new-meta', function (e) {

	      var nama = $("#table-inventaris .selected").attr('data-name');

	      $("#label-meta-new").text(nama);
		  $("#judul-meta-new").text(nama);
	      document.getElementById("id_inventaris_child").value = $(this).attr('data-id-inventaris');
	      document.getElementById("id_level_parent").value = $(this).attr('data-level');

	      $("#modal-meta-new").modal();
	    });  

	    $(document).on('click', '.button-meta', function (e) {

	      var nama = $("#table-inventaris .selected").attr('data-name');

		  $("#label-meta-ubah").text(nama);
	      $("#judul-meta-ubah").text(nama);
	      document.getElementById("id_meta").value = $(this).attr('data-ij');

	      $("#modal-meta-ubah").modal();
	    });  

	    $(document).on('click', '.hapus-meta', function (e) {
	      $("#judul-meta-hapus").text($(this).attr('data-nj'));
	      $("#label-inventaris-hapus").text($(this).attr('data-name'));

	      var nama = $("#table-inventaris .selected").attr('data-name');

		  $("#label-meta-hapus").text(nama);
	      $("#judul-meta-hapus").text(nama);
	      document.getElementById("id_meta_hapus").value = $(this).attr('data-ij');

	      $("#modal-meta-hapus").modal();
	    });

	    //------------------------------------- modal metadata ------------------------------------//

	    //------------------------------------- aksi simpan javascript modal metadata ------------------------------------//

			var frm = $('#save-meta');
			frm.submit(function (ev) {

				var id_inventaris = $('#id_inventaris').val();
				var judul_inventaris = $("#judul-meta-new").text();

				$.ajax({
					type: frm.attr('method'),
					url: frm.attr('action'),
					data: frm.serialize(),
					dataType: "html",
					success: function(data)
					{
						//if success close modal and reload ajax table
						$('#modal-meta-new').modal('hide');
						$('#alert-msg').html(data); 
						meta(id_inventaris, judul_inventaris);
						$('#nama_meta').val("");
					}
				});

				ev.preventDefault();
			});

			var frmUbah = $('#ubah-meta');
			frmUbah.submit(function (ev) {

				var id_inventaris = $('#id_inventaris_ubah').val();
				var judul_inventaris = $("#label-inventaris-ubah").text();

				$.ajax({
					type: frmUbah.attr('method'),
					url: frmUbah.attr('action'),
					data: frmUbah.serialize(),
					dataType: "html",
					success: function(data)
					{
						//if success close modal and reload ajax table
						$('#modal-meta-ubah').modal('hide');
						$('#alert-msg').html(data); 
						meta(id_inventaris, judul_inventaris);
						$('#nama_meta_ubah').val("");
					}
				});

				ev.preventDefault();
			});

			var frmHapus = $('#hapus-meta');
			frmHapus.submit(function (ev) {

				var id_inventaris = $('#id_inventaris_hapus').val();
				var judul_inventaris = $("#label-inventaris-hapus").text();

				$.ajax({
					type: frmHapus.attr('method'),
					url: frmHapus.attr('action'),
					data: frmHapus.serialize(),
					dataType: "html",
					success: function(data)
					{
						//if success close modal and reload ajax table
						$('#modal-meta-hapus').modal('hide');
						$('#alert-msg').html(data); 
						meta(id_inventaris, judul_inventaris);
					}
				});

				ev.preventDefault();
			});

			

			$(document).on('click', '#close-modal-hapus', function (){
				$('#modal-meta-hapus').modal('hide');
				modalEmptyMetaHapus();
			});


	        function modalEmptyMetaHapus()
	        {
	          $('#status_hapus').removeAttr('checked');
	          $('#delete-meta').attr('disabled', "");
	        }


	        //------------------------------------- aksi simpan javascript modal metadata ------------------------------------//	

	        


	        //------------------------------------- modal filedata ------------------------------------//

			$(document).on('click', '#new-file', function (e) {

		      var nama = $("#table-inventaris .selected").attr('data-name');

		      $("#label-file-new").text(nama);
			  $("#judul-file-new").text(nama);
		      document.getElementById("id_inventaris_anak").value = $(this).attr('data-id-inventaris');
		      document.getElementById("id_level_parent").value = $(this).attr('data-level');

		      $("#modal-file-new").modal();
		    });  

		    $(document).on('click', '.button-file', function (e) {

		      var nama = $("#table-inventaris .selected").attr('data-name');

			  $("#label-file-ubah").text(nama);
		      $("#judul-file-ubah").text(nama);
		      document.getElementById("id_file").value = $(this).attr('data-ij');

		      $("#modal-file-ubah").modal();
		    });  

		    $(document).on('click', '.hapus-file', function (e) {
		      $("#judul-file-hapus").text($(this).attr('data-nj'));
		      $("#label-inventaris-hapus").text($(this).attr('data-name'));

		      var nama = $("#table-inventaris .selected").attr('data-name');

			  $("#label-file-hapus").text(nama);
		      $("#judul-file-hapus").text(nama);
		      document.getElementById("id_file_hapus").value = $(this).attr('data-ij');
		      document.getElementById("id_hapus").value = $(this).attr('data-id-inventaris');
		      

		      $("#modal-file-hapus").modal();
		    });

		    //------------------------------------- modal filedata ------------------------------------//

		    //------------------------------------- aksi simpan javascript modal filedata ------------------------------------//

				var frm = $('#save-file');
				frm.submit(function (ev) {

					var id_inventaris = $('#id_inventaris').val();
					var judul_inventaris = $("#judul-file-new").text();

					$.ajax({
						type: frm.attr('method'),
						url: frm.attr('action'),
						data: frm.serialize(),
						dataType: "html",
						success: function(data)
						{
							//if success close modal and reload ajax table
							$('#modal-file-new').modal('hide');
							$('#alert-msg').html(data); 
							file(id_inventaris, judul_inventaris);
							$('#nama_file').val("");
						}
					});

					ev.preventDefault();
				});

				var frmUbah = $('#ubah-file');
				frmUbah.submit(function (ev) {

					var id_inventaris = $('#id_inventaris_ubah').val();
					var judul_inventaris = $("#label-inventaris-ubah").text();

					$.ajax({
						type: frmUbah.attr('method'),
						url: frmUbah.attr('action'),
						data: frmUbah.serialize(),
						dataType: "html",
						success: function(data)
						{
							//if success close modal and reload ajax table
							$('#modal-file-ubah').modal('hide');
							$('#alert-msg').html(data); 
							file(id_inventaris, judul_inventaris);
							$('#nama_file_ubah').val("");
						}
					});

					ev.preventDefault();
				});

				var frmHapus = $('#hapus-file');
				frmHapus.submit(function (ev) {

					var id_inventaris = $('#id_inventaris_hapus').val();
					var judul_inventaris = $("#label-inventaris-hapus").text();

					$.ajax({
						type: frmHapus.attr('method'),
						url: frmHapus.attr('action'),
						data: frmHapus.serialize(),
						dataType: "html",
						success: function(data)
						{
							//if success close modal and reload ajax table
							$('#modal-file-hapus').modal('hide');
							$('#alert-msg').html(data); 
							file(id_inventaris, judul_inventaris);
						}
					});

					ev.preventDefault();
				});

				$(document).on('click', '#close-modal-file', function (){
					$('#modal-file-new').modal('hide');
					modalEmptyfileNew();
				});

				$(document).on('click', '#close-modal-file-ubah', function (){
					$('#modal-file-ubah').modal('hide');
					modalEmptyfileUbah();
				});

				$(document).on('click', '#close-modal-file-hapus', function (){
					$('#modal-file-hapus').modal('hide');
					modalEmptyfileHapus();
				});

				function modalEmptyfileNew()
		        {
		          $('#tahun_pembuatan_file').val('');
		          $('#jumlah_fisik_file').val('');
		          $('#keterangan_file').val('');
		          $('#file_lampiran').val('');
		          $('#data-validation-error-msg').val('');
		          $('#status_save_file').removeAttr('checked');

		          $('#save-file').attr('disabled', "");
		        }

		        function modalEmptyfileUbah()
		        {
		          $('#tahun_pembuatan_ubah').val('');
		          $('#jumlah_fisik_ubah').val('');
		          $('#keterangan_ubah').val('');
		          $('#file_lampiran').val('');
		          $('#data-validation-error-msg').val('');
		          $('#status_ubah_file').removeAttr('checked');

		          $('#update-file').attr('disabled', "");
		        }

		        function modalEmptyfileHapus()
		        {
		          $('#status_hapus_file').removeAttr('checked');
		          $('#delete-file').attr('disabled', "");
		        }


	        //------------------------------------- aksi simpan javascript modal filedata ------------------------------------//	



