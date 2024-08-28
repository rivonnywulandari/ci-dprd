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
	
			<div class="headline"><p style="font-size:20px; color:#ca9b00;"><?php echo $detail->nama;?></p></div>

			<?php if ($this->master->countDataFoto($tabel,$id_konten) > 0): ?>
			<img  class="img-responsive margin-bottom-20 foto2" src="<?php echo site_url().$this->master->getDataFoto('foto',$tabel,$id_konten);?>" alt="">
			<?php endif;?>
			
			<p style="font-size:14px; color:#141823;">
			    <br>
			Jenis Kelamin :  <?php echo $detail->jk;?><br>
			TTL :   <?php echo $detail->tmp_lhr;?>, <?php echo $detail->tgl_lhr;?><br>
			JABATAN :  <?php echo $detail->jabatan;?></a>
			</p>

			<?php if ($this->master->countDataFile($tabel,$id_konten) > 0): ?>
			<p style="font-size:14px; color:#141823;">
			Nama File : <?php echo $this->master->getDataFile('nama_file',$tabel,$id_konten);?> <br>
			Size : <?php echo $this->master->getDataFile('ukuran',$tabel,$id_konten);?> KB <br>
			Action :  <a target="_blank" href="<?php echo site_url().$this->master->getDataFile('dokumen',$tabel,$id_konten);?>"><i class="fa fa-download"></i> DOWNLOAD</a>
			</p>
			<?php endif;?>

			<div class="text_post_section tags_section side_bar_tabs" style="margin-top:0px; margin-bottom:5px;">
				Share on:
				<div class="addthis_toolbox addthis_default_style">
	                <a class="addthis_button_preferred_1"></a>
	                <a class="addthis_button_preferred_2"></a>
	                <a class="addthis_button_preferred_3"></a>
	                <a class="addthis_button_preferred_4"></a>
	                <a class="addthis_button_compact"></a>
	                <a class="addthis_counter addthis_bubble_style"></a>
	            </div>
	            <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8aab4674f1896a'></script>
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