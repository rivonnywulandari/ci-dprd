<div class="breadcrumbs-v4">
	<div class="container">
		<br><br><br>
		<ul class="breadcrumb-v4-in">
			<li><?php echo $this->breadcrumb->output(); ?></li>
		</ul>
	</div><!--/end container-->
</div>

<div class="container content-md">
	<div class="row">
		<div class="col-md-9">
			<div class="row margin-bottom-5">
				<div class="col-sm-4 result-category">
					<h2><?php echo $this->master->getData('nama',$tabelkat,'id',$id_kat);?></h2>
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
				<?php $no=$offset; foreach ($data as $row): $no++;
				$kategori = $this->master->getData('nama','tb_katberita','id',$row->id_kat);
				if ($modul == "foto"){
		            $tabel      = $this->master->getData('tabel','tb_foto','id',$row->id); 
		            $id_konten 	= $this->master->getData('id_konten','tb_foto','id',$row->id); 
		        }
		        else{
		            $id_konten = $row->id; 
		        }
				$thumb = $this->master->getDataThumb($tabel,$id_konten);
				if ($thumb == "")
					$thumb = site_url().'media/fotos/thumbnail.png';
				?>
				<div class="list-product-description product-description-brd margin-bottom-30">
					<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo site_url().'home/'.$modul.'/'.$row->id_kat.'/'.$row->id;?>"><img class="img-responsive sm-margin-bottom-20" src="<?php echo $thumb;?>" alt=""></a>
						</div>
						<div class="col-sm-8 product-description">
							<div class="overflow-h margin-bottom-5">
								<ul class="list-inline overflow-h">
									<li><h4 class="title-price"><a href="<?php echo site_url('home/'.$modul.'/'.$row->id_kat.'/'.$row->id);?>"><b><?php echo $row->nama;?></b></a></h4></li>
								</ul>
								<p class="margin-bottom-20" align="justify"><?php echo $this->fungsi->tulisIsi($row->jabatan,'300');?>...</p>
								<ul class="list-inline add-to-wishlist margin-bottom-20">
									<li class="wishlist-in">
										<i class="fa fa-user"></i>
										<a href="#"><?php echo $row->hit; ?> views</a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; $jml = $no;?>	
				<?php if (!$data)
					echo '<p class="text-center"><small><a>Tidak ada data !!!</a></small></p>';		
				?>
			</div><!--/end filter resilts-->

			<div class="text-center">
			    <?php echo $pagination; ?>
			</div>
			<div class="text-center">
			    <p><?php echo $jml.' dari '.$total_rows; ?> data</p>
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
</div>