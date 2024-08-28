<!--=== Slider ===-->
<div class="tp-banner-container">
	<div class="tp-banner">
		<ul>	
			<?php foreach ($this->master->getDisplay(1) as $row ): ?>
			<li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="<?php echo $row->judul;?>">
				<img src="<?php echo site_url().$row->foto;?>"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

				<div class="tp-caption revolution-ch5 sft start"
				data-x="right"
				data-hoffset="5"
				data-y="130"
				data-speed="1500"
				data-start="500"
				data-easing="Back.easeInOut"
				data-endeasing="Power1.easeIn"
				data-endspeed="300">
				<strong><?php echo $row->judul;?></strong> 
				</div>

				<!-- LAYER -->
				<div class="tp-caption revolution-ch4 sft"
				data-x="right"
				data-hoffset="-14"
				data-y="210"
				data-speed="1400"
				data-start="2000"
				data-easing="Power4.easeOut"
				data-endspeed="300"
				data-endeasing="Power1.easeIn"
				data-captionhidden="off"
				style="z-index: 6">
				<?php echo $row->isi;?>
				</div>

				<!-- LAYER -->
				<div class="tp-caption sft"
				data-x="right"
				data-hoffset="0"
				data-y="300"
				data-speed="1600"
				data-start="2800"
				data-easing="Power4.easeOut"
				data-endspeed="300"
				data-endeasing="Power1.easeIn"
				data-captionhidden="off"
				style="z-index: 6">
				</div>
			</li>
			<?php endforeach; ?>

			<?php if (!$this->master->getDisplay(1)): ?>	
			<li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Default">
				<img src=""  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">
			</li>
			<?php endif;?>		

		</ul>
		<div class="tp-bannertimer tp-bottom"></div>
	</div>
</div>

