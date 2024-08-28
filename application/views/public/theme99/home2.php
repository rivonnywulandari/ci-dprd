<div class="container">
   <!-- Main layout -->
  <main>

    <div class="container-fluid">

      <!-- Top news -->
      <div class="row wow fadeIn" data-wow-delay="0.1s">       

          <!-- Grid column -->
          <div class="col-xl-3 col-lg-12 ">        
                <h5 class="dark-grey-text font-weight-bold">
                  <strong>Gubernur dan Wagub</strong>
                </h5>
                <hr>  
                <!-- Image -->
                <?php 
                  foreach ($this->master->getDisplay(3) as $row):
                  
                  if (file_exists(''.$row->foto.''))
                          $view_gub=site_url().$row->foto;
                      else
                          $view_gub=site_url().'media/no.png';
                ?>
                <div class="view zoom z-depth-1 rounded">
                  <img src="<?php echo $view_gub;?>" class="img-fluid rounded-bottom"
                    alt="sample image" style="width:100%;">
                  
                </div>
                <!-- Image --> 
                <?php endforeach; ?>
          </div>

          <!-- Grid column -->
          <div class="col-xl-6 col-lg-12 ">
                <h5 class="dark-grey-text font-weight-bold">
                  <strong>  Foto Utama</strong>
                </h5>
                <hr>    

                <div class="owl-one owl-carousel owl-theme">
                    <?php $no=0; foreach ($foto_utama as $row): $no++;?> 
                    <div class="item">
                        <a href="<?php echo site_url();?>home/foto/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
                        <img style="height:200px;" class="full-width img-fluid" src="<?php echo $this->master->getDataThumb($row->tabel,$row->id_konten);?>" alt="">
                        </a>
                        <div>                          
                            <div class="pull-left">
                              <h4 class="grey-text my-2" style="height:120px;font-size:18px;">
                              <a href="<?php echo site_url();?>home/foto/<?php echo $row->id_kat;?>/<?php echo $row->id;?>" style="color:gray;">
                              <?php echo substr($row->judul, 0,100);?>
                              </a>
                              </h4>
                              <span class="gender"><?php echo tulis_waktu($row->tanggal);?></span>
                            </div>                          
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
               
          </div>

          <!-- Grid column -->
          <div class="col-xl-3 col-lg-12 clearfix d-none d-lg-block">   
                 <h5 class="dark-grey-text font-weight-bold">
                  <strong>  Pimpinan</strong>
                </h5>
                <hr>                 
                <div class="owl-two owl-carousel owl-theme">
                    <?php $no=0; 
                         foreach ($pimpinan as $row): $no++;
                         $cekFoto = $this->master->getDataFoto('foto','tb_pimpinan',$row->id);

                    if ($cekFoto!='' && is_file(''.$cekFoto.''))
                          $view_pim=site_url().$this->master->getDataFoto('foto','tb_pimpinan',$row->id);
                    else
                          $view_pim=site_url().'media/noimage.png';                    
                    ?> 
                    <div class="item">
                        <img class="full-width img-fluid" src="<?php echo $view_pim;?>">
                        <div>                          
                            <div class="pull-left">
                              <h4 class="grey-text my-2" style="font-size:16px;">                             
                             <?php echo $this->fungsi->tulisIsi($row->nama,'30');?>
                              </h4>
                              <span><?php echo $row->jabatan;?></span>
                            </div>                          
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

          </div>

      </div>
      <!-- Top news -->

      <!-- Magazine -->
      <div class="row mt-5">

        <!-- Main newsfeed -->
        <div class="col-xl-9 col-lg-8 col-md-12">

          <!-- Section: News -->
          <section class="section extra-margins pb-3 text-center text-lg-left wow fadeIn" data-wow-delay="0.3s">

          <div class="row">
              <div class="col-md-3">
                   <h5 class="dark-grey-text font-weight-bold">
                    <strong> Berita</strong>
                    <small class="badge badge-primary"><?php echo $total_berita; ?> Data</small>
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
              <?php foreach ($berita_terbaru as $row): 
              $kategori = $this->master->getData('nama','tb_katberita','id',$row->id_kat);
              $thumb    = $this->master->getDataThumb('tb_berita',$row->id);
              if ($thumb == "")
                $thumb = site_url().'media/fotos/thumbnail.png';
              ?>
               <div class="row">
                <!-- Grid column -->
                <div class="col-lg-4">
                  <!-- Featured image -->
                  <div class="view overlay rgba-white-slight">
                    <a href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
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
                    <strong><a class="text-warning" href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>/<?php echo $row->id;?>"><?php echo $row->judul;?></a></strong>
                  </h5>

                  <p class="dark-grey-text"><?php echo $this->fungsi->tulisIsi($row->isi,'300');?>...</p>

                  <p><a href="#"><?php echo $row->hit; ?> views</a> | 
                   <a href="#"><?php echo tulis_hari($row->hari); ?>, <?php echo tulis_waktu($row->tanggal); ?></a> | 
                   <a class="text-dark" href="<?php echo site_url();?>home/berita/<?php echo $row->id_kat;?>" ><b>Kategori : <span class="grey-text"><?php echo $kategori;?></span></b></a>
                  </p>
                </div>
                <!-- Grid column -->
              </div>
              <!-- Grid row -->

              <div class="col-lg-12 mb-4" style="border : 1px solid rgba(0,0,0,.1);margin-top:5px;" ></div>
              <?php endforeach; ?>
              <?php if (!$berita_terbaru)
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

    <div class="row mb-4" hidden>
        <div class="col-9"> 
            <h5 class="dark-grey-text font-weight-bold">
                <strong> Link Terkait</strong>                
                </h5>
                 <hr style="margin-top:0px;">   
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
        </div>
        <div class="col-3"> 
            <h5 class="dark-grey-text font-weight-bold">
                <strong> Pengunjung</strong>                
                </h5>
                 <hr style="margin-top:0px;">   
                 <?php $visitor = $this->model_home->visitor();?>
                <ul class="list-group">
                  <li class="list-group-item"><span><i style="color:#d6a900;" class="fa fa-bullseye"></i> Total Hit</span><span style="float:right; " class="label label-warning"> <?php echo $visitor['hit'];?></span></li>
                  <li class="list-group-item"><span><i style="color:#d6a900;" class="fa fa-user"></i> Online</span> <span style="float:right;" class="label label-success"> <?php echo $visitor['online']; ?></span></li>
                  <li class="list-group-item"><span><i style="color:#d6a900;" class="fa fa-clock"></i> Hari ini</span> <span style="float:right;" class="label label-warning"> <?php echo $visitor['today']; ?></span></li>
                  <li class="list-group-item"><span><i style="color:#d6a900;" class="fa fa-chevron-circle-left"></i> Kemarin</span><span style="float:right;" class="label label-warning"> <?php echo $visitor['yesterday']; ?></span></li>
                  <li class="list-group-item"><span><i style="color:#d6a900;" class="fa fa-calendar"></i> Bulan ini</span><span style="float:right;" class="label label-warning"> <?php echo $visitor['thismonth']; ?></span></li>
                  <li class="list-group-item"><span><i style="color:#d6a900;" class="fa fa-list-ul"></i> Tahun ini</span><span style="float:right;" class="label label-warning"> <?php echo $visitor['thisyear']; ?></span></li>
                </ul>
        </div>
    </div>
  </main>
  <!-- Main layout -->

</div>
