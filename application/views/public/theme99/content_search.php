

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
      <div class="row mt-5 row">

        <!-- Main newsfeed -->
        <div class="col-xl-12 col-lg-8 col-md-12">

          <!-- Section: News -->
          <section class="section extra-margins pb-3 text-center text-lg-left wow fadeIn" data-wow-delay="0.2s">

           <form method="post" action="<?php echo site_url();?>home/search" >
            <div class="form-row align-items-center">
              <div class="col-sm-2 my-1">                
                <label class="">Pencarian :</label>
              </div>
              <div class="col-sm-6 my-1">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                  </div>
                  <input type="text" class="form-control form-control-lg" id="cari" name="cari" placeholder="masukkan kata kunci">
                </div>
              </div>
              <div class="col-auto my-1">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
              </div>
             
            </div>
          </form>

                     
          <hr style="margin-top:0px;">

          <div class="row">
             <div class="col-md-12">
              <blockquote class="blockquote">
                  <h5><?php if(!$cari == "") echo 'Hasil pencarian dengan kata kunci' ;?>
                    <b class="text-warning">" <?php echo $cari;?> "</b>
                  </h5>      
              </blockquote>
              
            </div>
            <hr>
            <div class="col-md-12">
              <?php $no= $offset; foreach ($array_group as $row): $no++;
                if (!$row == null){
                  $id   = $row['id'];
                  $judul  = $row['judul'];
                  $isi  = $row['isi'];
                  $hari   = $row['hari'];
                  $tanggal= $row['tanggal'];
                  $modul  = $row['modul'];
                  $tabel  = $row['tabel'];
                  $tabelkat = 'tb_kat'.$modul;

                  if ($modul == "foto"){
                          $tabel      = $this->master->getData('tabel','tb_foto','id',$id); 
                          $id_konten  = $this->master->getData('id_konten','tb_foto','id',$id); 
                      }
                      else{
                        $tabel    = $tabel;
                          $id_konten  = $id; 
                      }

                  $id_kat = $this->master->getData('id_kat',$tabel,'id',$id);
                  if ( $id_kat == "" ) $id_kat = 0;             
                  ?>
                  <div>
                    <p class="lead" style="font-size:16px; margin-bottom:0px;">
                      <i class="fa fa-calendar"></i> <?php echo tulis_hari($hari); ?>, <?php echo tulis_waktu($tanggal); ?>
                      <a href="<?php echo site_url().'home/'.$modul.'/'.$id_kat;?>">
                      <?php if ($id_kat !=0 ) echo ' | '.$this->master->getData('nama',$tabelkat,'id',$id_kat);?>
                      </a>                                 
                    </p>
                  </div>
                

                 <h5 class="grey-text"><strong style="font-weight:bold"><?php echo $judul;?></strong></h5>
                <p align="justify"><?php echo $this->fungsi->tulisIsi($isi,'400');?>                  
                  <span style="font-size:14px;"><a href="<?php echo site_url().'home/'.$modul.'/'.$id_kat.'/'.$id;?>" class="badge badge-primary ">Read more</a></span>
                </p>        
                <hr>
              <?php } ?>  

            <?php endforeach; $jml = $no;?>   
            </div>
            <?php
            if (!$array_group || $cari == "")
              echo '<p class="text-center"><b style="font-weight:bold;">'.$null.'</b><p>';    
            ?>

            <div class="row">
              <div class="col">
                <nav class="wow fadeIn" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">           
                    <?php echo $pagination; ?>
                </nav>
              </div>

              <div class="col">
                 <?php if($array_group) echo '<p>'.$jml.' dari '.$total_rows.' data</p>'; ?> 
              </div>

            </div>
          
            
          </div>                     

           

          </section>
          <!-- Section: News -->

        </div>
        <!-- Main newsfeed -->

      
      </div>
      <!-- Magazine -->

    </div>

  
  </main>
  <!-- Main layout -->

</div>
