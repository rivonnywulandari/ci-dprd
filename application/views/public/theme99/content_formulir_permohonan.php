.form-group.required .control-label:after { 
   content:"*";
   color:red;
}


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
        <div class="col-xl-9 col-lg-8 col-md-12">

          <!-- Section: News -->
          <section class="section extra-margins pb-3 text-center text-lg-left wow fadeIn" data-wow-delay="0.2s">

           <form method="post" action="" >
            <div class="form-row align-items-center">
              <div class="col-sm-5 my-1">                
                <strong>Formulir Permohonan Informasi Publik</strong>
              </div>
              <!-- <div class="col-sm-6 my-1">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                  </div>
                  <input type="text" class="form-control form-control-lg" id="cari" name="cari" placeholder="masukkan kata kunci">
                </div>
              </div>
              <div class="col-auto my-1">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
              </div> -->
             
            </div>
          </form>

                     
          <hr style="margin-top:0px;">

          <?php if( $this->session->flashdata('flash') ) : ?>
          <div class="row mt-3">
              <div class="col-md-9">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Formulir Permohonan <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          </div>
          <?php endif; ?>

          <div class="row">
          <label class="col-md-9">&#160;</label> <!-- remove class control-label -->

            <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Formulir Permohonan Informasi Publik
                </div>
            <div class="card-body">
              <?php if( validation_errors()) : ?>
              <!-- <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
              </div> -->
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Formulir Permohonan <strong>belum diisikan dengan lengkap</strong> <?= $this->session->flashdata('flash'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              <?php endif; ?>
           <form action="" method="post">
            <div class="form-group <?=form_error('nama_pemohon_informasi') ? 'has-error' : null?>">
                <label for="nama_pemohon_informasi">Nama Pemohon Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="text" name="nama_pemohon_informasi" class="form-control" id="nama_pemohon_informasi" value="<?= set_value('nama_pemohon_informasi') ?>">
                <!-- <?=form_error('nama_pemohon_informasi')?> -->
                <span class="text-danger"><?php echo form_error('nama_pemohon_informasi'); ?></span>
            </div>         
              
            <div class="form-group">
                <label for="ktp_pemohon">Nomor KTP (sesuai KTP)</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="number" name="ktp_pemohon" class="form-control" id="ktp_pemohon" value="<?= set_value('ktp_pemohon') ?>">
                <span class="text-danger"><?php echo form_error('ktp_pemohon'); ?></span>
            </div>
            <div class="form-group">
                <label for="alamat_pemohon">Alamat Pemohon Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="text" name="alamat_pemohon" class="form-control" id="alamat_pemohon" value="<?= set_value('alamat_pemohon') ?>">
                <span class="text-danger"><?php echo form_error('alamat_pemohon'); ?></span>
            </div>
            <div class="form-group">
                <label for="nohp_pemohon">Nomor Telepon</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="number" name="nohp_pemohon" class="form-control" id="nohp_pemohon" value="<?= set_value('nohp_pemohon') ?>">
                <span class="text-danger"><?php echo form_error('nohp_pemohon'); ?></span>
            </div>
            <div class="form-group">
                <label for="email_pemohon">Email Pemohon Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="email" name="email_pemohon" class="form-control" id="email_pemohon" value="<?= set_value('email_pemohon') ?>">
                <span class="text-danger"><?php echo form_error('email_pemohon'); ?></span>
            </div>
            <div class="form-group">
                <label for="informasi_yang_dibutuhkan">Informasi Yang dibutuhkan</label>
                <span class="control-label" style="color:red;"> *</span>
                <textarea class="form-control" name="informasi_yang_dibutuhkan" id="informasi_yang_dibutuhkan" rows="3"><?= set_value('informasi_yang_dibutuhkan') ?></textarea>
                <span class="text-danger"><?php echo form_error('informasi_yang_dibutuhkan'); ?></span>
            </div>
            <div class="form-group">
                <label for="alasan_permintaan">Alasan Permintaan</label>
                <span class="control-label" style="color:red;"> *</span>
                <textarea class="form-control" name="alasan_permintaan" id="alasan_permintaan" rows="3"><?= set_value('alasan_permintaan') ?></textarea>
                <span class="text-danger"><?php echo form_error('alasan_permintaan'); ?></span>
            </div>
            <div class="form-group">
                <label for="nama_pengguna_informasi">Nama Pengguna Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="text" name="nama_pengguna_informasi" class="form-control" id="nama_pengguna_informasi" value="<?= set_value('nama_pengguna_informasi') ?>">
                <span class="text-danger"><?php echo form_error('nama_pengguna_informasi'); ?></span>
            </div>
            <div class="form-group">
                <label for="ktp_pengguna">Nomor KTP Pengguna Informasi (sesuai KTP)</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="number" name="ktp_pengguna" class="form-control" id="ktp_pengguna" value="<?= set_value('ktp_pengguna') ?>">
                <span class="text-danger"><?php echo form_error('ktp_pengguna'); ?></span>
            </div>            
            <div class="form-group">
                <label for="alamat_pengguna">Alamat Pengguna Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="text" name="alamat_pengguna" class="form-control" id="alamat_pengguna" value="<?= set_value('alamat_pengguna') ?>">
                <span class="text-danger"><?php echo form_error('alamat_pengguna'); ?></span>
            </div>
            <div class="form-group">
                <label for="nohp_pengguna">Nomor Telepon Pengguna Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="number" name="nohp_pengguna" class="form-control" id="nohp_pengguna" value="<?= set_value('nohp_pengguna') ?>">
                <span class="text-danger"><?php echo form_error('nohp_pengguna'); ?></span>
            </div>
            <div class="form-group">
                <label for="email_pengguna">Email Pengguna Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="email" name="email_pengguna" class="form-control" id="email_pengguna" value="<?= set_value('email_pengguna') ?>">
                <span class="text-danger"><?php echo form_error('email_pengguna'); ?></span>
            </div>
            <div class="form-group">
                <label for="alasan_penggunaan_informasi">Alasan Penggunaan Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <textarea class="form-control" name="alasan_penggunaan_informasi" id="alasan_penggunaan_informasi" rows="3"><?= set_value('alasan_penggunaan_informasi') ?></textarea>
                <span class="text-danger"><?php echo form_error('alasan_penggunaan_informasi'); ?></span>
            </div>
            <div class="form-group">
                <label for="cara_memperoleh_informasi">Cara Memperoleh Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <select class="form-control" name="cara_memperoleh_informasi" id="cara_memperoleh_informasi" value="<?= set_value('cara_memperoleh_informasi') ?>">
                <option>Langsung</option>
                <option>Website</option>
                <option>Email</option>
                <option>Fax</option>
                <option>Via Pos</option>
                </select>
            </div>
            <div class="form-group">
                <label for="format_bahan_informasi">Format Bahan Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <select class="form-control" name="format_bahan_informasi" id="format_bahan_informasi" value="<?= set_value('format_bahan_informasi') ?>">
                <option>Tercetak</option>
                <option>Terekam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cara_mengirim_bahan_informasi">Cara Mengirim Bahan Informasi</label>
                <span class="control-label" style="color:red;"> *</span>
                <select class="form-control" name="cara_mengirim_bahan_informasi" id="cara_mengirim_bahan_informasi" value="<?= set_value('cara_mengirim_bahan_informasi') ?>">
                <option>Langsung</option>
                <option>Via Pos</option>
                <option>Email</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                <span class="control-label" style="color:red;"> *</span>
                <input type="date" name="tanggal_pengajuan" class="form-control" id="tanggal_pengajuan" value="<?= set_value('tanggal_pengajuan') ?>">
                <span class="text-danger"><?php echo form_error('tanggal_pengajuan'); ?></span>
            </div>

            <!-- <span class="control-label" style="color:red;"> *</span> -->
            <span class="control-label" >Field bertanda * harus diisi</span>

            <button type="submit" name="formulir_permohonan" class="btn btn-primary float-right">Kirim Formulir</button>
            </div>
            </div>

            </form>

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
