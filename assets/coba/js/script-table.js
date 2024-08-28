jQuery(function($) 
{	
	$("#table-induk").treetable({ expandable: true });
	
	//initiate dataTables plugin
	$('#dynamic-table').DataTable( {
		bAutoWidth: false,
	});

	$('#table-dd').DataTable( {
		bAutoWidth: false,	
	});

	$('#table-ld').DataTable( {
		bAutoWidth: false,
	});
	//-----------------------------------------------------------//

	//initiate dataTables plugin
	var myTableAdmin = $('#table-admin')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableAdmin.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableAdmin.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_admin").disabled = false;
		}
	} );
	myTableAdmin.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableAdmin.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_admin").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-admin > thead > tr > th input[type=checkbox], #table-admin_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-admin').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableAdmin.row(row).select();
			}
			else  
			{
				myTableAdmin.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-admin').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableAdmin.row(row).deselect();
		else 
			myTableAdmin.row(row).select();

		var n = $('#check_user:checked').length;
		var rowCount = $('#table-admin > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_admin").disabled = false;
		else
			document.getElementById("delete_admin").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

//--------------------------------------------------------------------------------------------------------------------------//

	//initiate dataTables plugin
	var myTablePegawai = $('#table-pegawai')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTablePegawai.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePegawai.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_pegawai").disabled = false;
		}
	} );
	myTablePegawai.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePegawai.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_pegawai").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-pegawai > thead > tr > th input[type=checkbox], #table-pegawai_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-pegawai').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTablePegawai.row(row).select();
			}
			else  
			{
				myTablePegawai.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-pegawai').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTablePegawai.row(row).deselect();
		else 
			myTablePegawai.row(row).select();

		var n = $('#check_pegawai:checked').length;
		var rowCount = $('#table-pegawai > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_pegawai").disabled = false;
		else
			document.getElementById("delete_pegawai").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});
			
