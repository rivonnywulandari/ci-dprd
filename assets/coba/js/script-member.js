$("#member-search").treetable({ expandable: true }).treetable('');
	$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata dan meminjam arsip.').disabled = true;

	$("#member-search .selectdata").click(function () {
		var id = $(this).attr('data-id-inventaris');
		var id_parent = $(this).attr('data-tt-parent-id');
		var level = $(this).attr('data-id-level');
		var metafile = $("#member-search").attr('data-metafile')+'member/lihat-file';
		var metadata = $("#member-search").attr('data-metadata')+'member/lihat-meta';
		var n = $('#check_'+id+':checked').length;
		
		if(n > 0)
		{	
			$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata dan meminjam arsip.').disabled = true;
		  	$("#tampil-meta").html('');

			if ( $(this).attr('data-id-level') == 5){			
				$("#check_"+id).prop('checked', false);
				$(this).removeClass("selected");
				$(".selected").not(this).removeClass("selected");
				document.getElementById("new-pinjam").disabled = true;

			} else {
				$("#check_"+id).prop('checked', false);
				$(this).removeClass("selected");
				$(".selected").not(this).removeClass("selected");
				document.getElementById("new-pinjam").disabled = true;
			}			
		}	
		else
		{
			if ($(this).attr('data-id-level') == 5){

				$(".selected").not(this).removeClass("selected");
		  		$(this).toggleClass("selected");
		  		$("#check_"+id).prop('checked', true);
		  		$("#member-search").find('input:checkbox').not("#check_"+id).prop('checked', false);
		  		$("#kosong").text('').disabled = false;
		  		document.getElementById("new-pinjam").disabled = false;

		  		metadatafile(id, metafile);
			} else {

				$(".selected").not(this).removeClass("selected");
		  		$(this).toggleClass("selected");
		  		$("#check_"+id).prop('checked', true);
		  		$("#member-search").find('input:checkbox').not("#check_"+id).prop('checked', false);
		  		$("#kosong").text('').disabled = false;
		  		document.getElementById("new-pinjam").disabled = false;

		  		metadatameta(id, metadata);
			}
			
		}
	});

	$("#member-search .pilih").click(function () {
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
  	$("#new-pinjam").click(function (e) {
	    e.preventDefault();
	    var g = $("#member-search").attr('data-ig');
	    var n = $("#member-search").find('input:checkbox:checked').length;

	    if(n > 0)
	    {
	    	var id_parent = $("#member-search .selected").attr('data-id-inventaris');
	    	var level = $("#member-search .selected").attr('data-id-level');
	    	var id_inventaris_induk = $("#member-search .selected").attr('data-parent-id');
	    	var nama = $("#member-search .selected").attr('data-name');
	    	var nama_lvl_parent = $("#member-search .selected").attr('data-nm-level');
	    }
	    else
	    {
	    	if(g == 1)
	    	{
	    		var id_parent = 0;
	    		var nama = "Induk";
	    	}
	    	else
	    	{
	    		var id_parent = $("#member-search .selectdata").attr('data-id-inventaris');
	    		var level = $("#member-search .selectdata").attr('data-id-level');
	    		var id_inventaris_induk = $("#member-search .selectdata").attr('data-parent-id');
	    		var nama = $("#member-search .selectdata").attr('data-name');
	    	}
	    }

	   	$("#label-inventaris").text(nama);
	   	$("#label-lvl-parent").text(nama_lvl_parent);
	   	$("#subjudul").text(nama);
	    document.getElementById("parent_id").value = id_parent;
	    document.getElementById("id_inventaris_induk").value = id_inventaris_induk;
	    document.getElementById("id_level_parent").value = level;
	    $("#modal-pinjam-new").modal();
	});


