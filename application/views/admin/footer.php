
		<footer>
			<p><a href="#">Copyright © <?php echo date('Y'); ?></a> | <a href="#" target="_blank"> Team IT</a></p>
		</footer>

		<a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
	</div>
	<!-- END Content -->
</div>
<!-- END Container -->


<!--basic scripts-->
<script>window.jQuery || document.write('<script src="<?php echo base_url();?>assets/flat/assets/jquery/jquery-2.1.1.min.js"><\/script>')</script>
<script src="<?php echo base_url();?>assets/flat/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/jquery-cookie/jquery.cookie.js"></script>

<!--page specific plugin scripts-->
<script src="<?php echo base_url();?>assets/flat/assets/flot/jquery.flot.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/flot/jquery.flot.crosshair.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>assets/flat/assets/chosen-bootstrap/chosen.jquery.min.js"></script>

<!--flaty scripts-->
<script src="<?php echo base_url();?>assets/flat/js/flaty.js"></script>
<script src="<?php echo base_url();?>assets/flat/js/flaty-demo-codes.js"></script>

<!--form wizard-->
<script src="<?php echo base_url();?>assets/flat/assets/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/flat/assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/flat/assets/jquery-validation/dist/additional-methods.min.js"></script>

<!--inpus mask-->
<script type="text/javascript" src="<?php echo base_url();?>assets/flat/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>

<!--date-->
<script type="text/javascript" src="<?php echo base_url();?>assets/flat/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!--switch-->
<script type="text/javascript" src="<?php echo base_url();?>assets/flat/assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>

<!--script custom-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script-custom.js"></script>

<!--loading-->
<script src="<?php echo base_url()?>assets/js/progress-bar/jquery.form.js"></script>
<script src="<?php echo base_url()?>assets/js/progress-bar/progress.bar.js"></script>

<!--treegrid-->
<script src="<?php echo base_url(); ?>assets/treegrid/js/jquery.treegrid.min.js"></script>
<script src="<?php echo base_url(); ?>assets/treegrid/js/jquery.treegrid.custom.js"></script>
<script src="<?php echo base_url(); ?>assets/treegrid/js/jquery.cookie.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tree-3').treegrid({
			'initialState': 'collapsed',
			'saveState': true,
		});
	});
</script>
</body>
</html>