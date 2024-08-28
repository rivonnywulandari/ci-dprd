jQuery(function($) 
{	
	$("#table-aplikasi").treetable({ expandable: true });

	//------------------------------------- modal ------------------------------------//
  	$("#new-aplikasi").click(function (e) {
	    e.preventDefault();
	    $("#label-aplikasi-parent").text("Aplikasi Baru");
	    $("#subjudul-parent").text("Buat aplikasi baru sebagai aplikasi induk.");
	    document.getElementById("parent_id").value = "0";
	    $("#modal-aplikasi-parent").modal();
	});

	$('.selectdata').click(function (e){
		e.preventDefault();
		$("#label-aplikasi-child").text($(this).attr('data-name'));
		$("#judul-child-new").text($(this).attr('data-name'));
		$("#judul-child-ubah").text($(this).attr('data-name'));
		$("#judul-child-hapus").text($(this).attr('data-name'));

		document.getElementById("parent_id_new").value = $(this).attr('data-id');
		document.getElementById("id_aplikasi_ubah").value = $(this).attr('data-id');
		document.getElementById("id_aplikasi_hapus").value = $(this).attr('data-id');

		$("#menu-child").modal();
    });
})