<div class="breadcrumbs-v4">
  <div class="container">
    <br><br><br>
    <ul class="breadcrumb-v4-in">
      <li><?php echo $this->breadcrumb->output(); ?></li>
    </ul>
  </div><!--/end container-->
</div>

<div class="container">
   <!-- Main layout -->
  <main>

    <div class="container-fluid">

    

      <!-- Magazine -->
      <div class="row mt-5">

        <!-- Main newsfeed -->
        <div class="col-xl-9 col-lg-8 col-md-12">

          <!-- Section: News -->
          <section class="section extra-margins pb-3 text-center text-lg-left wow fadeIn" data-wow-delay="0.3s">

          <div class="row">
              <div class="col-md-3">
                   <h5 class="dark-grey-text font-weight-bold">
                    <strong> Pimpinan</strong>
                    </h5>
              </div>
              <div class="col-md-9">
                  <form method="post" action="<?php echo site_url();?>home/search" class="text-right">
                    <label>Pencarian :</label>
                    <label>
                      <div class="btn-group">
                        <input type="text" name="cari" class="form-control" placeholder="masukkan kata kunci" style="width:100%"  required>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-info btn-sm" type="submit" style="height:38px;"><i class="fa fa-search"></i></button>
                      </div>
                    </label>
                    </form>
              </div>

          </div>
           
          <hr style="margin-top:0px;">

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

          <hr/>

       
        </div>
          

           

          </section>
          <!-- Section: News -->

        </div>
        <!-- Main newsfeed -->

        <!-- Sidebar -->
        <div class="col-xl-3 col-lg-4 col-md-12 mt-0" style="margin-bottom:20px;">

          <!-- Popular posts -->
          <section>

            <div class="row">
              <div class="col-md-12">
                <h5 class="dark-grey-text font-weight-bold" style="margin-bottom:15px;">
                      <strong> Berita Populer</strong>
               </h5> 
              </div>               
            </div>
             <hr>
             <?php $no=0; foreach ($berita_populer as $row): $no++; ?>
              <div>
                <small><a style="color:#b0b8b5"><i><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></i></a></small>
                <h6 class="grey-text"><a href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><b><?php echo strtoupper(($row->judul));?>..</b></a></h6>
              </div>
              
              <?php endforeach; ?>
              <?php if (!$berita_populer)
                echo '<label ><small><a>Tidak ada data !!!</a></small></label>';    
              ?>
           </section>
          <!-- Popular posts -->

           <!-- Download -->
          <section>

            <div class="row">
              <div class="col-md-12">
                <h5 class="dark-grey-text font-weight-bold">
                      <strong> Pengumuman</strong>
               </h5> 
              </div>               
            </div>
             <hr>
             <?php $no=0; foreach ($pengumuman as $row): $no++; ?>
              <div>
                <small><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></small>
                <h6 class="text-danger"><a style="color:#f81b13;" href="<?php echo site_url();?>home/pengumuman/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><b><?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..</b></a></h6>
              </div>              
              <?php endforeach; ?>
              <?php if (!$pengumuman)
                echo '<label ><small><a>Tidak ada data !!!</a></small></label>';    
              ?>
           </section>
          <!-- Download -->

           <!-- Download -->
          <section>

            <div class="row">
              <div class="col-md-12">
                <h5 class="dark-grey-text font-weight-bold">
                      <strong> Download</strong>
               </h5> 
              </div>               
            </div>
             <hr>
             <?php $no=0; foreach ($download as $row): $no++; ?>
              <div>
                <strong><?php echo tulis_hari($row->hari); ?>,</strong>
                <span><b><?php echo tulis_waktu($row->tanggal); ?></b></span>
                <p style="margin:0px;"><?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..</p>
                <a class="link" href="<?php echo site_url();?>home/file/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><i class="fa fa-download"></i><b> Download</b></a>
              </div>
              <hr class="hr-xs">
              <?php endforeach; ?>
              <?php if (!$download)
                echo '<label ><small><a>Tidak ada data !!!</a></small></label>';    
              ?>
           </section>
          <!-- Download -->

            <!-- Download -->
          <section>

            <div class="row">
              <div class="col-md-12">
                <h5 class="dark-grey-text font-weight-bold">
                      <strong> Artikel Terbaru</strong>
               </h5> 
              </div>               
            </div>
             <hr>
             <?php $no=0; foreach ($artikel as $row): $no++; ?>
            <div>
              <small><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></small>
              <h6 class="text-success"><a style="color:#5cb85c;" href="<?php echo site_url();?>home/artikel/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><b><?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..</b></a></h6>
            </div>
            
            <?php endforeach; ?>
            <?php if (!$artikel)
              echo '<label style="color:#5cb85c;"><small>Tidak ada data !!!</small></label>';   
            ?>
           </section>
          <!-- Download -->


        </div>
        <!-- Sidebar -->

      </div>
      <!-- Magazine -->

    </div>

  </main>
  <!-- Main layout -->

</div>
