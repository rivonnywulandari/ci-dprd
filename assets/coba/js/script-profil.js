$("#table-profil").treetable({ expandable: true }).treetable('expandAll');
$("#kosong").text('Silahkan pilih nama penyimpanan di samping terlebih dahulu untuk melihat data file.').disabled = true;

	$("#table-profil .selectdata").click(function () {
		var id = $(this).attr('data-id-profil');
		var level = $(this).attr('data-id-level');
		var metafile = $("#table-profil").attr('data-arsip')+'ruangan/view-arsip';
		var n = $('#check_'+id+':checked').length;
		
		if(n > 0)
		{	$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata.').disabled = true;
		  	$("#tampil-meta").html('');
		  	
			$("#check_"+id).prop('checked', false);
			$(this).removeClass("selected");
			$(".selected").not(this).removeClass("selected");
			document.getElementById("new-profil").disabled = true;
			document.getElementById("edit-profil").disabled = true;
	  		document.getElementById("delete-profil").disabled = true;
	  		$("#tampil").html('');
		}	
		else
		{
			$(".selected").not(this).removeClass("selected");
	  		$(this).toggleClass("selected");
	  		$("#check_"+id).prop('checked', true);
	  		$("#table-profil").find('input:checkbox').not("#check_"+id).prop('checked', false);
	  		document.getElementById("new-profil").disabled = false;
	  		document.getElementById("edit-profil").disabled = false;
	  		document.getElementById("delete-profil").disabled = false;
	  		document.getElementById("delete-profil").disabled = false;
	  		$("#kosong").text('').disabled = false;
		  	metadataarsip(id, metafile);
		}
	});

	function metadataarsip(id_profil, metafile)
	{
		var data_profil = {
			id_inventaris: id_inventaris
		}; 

		$.ajax({
			type: 'POST',
            url: metafile,
            dataType: 'html',
            data: data_profil,
            cache: false,
            success: function(res){
             	$("#tampil-data").html(res);
            }
		});
	}

	$("#table-profil .pilih").click(function () {
		$(".selected").not(this).removeClass("selected");
  		$(this).toggleClass("selected");

  		var url = $(this).attr('data-url');
  		var akses = $(this).attr('data-akses');

  		if(akses == 'user')
 			document.cookie = 'menu_akses=user; expires=86500;';
 		else if(akses == 'useradmin')
 			document.cookie = 'menu_akses=useradmin; expires=86500;';
  		
  		window.location.assign(url);
	});

	//------------------------------------- modal profil ------------------------------------//	
  	$("#new-profil").click(function (e) {
	    e.preventDefault();
	    var g = $("#table-profil").attr('data-ig');
	    var n = $("#table-profil").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id = $("#table-profil .selected").attr('data-id-profil');
	    	var level = $("#table-profil .selected").attr('data-id-level');
	    	var nama = $("#table-profil .selected").attr('data-name');
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
	    		var id = $("#table-profil .selectdata").attr('data-id-profil');
	    		var level = $("#table-profil .selectdata").attr('data-id-level');
	    		var nama = $("#table-profil .selectdata").attr('data-name');
	    	}
	    }

	   	$("#label-profil").text(nama);
	   	$("#subjudul").text(nama);
	    document.getElementById("parent_id").value = id;
	    document.getElementById("id_level_parent").value = level;
	    $("#modal-profil-new").modal();
	});

	$("#edit-profil").click(function (e) {
	    e.preventDefault();
	    var n = $("#table-profil").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id = $("#table-profil .selected").attr('data-id-profil');
	    	var nama = $("#table-profil .selected").attr('data-name');
	    	var level = $("#table-profil .selected").attr('data-id-level');

	    	$("#label-profil-ubah").text(nama);
		   	$("#judul-ubah").text(nama);
		    document.getElementById("id_profil_ubah").value = id;
		    document.getElementById("id_level_ubah").value = level;
		    $("#modal-profil-edit").modal();
	    }
	});

	$("#delete-profil").click(function (e) {
	    e.preventDefault();
	    var n = $("#table-profil").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id = $("#table-profil .selected").attr('data-id-profil');
	    	var nama = $("#table-profil .selected").attr('data-name');
	    	var level = $("#table-profil .selected").attr('data-id-level');

	    	$("#label-profil-hapus").text(nama);
		   	$("#judul-hapus").text(nama);
		    document.getElementById("id_profil_hapus").value = id;
		    document.getElementById("id_level_hapus").value = level
		    $("#modal-profil-delete").modal();
	    }
	});


	

	//------------------------------------- modal profil ------------------------------------//



