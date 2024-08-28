$("#table-search").treetable({ expandable: true }).treetable('expandAll');
	$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata.').disabled = true;

	$("#table-search .selectdata").click(function () {
		var id = $(this).attr('data-id-inventaris');
		var level = $(this).attr('data-id-level');
		var metafile = $("#table-search").attr('data-metafile')+'pencarian/view-file';
		var metadata = $("#table-search").attr('data-metadata')+'pencarian/view-meta';
		var n = $('#check_'+id+':checked').length;
		
		if(n > 0)
		{	
			$("#kosong").text('Silahkan pilih nama inventaris di samping terlebih dahulu untuk melihat keterangan metadata.').disabled = true;
		  	$("#tampil-meta").html('');

			if ( $(this).attr('data-id-level') == 5){			
				$("#check_"+id).prop('checked', false);
				$(this).removeClass("selected");
				$(".selected").not(this).removeClass("selected");
			} else {
				$("#check_"+id).prop('checked', false);
				$(this).removeClass("selected");
				$(".selected").not(this).removeClass("selected");
			}			
		}	
		else
		{
			if ($(this).attr('data-id-level') == 5){

				$(".selected").not(this).removeClass("selected");
		  		$(this).toggleClass("selected");
		  		$("#check_"+id).prop('checked', true);
		  		$("#table-search").find('input:checkbox').not("#check_"+id).prop('checked', false);
		  		$("#kosong").text('').disabled = false;
		  		metadatafile(id, metafile);
			} else {

				$(".selected").not(this).removeClass("selected");
		  		$(this).toggleClass("selected");
		  		$("#check_"+id).prop('checked', true);
		  		$("#table-search").find('input:checkbox').not("#check_"+id).prop('checked', false);
		  		$("#kosong").text('').disabled = false;
		  		metadatameta(id, metadata);
			}
			
		}
	});

	$("#table-search .pilih").click(function () {
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




