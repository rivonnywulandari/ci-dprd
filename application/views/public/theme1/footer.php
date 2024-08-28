	<div class="footer-v4">
		<div class="footer">
			<div class="container">
				<div class="row">
					<!-- About -->
					<div class="col-md-4 md-margin-bottom-40">
						<p>INFORMASI.</p>
						<ul class="list-unstyled address-list margin-bottom-20">
							<li><i class="fa fa-angle-right"></i><?php echo $this->master->getData('alamat','tb_contact','id','1');?></li>
							<li><i class="fa fa-angle-right"></i>Phone: <?php echo $this->master->getData('tlp','tb_contact','id','1');?></li>
							<li><i class="fa fa-angle-right"></i>Fax: <?php echo $this->master->getData('fax','tb_contact','id','1');?></li>
							<li><i class="fa fa-angle-right"></i>Email: <?php echo $this->master->getData('email','tb_contact','id','1');?></li>
						</ul>

						<ul class="list-inline shop-social">
							<li><a target="_blank" href="<?php echo $this->master->getData('facebook','tb_contact','id','1');?>"><i class="fb rounded-md fa fa-facebook"></i></a></li>
							<li><a target="_blank" href="<?php echo $this->master->getData('twitter','tb_contact','id','1');?>"><i class="tw rounded-md fa fa-twitter"></i></a></li>
							<li><a target="_blank" href="<?php echo $this->master->getData('gplus','tb_contact','id','1');?>"><i class="tw rounded-md fa fa-google-plus"></i></a></li>
						</ul>
					</div>
					<!-- End About -->

					<!-- Simple List -->
					<div class="col-md-8 col-sm-3">
						<div class="col-md-4 col-sm-3">
							<div class="row">
								<div class="col-sm-12 col-xs-6">
									<h2 class="thumb-headline">Pengumuman</h2>
									<ul class="list-unstyled simple-list margin-bottom-20">
										<?php 
										$pengumuman = $this->model_home->pengumuman();
										foreach ($pengumuman as $row): 
										?>
											<li>
												<a href="<?php echo site_url();?>home/pengumuman/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
												<?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..
												</a>
											</li>
										<?php
										endforeach;
										if (!$pengumuman)
											echo '<li><a>Tidak ada  data !!!</a></li>';		
										?>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-3">
							<div class="row">
								<div class="col-sm-12 col-xs-6">
									<h2 class="thumb-headline">Artikel</h2>
									<ul class="list-unstyled simple-list margin-bottom-20">
										<?php 
										$artikel = $this->model_home->artikel();
										foreach ($artikel as $row): 
										?>
											<li>
												<a href="<?php echo site_url();?>home/artikel/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
												<?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..
												</a>
											</li>
										<?php
										endforeach;
										if (!$artikel)
											echo '<li><a>Tidak ada  data !!!</a></li>';		
										?>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-3">
							<div class="row">
								<div class="col-sm-12 col-xs-6">
									<h2 class="thumb-headline">Download</h2>
									<ul class="list-unstyled simple-list margin-bottom-20">
										<?php 
										$download = $this->model_home->download();
										foreach ($download as $row): 
										?>
											<li>
												<a href="<?php echo site_url();?>home/file/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
												<?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..
												</a>
											</li>
										<?php
										endforeach;
										if (!$download)
											echo '<li><a>Tidak ada  data !!!</a></li>';		
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- End Simple List -->
				</div><!--/end row-->
			</div><!--/end continer-->
		</div><!--/footer-->

		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<p>
							<a href="#">Dinas Komunikasi dan Informatika Sumatera Barat</a>
						</p>
					</div>
					<div class="col-md-6">
						<ul class="list-inline sponsors-icons pull-right">
							&copy; <?php echo date('Y');?> | <li><a target="_blank"  href="http://egov.sumbarprov.go.id/egov	">Team e-Government Provinsi Sumatera Barat</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!--/copyright-->
	</div>
	<!--=== End Footer v4 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script src="<?php echo site_url();?>assets/public/theme1/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="<?php echo site_url();?>assets/public/theme1/plugins/back-to-top.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/smoothScroll.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/jquery.parallax.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- JS Customization -->
<script src="<?php echo site_url();?>assets/public/theme1/js/custom.js"></script>
<!-- JS Page Level -->
<script src="<?php echo site_url();?>assets/public/theme1/js/shop.app.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/js/plugins/owl-carousel.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/js/plugins/revolution-slider.js"></script>
<script src="<?php echo site_url();?>assets/public/theme1/js/plugins/style-switcher.js"></script>

<script type="text/javascript" src="<?php echo site_url();?>assets/public/theme1/plugins/image-hover/js/touch.js"></script>
<script type="text/javascript" src="<?php echo site_url();?>assets/public/theme1/plugins/image-hover/js/modernizr.js"></script>

<script>
	jQuery(document).ready(function() {
		App.init();
		App.initScrollBar();
		App.initParallaxBg();
		OwlCarousel.initOwlCarousel();
		RevolutionSlider.initRSfullWidth();
		StyleSwitcher.initStyleSwitcher();
	});
</script>

                        
                    

</body>
</html>