//--------------------------------------------------------------------------------------------------------------------------//

	//initiate dataTables plugin
	var myTableNonPegawai = $('#table-non-pegawai')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableNonPegawai.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableNonPegawai.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_pegawai").disabled = false;
		}
	} );
	myTableNonPegawai.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableNonPegawai.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_pegawai").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-non-pegawai > thead > tr > th input[type=checkbox], #table-non-pegawai_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-non-pegawai').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableNonPegawai.row(row).select();
			}
			else  
			{
				myTableNonPegawai.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-non-pegawai').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableNonPegawai.row(row).deselect();
		else 
			myTableNonPegawai.row(row).select();

		var n = $('#check_non_pegawai:checked').length;
		var rowCount = $('#table-non-pegawai > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_pegawai").disabled = false;
		else
			document.getElementById("delete_pegawai").disabled = true;

		if(rowCount == n)
			$('#checked_all').prop('checked', true);
		else
			$('#checked_all').prop('checked', false);

	});


	//------------------------------------------------ Buka Tabel Kategori Arsip ------------------------------------------//

	//initiate dataTables plugin
	var myTableKategoriArsip = $('#table-kategori-arsip')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableKategoriArsip.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableKategoriArsip.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_kategori_arsip").disabled = false;
		}
	} );
	myTableKategoriArsip.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableKategoriArsip.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_kategori_arsip").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-kategori-arsip > thead > tr > th input[type=checkbox], #table-kategori-arsip_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-kategori-arsip').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableKategoriArsip.row(row).select();
			}
			else  
			{
				myTableKategoriArsip.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-kategori-arsip').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableKategoriArsip.row(row).deselect();
		else 
			myTableKategoriArsip.row(row).select();

		var n = $('#check_kategori_arsip:checked').length;
		var rowCount = $('#table-kategori-arsip > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_kategori_arsip").disabled = false;
		else
			document.getElementById("delete_kategori_arsip").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Kategori -----------------------------------------------//




	//------------------------------------------------ Buka Tabel Media Arsip ------------------------------------------//

	//initiate dataTables plugin
	var myTableMediaArsip = $('#table-media-arsip')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableMediaArsip.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableMediaArsip.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_media_arsip").disabled = false;
		}
	} );
	myTableMediaArsip.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableMediaArsip.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_media_arsip").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-media-arsip > thead > tr > th input[type=checkbox], #table-media-arsip_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-media-arsip').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableMediaArsip.row(row).select();
			}
			else  
			{
				myTableMediaArsip.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-media-arsip').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableMediaArsip.row(row).deselect();
		else 
			myTableMediaArsip.row(row).select();

		var n = $('#check_media_arsip:checked').length;
		var rowCount = $('#table-media-arsip > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_media_arsip").disabled = false;
		else
			document.getElementById("delete_media_arsip").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Media -----------------------------------------------//




	//------------------------------------------------ Buka Tabel Satuan Unit ------------------------------------------//

	//initiate dataTables plugin
	var myTableSatuanUnit = $('#table-satuan-unit')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableSatuanUnit.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableSatuanUnit.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_satuan_unit").disabled = false;
		}
	} );
	myTableSatuanUnit.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableSatuanUnit.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_satuan_unit").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-satuan-unit > thead > tr > th input[type=checkbox], #table-satuan-unit_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-satuan-unit').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableSatuanUnit.row(row).select();
			}
			else  
			{
				myTableSatuanUnit.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-satuan-unit').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableSatuanUnit.row(row).deselect();
		else 
			myTableSatuanUnit.row(row).select();

		var n = $('#check_satuan_unit:checked').length;
		var rowCount = $('#table-satuan-unit > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_satuan_unit").disabled = false;
		else
			document.getElementById("delete_satuan_unit").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Satuan Unit -----------------------------------------------//





	//------------------------------------------------ Buka Tabel Sifat Arsip ------------------------------------------//

	//initiate dataTables plugin
	var myTableSifatArsip = $('#table-sifat-arsip')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableSifatArsip.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableSifatArsip.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_sifat_arsip").disabled = false;
		}
	} );
	myTableSifatArsip.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableSifatArsip.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_sifat_arsip").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-sifat-arsip > thead > tr > th input[type=checkbox], #table-sifat-arsip_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-sifat-arsip').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableSifatArsip.row(row).select();
			}
			else  
			{
				myTableSifatArsip.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-sifat-arsip').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableSifatArsip.row(row).deselect();
		else 
			myTableSifatArsip.row(row).select();

		var n = $('#check_sifat_arsip:checked').length;
		var rowCount = $('#table-sifat-arsip > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_sifat_arsip").disabled = false;
		else
			document.getElementById("delete_sifat_arsip").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Sifat Arsip -----------------------------------------------//




	// Yg dipakai


	//------------------------------------------------ Buka Tabel File ------------------------------------------//

	//initiate dataTables plugin
	var myTableFile = $('#table-file')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableFile.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableFile.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_file").disabled = false;
		}
	} );
	myTableFile.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableFile.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_file").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-file > thead > tr > th input[type=checkbox], #table-file_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-file').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableFile.row(row).select();
			}
			else  
			{
				myTableFile.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-file').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableFile.row(row).deselect();
		else 
			myTableFile.row(row).select();

		var n = $('#check_file:checked').length;
		var rowCount = $('#table-file > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_file").disabled = false;
		else
			document.getElementById("delete_file").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel File -----------------------------------------------//



	//------------------------------------------------ Buka Tabel Inventaris ------------------------------------------//

	//initiate dataTables plugin
	var myTableInventaris1 = $('#table-inventaris1')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableInventaris1.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableInventaris1.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_inventaris1").disabled = false;
		}
	} );
	myTableInventaris1.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableInventaris1.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_inventaris1").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-inventaris1 > thead > tr > th input[type=checkbox], #table-inventaris1_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-inventaris1').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableInventaris1.row(row).select();
			}
			else  
			{
				myTableInventaris1.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-inventaris1').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableInventaris1.row(row).deselect();
		else 
			myTableInventaris1.row(row).select();

		var n = $('#check_inventaris1:checked').length;
		var rowCount = $('#table-inventaris1 > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_inventaris1").disabled = false;
		else
			document.getElementById("delete_inventaris1").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Inventaris -----------------------------------------------//


	//------------------------------------------------ Buka Tabel Satuan Penyimpanan ------------------------------------------//

	//initiate dataTables plugin
	var myTableSP = $('#table-sp')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableSP.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableSP.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_sp").disabled = false;
		}
	} );
	myTableSP.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableSP.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_sp").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-sp > thead > tr > th input[type=checkbox], #table-sp_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-sp').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableSP.row(row).select();
			}
			else  
			{
				myTableSP.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-sp').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableSP.row(row).deselect();
		else 
			myTableSP.row(row).select();

		var n = $('#check_sp:checked').length;
		var rowCount = $('#table-sp > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_sp").disabled = false;
		else
			document.getElementById("delete_sp").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Satuan Penyimpanan -----------------------------------------------//


	//------------------------------------------------ Buka Tabel kategori ------------------------------------------//

	//initiate dataTables plugin
	var myTableKategori = $('#table-kategori')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableKategori.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableKategori.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_kategori").disabled = false;
		}
	} );
	myTableKategori.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableKategori.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_kategori").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-kategori > thead > tr > th input[type=checkbox], #table-kategori_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-kategori').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableKategori.row(row).select();
			}
			else  
			{
				myTableKategori.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-kategori').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableKategori.row(row).deselect();
		else 
			myTableKategori.row(row).select();

		var n = $('#check_kategori:checked').length;
		var rowCount = $('#table-kategori > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_kategori").disabled = false;
		else
			document.getElementById("delete_kategori").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel kategori -----------------------------------------------//



	//------------------------------------------------ Buka Tabel Media ------------------------------------------//

	//initiate dataTables plugin
	var myTableMedia = $('#table-media')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTableMedia.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableMedia.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_media").disabled = false;
		}
	} );
	myTableMedia.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTableMedia.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_media").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-media > thead > tr > th input[type=checkbox], #table-media_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-media').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTableMedia.row(row).select();
			}
			else  
			{
				myTableMedia.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-media').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTableMedia.row(row).deselect();
		else 
			myTableMedia.row(row).select();

		var n = $('#check_media:checked').length;
		var rowCount = $('#table-media > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_media").disabled = false;
		else
			document.getElementById("delete_media").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Media -----------------------------------------------//



	//------------------------------------------------ Buka Tabel Profil ------------------------------------------//

	//initiate dataTables plugin
	var myTablePro = $('#table-pro')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null,
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTablePro.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePro.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_pro").disabled = false;
		}
	} );
	myTablePro.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePro.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_pro").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-pro > thead > tr > th input[type=checkbox], #table-pro_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-pro').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTablePro.row(row).select();
			}
			else  
			{
				myTablePro.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-pro').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTablePro.row(row).deselect();
		else 
			myTablePro.row(row).select();

		var n = $('#check_pro:checked').length;
		var rowCount = $('#table-pro > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_pro").disabled = false;
		else
			document.getElementById("delete_pro").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel Profil -----------------------------------------------//



	//------------------------------------------------ Buka Tabel penempatan ------------------------------------------//

	//initiate dataTables plugin
	var myTablePenempatan = $('#table-penempatan')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, null, null, null, 
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTablePenempatan.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePenempatan.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_penempatan").disabled = false;
		}
	} );
	myTablePenempatan.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePenempatan.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_penempatan").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-penempatan > thead > tr > th input[type=checkbox], #table-penempatan_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-penempatan').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTablePenempatan.row(row).select();
			}
			else  
			{
				myTablePenempatan.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-penempatan').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTablePenempatan.row(row).deselect();
		else 
			myTablePenempatan.row(row).select();

		var n = $('#check_penempatan:checked').length;
		var rowCount = $('#table-penempatan > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_penempatan").disabled = false;
		else
			document.getElementById("delete_penempatan").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel penempatan -----------------------------------------------//



	//------------------------------------------------ Buka Tabel peminjaman1 ------------------------------------------//

	//initiate dataTables plugin
	var myTablePeminjaman1 = $('#table-peminjaman1')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, 
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTablePeminjaman1.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePeminjaman1.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_peminjaman1").disabled = false;
		}
	} );
	myTablePeminjaman1.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePeminjaman1.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_peminjaman1").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-peminjaman1 > thead > tr > th input[type=checkbox], #table-peminjaman1_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-peminjaman1').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTablePeminjaman1.row(row).select();
			}
			else  
			{
				myTablePeminjaman1.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-peminjaman1').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTablePeminjaman1.row(row).deselect();
		else 
			myTablePeminjaman1.row(row).select();

		var n = $('#check_peminjaman1:checked').length;
		var rowCount = $('#table-peminjaman1 > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_peminjaman1").disabled = false;
		else
			document.getElementById("delete_peminjaman1").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel peminjaman1 -----------------------------------------------//



	//------------------------------------------------ Buka Tabel peminjaman2 ------------------------------------------//

	//initiate dataTables plugin
	var myTablePeminjaman2 = $('#table-peminjaman2')
	.DataTable( {
		bAutoWidth: false,
		"aoColumns": [
		  { "bSortable": false },
		  null, null, null, 
		  { "bSortable": false },
		],
		"aaSorting": [],
		select: {
			style: 'multi'
		}
	} );

	myTablePeminjaman2.on( 'select', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePeminjaman2.row( index ).node() ).find('input:checkbox').prop('checked', true);
			document.getElementById("delete_peminjaman2").disabled = false;
		}
	} );
	myTablePeminjaman2.on( 'deselect', function ( e, dt, type, index ) {
		if ( type === 'row' ) {
			$( myTablePeminjaman2.row( index ).node() ).find('input:checkbox').prop('checked', false);
			document.getElementById("delete_peminjaman2").disabled = true;
		}
	} );

	//select/deselect all rows according to table header checkbox
	$('#table-peminjaman2 > thead > tr > th input[type=checkbox], #table-peminjaman2_wrapper input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
		
		$('#table-peminjaman2').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) 
			{
				myTablePeminjaman2.row(row).select();
			}
			else  
			{
				myTablePeminjaman2.row(row).deselect();
			}
		});
	});

	//select/deselect a row when the checkbox is checked/unchecked
	$('#table-peminjaman2').on('click', 'td input[type=checkbox]' , function(){
		var row = $(this).closest('tr').get(0);
		if(!this.checked) 
			myTablePeminjaman2.row(row).deselect();
		else 
			myTablePeminjaman2.row(row).select();

		var n = $('#check_peminjaman2:checked').length;
		var rowCount = $('#table-peminjaman2 > tbody > tr').length;
		
		if(n > 0)
			document.getElementById("delete_peminjaman2").disabled = false;
		else
			document.getElementById("delete_peminjaman2").disabled = true;

		if(rowCount == n)
			$('#check_all').prop('checked', true);
		else
			$('#check_all').prop('checked', false);

	});

	//------------------------------------------------ Akhir Tabel peminjaman2 -----------------------------------------------//




})