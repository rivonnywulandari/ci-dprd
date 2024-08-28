<div class="breadcrumbs-v4">
	<div class="container">
		<br><br><br>
		<ul class="breadcrumb-v4-in">
			<li><?php echo $this->breadcrumb->output(); ?></li>
		</ul>
	</div>
</div>

<div class="container content-md">
	<div class="col-md-12">
		<div class="row">
			<div class="text-center">
				<p class="bigtext">
					PENCARIAN <b>DATA</b><br> 
					<form method="post" action="<?php echo site_url();?>home/search">
					<span class="col-md-6 col-md-offset-3">
						<input type="text" name="cari" class="form-control" placeholder="masukkan kata kunci pencarian" required/>
					</span>
					<span class="col-md-6 col-md-offset-3" style="padding-top:10px;">
						<button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
					</span>
					</form>
				</p>
				<br>				
			</div>
		</div>
		<div class="row">
			<br>
			<p class="small text-center"><?php if(!$cari == "") echo 'Hasil pencarian dengan kata kunci' ;?>
				<label class="label label-info label-sm" style="font-size:12px;"><?php echo $cari;?></label>
			</p>		
			<hr>
			<?php $no= $offset; foreach ($array_group as $row): $no++;
				if (!$row == null){
					$id 	= $row['id'];
					$judul 	= $row['judul'];
					$isi 	= $row['isi'];
					$hari 	= $row['hari'];
					$tanggal= $row['tanggal'];
					$modul 	= $row['modul'];
					$tabel 	= $row['tabel'];
					$tabelkat = 'tb_kat'.$modul;

					if ($modul == "foto"){
			            $tabel      = $this->master->getData('tabel','tb_foto','id',$id); 
			            $id_konten 	= $this->master->getData('id_konten','tb_foto','id',$id); 
			        }
			        else{
			        	$tabel 		= $tabel;
			            $id_konten 	= $id; 
			        }

					$id_kat = $this->master->getData('id_kat',$tabel,'id',$id);
					if ( $id_kat == "" ) $id_kat = 0;							
					?>

					<p class="lead" style="font-size:16px; margin-bottom:0px;">
						<i class="fa fa-calendar"></i> <?php echo tulis_hari($hari); ?>, <?php echo tulis_waktu($tanggal); ?>
						<a href="<?php echo site_url().'home/'.$modul.'/'.$id_kat;?>">
						<?php if ($id_kat !=0 ) echo ' | '.$this->master->getData('nama',$tabelkat,'id',$id_kat);?>
						</a>
						<br>
						<b style="font-weight:bold"><?php echo $judul;?></b>
					</p>
					<p align="justify"><?php echo $this->fungsi->tulisIsi($isi,'400');?>				 					
						<span style="font-size:14px;"><a href="<?php echo site_url().'home/'.$modul.'/'.$id_kat.'/'.$id;?>" class="label label-success ">Read more</a></span>
					</p>				
					<hr class="clearfix">
				<?php } ?>				
			<?php endforeach; $jml = $no;?>		
			<?php
			if (!$array_group || $cari == "")
				echo '<p class="text-center"><b style="font-weight:bold;">'.$null.'</b><p>';		
			?>
			<div class="text-center">
			    <?php echo $pagination; ?>
			</div>
			<div class="text-center">
			    <?php if($array_group) echo '<p>'.$jml.' dari '.$total_rows.' data</p>'; ?> 
			</div>

			<br>
		</div>
	</div>
</div>