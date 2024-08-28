<div class="breadcrumbs-v4">
  <div class="container">
    <br><br><br>
    <ul class="breadcrumb-v4-in text-white">
      <li><?php echo $this->breadcrumb->output(); ?></li>
    </ul>
  </div><!--/end container-->
</div>


<div class="container">
   <!-- Main layout -->
  <main>

    <div class="container-fluid">

    

      <!-- Magazine -->
      <div class="row mt-5 row wow fadeIn" data-wow-delay="0.1s">

        <!-- Main newsfeed -->
        <div class="col-xl-9 col-lg-8 col-md-12">

          <!-- Section: News -->
          <section class="section extra-margins pb-3 text-center text-lg-left wow fadeIn" data-wow-delay="0.3s">

          <div class="row">
              <div class="col-md-3">
                   <h5 class="dark-grey-text font-weight-bold">
                    <strong> <?php echo $head;?></strong>
                    
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

            <!-- Grid row -->
            <div class="row" style="padding-left:10px;">
             <?php $no=$offset; foreach ($data as $row): $no++;
              if ($modul == "foto"){
                      $tabel      = $this->master->getData('tabel','tb_foto','id',$row->id); 
                      $id_konten  = $this->master->getData('id_konten','tb_foto','id',$row->id); 
                  }
                  else{
                      $id_konten = $row->id; 
                  }

              $thumb = $this->master->getDataThumb($tabel,$id_konten);

              if ($thumb == "")
                $thumb = site_url().'media/fotos/thumbnail.png';

              if (isset($row->id_kat)){
                $id_kat = $row->id_kat;
                $kategori = 'Kategori : '.$this->master->getData('nama',$tabelkat,'id',$id_kat);      
              }
              else{
                $id_kat = 0;
                $kategori = '';
              }
              ?>
               <div class="row">
                <!-- Grid column -->
                <div class="col-lg-4">
                  <!-- Featured image -->
                  <div class="view overlay rgba-white-slight">
                    <a href="<?php echo site_url().'home/'.$modul.'/'.$id_kat.'/'.$row->id;?>">
                    <img class="img-fluid sm-margin-bottom-20" src="<?php echo $thumb;?>" alt="" style="width:100%;height:220px;">
                    </a>
                    <a>
                      <div class="mask"></div>
                    </a>
                  </div>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                 <div class="col-lg-8">

                  <h5>
                    <strong><a class="text-warning" href="<?php echo site_url().'home/'.$modul.'/'.$id_kat.'/'.$row->id;?>"><?php echo $row->judul;?></a></strong>
                  </h5>

                  <p class="dark-grey-text"><?php echo $this->fungsi->tulisIsi($row->isi,'300');?>...</p>

                  <p><a href="#"><?php echo $row->hit; ?> views</a> | 
                   <a href="#"><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></a> | 
                   <a class="text-dark" href="<?php echo site_url().'home/'.$modul.'/'.$id_kat;?>" ><b>Kategori : <span class="grey-text"><?php echo $kategori;?></span></b></a>
                  </p>
                </div>
                <!-- Grid column -->
              </div>
              <!-- Grid row -->

              <div class="col-lg-12 mb-4" style="border : 1px solid rgba(0,0,0,.1);margin-top:5px;" ></div>
              <?php endforeach; ?>
              <?php if (!$data)
                echo '<p class="text-center"><small><a>Tidak ada data !!!</a></small></p>';   
              ?>

             
            </div>
            <!-- Grid row -->
              

            <!-- Pagination dark -->
            <nav class="wow fadeIn mb-4 mt-5" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">           
                <?php echo $pagination; ?>
            </nav>
            <!-- Pagination dark -->

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