<div class="container content-md">
	<div class="row">
		<div class="col-md-3 filter-by-block md-margin-bottom-60">
			<div class="headline"><h2>Gubernur dan Wagub</h2></div>
			<?php foreach ($this->master->getDisplay(3) as $row):?>
			<img width="100%" src="<?php echo site_url().$row->foto;?>"></img>
			<?php endforeach; ?>
		</div>
		<div class="col-md-6 filter-by-block md-margin-bottom-60">
			<div class="headline"><h2>Foto Utama</h2></div>
			<div class="illustration-v2 margin-bottom-60">
				<ul class="list-inline owl-slider">
					<?php $no=0; foreach ($foto_utama as $row): $no++;?> 
					<li class="item">
						<div class="product-img foto1">
							<a href="<?php echo site_url();?>home/foto/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><img class="full-width img-responsive" src="<?php echo $this->master->getDataThumb($row->tabel,$row->id_konten);?>" alt=""></a>
							<div class="shop-rgba-dark-green rgba-banner"><?php echo $no;?></div>
						</div>
						<div class="product-description product-description-brd">
							<div class="overflow-h margin-bottom-5">
								<div class="pull-left">
									<h4 class="title-price">
									<a href="<?php echo site_url();?>home/foto/<?php echo $row->id_kat;?>/<?php echo $row->id;?>" style="color:gray;">
									<?php echo $row->judul;?>
									</a>
									</h4>
									<span class="gender"><?php echo tulis_waktu($row->tanggal);?></span>
								</div>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>				
				<div class="customNavigation margin-bottom-25">
					<a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
					<a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		</div>	
		<div class="col-md-3 filter-by-block md-margin-bottom-60">
			<div class="headline"><h2>Pimpinan</h2></div>
			<div class="illustration-v2 margin-bottom-60">
				<ul class="list-inline owl-slider-v3">
					<?php $no=0; foreach ($pimpinan as $row): $no++;?> 
					<li class="item">
						<div class="product-img foto3">
							<a href="#">
								<img class="full-width img-responsive" src="<?php echo site_url().$this->master->getDataFoto('foto','tb_pimpinan',$row->id);?>">
							</a>												
						</div>
						<div>
							<a class="owl-btn prev-v3"><i class="fa fa-angle-left"></i></a>
							<a class="owl-btn next-v3"><i class="fa fa-angle-right"></i></a>
						</div>
						<div class="product-description product-description-brd">
							<div class="overflow-h margin-bottom-5">
								<div class="pull-left">
									<h4 class="title-price">
									<a style="color:gray;">
									<b><?php echo $this->fungsi->tulisIsi($row->nama,'30');?></b>
									</a>
									</h4>
									<span class="gender"><b><?php echo $row->jabatan;?></b></span>
								</div>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>	
	</div>		

	<div class="row">
		<div class="col-md-9">
			<div class="row margin-bottom-5">
				<div class="col-sm-4 result-category">
					<h2>Berita</h2>
					<small class="shop-bg-red badge-results"><?php echo $total_berita; ?> Data</small>
				</div>
				<div class="col-sm-8">
					<ul class="list-inline clear-both">
						<li class="sort-list-btn">
							<form method="post" action="<?php echo site_url();?>home/search">
							<label>Pencarian :</label>
							<label>
								<div class="btn-group">
									<input type="text" name="cari" class="form-control" placeholder="masukkan kata kunci" size="16" required>
								</div>
								<div class="btn-group">
									<button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
								</div>
							</label>
							</form>
						</li>
					</ul>
				</div>
			</div>				
				
			<div class="filter-results">
				<?php foreach ($berita_terbaru as $row): 
				$kategori = $this->master->getData('nama','tb_katberita','id',$row->id_kat);
				$thumb 	  = $this->master->getDataThumb('tb_berita',$row->id);
				if ($thumb == "")
					$thumb = site_url().'media/fotos/thumbnail.png';
				?>
				<div class="list-product-description product-description-brd margin-bottom-30">
					<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><img class="img-responsive sm-margin-bottom-20" src="<?php echo $thumb;?>" alt=""></a>
						</div>
						<div class="col-sm-8 product-description">
							<div class="overflow-h margin-bottom-5">
								<ul class="list-inline overflow-h">
									<li><h4 class="title-price"><b><a href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><?php echo $row->judul;?></a></b></h4></li>
								</ul>
								<p class="margin-bottom-20"><?php echo $this->fungsi->tulisIsi($row->isi,'300');?>...</p>
								<ul class="list-inline add-to-wishlist margin-bottom-20">
									<li class="wishlist-in">
										<a href="#"><?php echo $row->hit; ?> views</a>
									</li>
									<li class="compare-in">
										<a href="#"><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></a>
									</li>
									<li class="compare-in">
										<a href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>" ><b>Kategori : <?php echo $kategori;?></b></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php if (!$berita_terbaru)
					echo '<p class="text-center"><small><a>Tidak ada data !!!</a></small></p>';		
				?>
				<div class="text-center">
					<?php echo $pagination; ?>
				</div>
			</div>			
		</div>

		<div class="col-md-3 filter-by-block md-margin-bottom-60">
			<div class="panel-group" id="accordion">
				<div class="margin-bottom-50">
					<h2 class="title-v4">Berita Populer</h2>
					<?php $no=0; foreach ($berita_populer as $row): $no++; ?>
					<div class="blog-thumb-v3">
						<small><a style="color:#b0b8b5"><i><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></i></a></small>
						<h3><a href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><b><?php echo strtoupper(($row->judul));?>..</b></a></h3>
					</div>
					<hr class="hr-xs">
					<?php endforeach; ?>
					<?php if (!$berita_populer)
						echo '<label ><small><a>Tidak ada data !!!</a></small></label>';		
					?>
				</div>
			</div>
			<div class="panel-group" id="accordion">
				<div class="margin-bottom-50">
					<h2 class="title-v4">Pengumuman</h2>
					<?php $no=0; foreach ($pengumuman as $row): $no++; ?>
					<div class="blog-thumb-v3">
						<small><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></small>
						<h3><a style="color:#f81b13;" href="<?php echo site_url();?>home/pengumuman/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><b><?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..</b></a></h3>
					</div>
					<hr class="hr-xs">
					<?php endforeach; ?>
					<?php if (!$pengumuman)
						echo '<label ><small><a>Tidak ada data !!!</a></small></label>';		
					?>
				</div>
			</div>
			<div class="panel-group" id="accordion">
				<div class="margin-bottom-50">
					<h2 class="title-v4">Download</h2>

					<div class="twitter-posts">	
						<?php $no=0; foreach ($download as $row): $no++; ?>
						<div class="twitter-posts-in margin-bottom-10">
							<strong><?php echo tulis_hari($row->hari); ?>,</strong>
							<span><b><?php echo tulis_waktu($row->tanggal); ?></b></span>
							<p style="margin:0px;"><?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..</p>
							<a class="link" href="<?php echo site_url();?>home/file/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><i class="fa fa-download"></i><b> Download</b></a>
						</div>
						<?php endforeach; ?>
						<?php if (!$download)
							echo '<label ><small><a>Tidak ada data !!!</a></small></label>';		
						?>
					</div>
				</div>
			</div>

			<div class="panel-group" id="accordion">
				<div class="margin-bottom-50">
					<div class="headline"><h2>Artikel Terbaru</h2></div>
					<div class="twitter-posts">	
						<?php $no=0; foreach ($artikel as $row): $no++; ?>
						<div class="blog-thumb-v3">
							<small><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></small>
							<h3><a style="color:#5cb85c;" href="<?php echo site_url();?>home/artikel/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><b><?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..</b></a></h3>
						</div>
						<hr class="hr-xs">
						<?php endforeach; ?>
						<?php if (!$artikel)
							echo '<label style="color:#5cb85c;"><small>Tidak ada data !!!</small></label>';		
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-9">			
			<div class="panel-group" id="accordion">
				<div class="headline"><h2>Link Terkait</h2></div>
				<ul class="list-inline our-clients" id="effect-2">
					<?php foreach ($this->master->getDisplay(5) as $row):?>
					<li>
						<a target="_blank" href="<?php echo $row->isi;?>">
						<figure>
							<img width="100%" src="<?php echo site_url().$row->foto;?>" alt=""></img>
							<div class="img-hover">
								<h4><?php echo $row->judul;?></h4>
							</div>
						</figure>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>	
		<div class="col-md-3">				
			<?php $visitor = $this->model_home->visitor();?>
			<div class="panel-group" id="accordion">
				<div class="headline"><h2>Pengunjung</h2></div>
				<ul class="list-unstyled who margin-bottom-30">
					<li><span><i style="color:#d6a900;" class="fa fa-bullseye"></i>Total Hit</span><span style="float:right; " class="label label-warning"><?php echo $visitor['hit'];?></span></li>
					<li><span><i style="color:#d6a900;" class="fa fa-circle-o-notch fa-spin"></i>Online</span> <span style="float:right;" class="label label-success"><?php echo $visitor['online']; ?></span></li>
					<li><span><i style="color:#d6a900;" class="fa fa-clock-o"></i>Hari ini</span> <span style="float:right;" class="label label-warning"><?php echo $visitor['today']; ?></span></li>
					<li><span><i style="color:#d6a900;" class="fa fa-chevron-circle-left"></i>Kemarin</span><span style="float:right;" class="label label-warning"><?php echo $visitor['yesterday']; ?></span></li>
					<li><span><i style="color:#d6a900;" class="fa fa-calendar"></i>Bulan ini</span><span style="float:right;" class="label label-warning"><?php echo $visitor['thismonth']; ?></span></li>
					<li><span><i style="color:#d6a900;" class="fa fa-bar-chart-o"></i>Tahun ini</span><span style="float:right;" class="label label-warning"><?php echo $visitor['thisyear']; ?></span></li>
				</ul>
			</div>
		</div>		
	</div>
</div>