jQuery(function($) 
{	
	$("#table-instansi").treetable({ expandable: true });

	//------------------------------------- modal ------------------------------------//
  	$("#new-instansi").click(function (e) {
	    e.preventDefault();
	    $("#label-instansi-parent").text("Instansi Baru");
	    $("#subjudul-parent").text("Buat instansi baru sebagai instansi induk.");
	    document.getElementById("parent_id").value = "0";
	    $("#modal-instansi-parent").modal();
	});

	$('.selectdata').click(function (e){
		e.preventDefault();
		$("#label-instansi-child").text($(this).attr('data-name'));
		$("#judul-child-new").text($(this).attr('data-name'));
		$("#judul-child-ubah").text($(this).attr('data-name'));
		$("#judul-child-hapus").text($(this).attr('data-name'));

		document.getElementById("parent_id_new").value = $(this).attr('data-id');
		document.getElementById("id_instansi_ubah").value = $(this).attr('data-id');
		document.getElementById("id_instansi_hapus").value = $(this).attr('data-id');

		$("#modal-instansi-child").modal();
    });
})