

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo site_url();?>assets/khusus/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../../../../maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo site_url();?>assets/khusus/dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

			<link rel="stylesheet" href="<?php echo site_url();?>assets/khusus/dist/css/ace-part2.min.css" class="ace-main-stylesheet" />
		
		  <link rel="stylesheet" href="<?php echo site_url();?>assets/khusus/dist/css/ace-ie.min.css" />

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo site_url();?>assets/khusus/dist/js/ace-extra.min.js"></script>

		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/chosen.min.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/coba/css/bootstrap-datetimepicker.min.css" />

		<!-- Tree Table -->
    	<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/tree-table/css/jquery.treetable.css" />
    	<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/tree-table/css/jquery.treetable.theme.default.css" />
    	<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/select2/css/select2.css" />

    	<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/dashboard.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/colors.css" />
		<link rel="stylesheet" href="<?php echo site_url();?>assets/coba/css/app.css" />

		<script src="<?php echo site_url();?>assets/coba/js/ace-extra.min.js"></script>

		<script src="<?php echo site_url();?>assets/coba/jquery-2.1.4/jquery.min.js"></script>
</head>
<body class="no-skin">

		<div class="main-container" id="main-container">

			<div class="main-content">

						<div class="page-header">
							<h1>
								Transportasi
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Pemerintah Provinsi Sumatera Barat
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="col-sm-6">

							<div id="accordion" class="accordion-style1 panel-group">
							
								<div class="panel panel-default">
								<?php  $no=0; foreach ($this->master->getTransportasi(5) as $row): $no++;
									if ($no==1)
                                              {
                                                $aktif='active';
                                              }
                                              else
                                              {
                                                $aktif='';
                                              }
                                    ?>
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $aktif; ?>">
												<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i><b>
												Rute Awal : <?php echo $row->rute_awal;?> -> Tujuan : <?php echo $row->rute_tujuan;?></b>
											</a>
										</h4>
									</div>

									<div class="panel-collapse collapse in <?php echo $row->id;?>" id="collapseOne<?php echo $row->id;?>">
										<div class="panel-body">
											
												<table id="simple-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Mobil</th>
														<th>Type</th>
														<th>Ongkos</th>
														<th>Lama</th>
													</tr>
												</thead>

												<tbody>
													<tr>
														<td>
															<?php echo $row->merek_mobil;?>
														</td>
														<td>
															<?php echo $row->type;?>
														</td>
														<td>
															<?php echo $row->ongkos;?>
														</td>
														<td>
															<?php echo $row->lama_perjalanan;?>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<?php endforeach;
                                    ?>
								</div>
								
							</div>
						</div><!-- /.col -->
			</div><!-- /.main-content -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

<script src="../../../../../ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo site_url();?>assets/khusus/dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='dist/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo site_url();?>assets/khusus/dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../../../../netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/jquery.dataTables.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/buttons/dataTables.buttons.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/buttons/buttons.flash.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/buttons/buttons.html5.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/buttons/buttons.print.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/buttons/buttons.colVis.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/select/dataTables.select.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo site_url();?>assets/khusus/dist/js/ace-elements.min.js"></script>
		<script src="<?php echo site_url();?>assets/khusus/dist/js/ace.min.js"></script>

	<!--dfadsfsdafsdfasdfsadfsadf-->

	<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/coba/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/coba/jquery.bootstrap-3.3.5/bootstrap.min.js"></script>

		<!-- scripts -->
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/jquery.dataTables.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/extensions/buttons/dataTables.buttons.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/extensions/buttons/buttons.flash.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/extensions/buttons/buttons.html5.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/extensions/buttons/buttons.print.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/extensions/buttons/buttons.colVis.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/dataTables/extensions/select/dataTables.select.min.js"></script>

		<!-- Tree Table -->
		<script src="<?php echo site_url();?>assets/coba/tree-table/jquery.treetable.js"></script>

		<!-- scripts -->
		<script src="<?php echo site_url();?>assets/coba/js/fuelux/fuelux.wizard.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/bootbox.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/chosen.jquery.min.js"></script>
		<!--<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.min.js"></script>-->
		<script src="<?php echo site_url();?>assets/coba/select2/js/select2.full.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/date-time/daterangepicker.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/date-time/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Form Validasi -->
		<script src="<?php echo site_url();?>assets/coba/js/jquery.form-validator.min.js"></script>

		<!-- scripts -->
		<script src="<?php echo site_url();?>assets/coba/js/ace-elements.min.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/ace.min.js"></script>

		<script src="<?php echo site_url();?>assets/coba/js/script-table.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/script-app.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/script-instansi.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/script-inventaris.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/script-profil.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/script-search.js"></script>
		<script src="<?php echo site_url();?>assets/coba/js/script-member.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.swfPath = "<?php echo site_url();?>assets/khusus/dist/js/dataTables/extensions/buttons/swf/flashExport.swf"; //in Ace demo dist will be replaced by correct assets path
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(!this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
			
			})
		</script>


</body>

</html>
