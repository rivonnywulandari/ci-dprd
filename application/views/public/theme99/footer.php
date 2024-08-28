 <!-- Footer -->
  <footer class="page-footer text-center text-md-left stylish-color-dark  pt-0">

    <div class="top-pink-footer" style="background-color: #f57c00;">
      <div class="container">
        

      </div>
    </div>

    <!-- Footer Links -->
    <div class="container mt-2 mb-1 text-center text-md-left">
      <div class="row mt-3">

        <!-- First column -->
        <div class="col-md-3 mb-5 mt-3">
          <h6 class="spacing font-weight-bold">
            <strong> INFORMASI</strong>
          </h6>
          <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p class="mb-0"><i class="fas fa-map mr-3"></i> <?php echo $this->master->getData('alamat','tb_contact','id','1');?></p>
          <p class="mb-0"><i class="fas fa-phone mr-3"></i> Phone: <?php echo $this->master->getData('tlp','tb_contact','id','1');?></p>
          <p class="mb-0"> <i class="fas fa-map mr-3"></i> Fax: <?php echo $this->master->getData('fax','tb_contact','id','1');?></p>
          <p class="mb-0"> <i class="fas fa-envelope mr-3"></i> Email: <?php echo $this->master->getData('email','tb_contact','id','1');?></p>
        </div>
        <!-- First column -->

        <!-- Second column -->
        <div class="col-md-3 mb-5 mt-3">
          <h6 class="spacing font-weight-bold">
            <strong> Pengumuman</strong>
          </h6>
          <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <?php 
          $pengumuman = $this->model_home->pengumuman();
          foreach ($pengumuman as $row): 
          ?>
            <p class="mb-0">
              <a href="<?php echo site_url();?>home/pengumuman/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
              <?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..
              </a>
            </p>
          <?php
          endforeach;
          if (!$pengumuman)
            echo '<p><a>Tidak ada  data !!!</a></p>';   
          ?>
        </div>
        <!-- Second column -->

        <!-- Second column -->
        <div class="col-md-3 mb-5 mt-3">
          <h6 class="spacing font-weight-bold">
            <strong> Artikel</strong>
          </h6>
          <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <?php 
            $artikel = $this->model_home->artikel();
            foreach ($artikel as $row): 
            ?>
              <p>
                <a href="<?php echo site_url();?>home/artikel/<?php echo $row->id_kat;?>/<?php echo $row->id;?>">
                <?php echo $this->fungsi->tulisIsi($row->judul,'40');?>..
                </a>
              </p>
            <?php
            endforeach;
            if (!$artikel)
              echo '<p><a>Tidak ada  data !!!</a></p>';   
            ?>
        </div>
        <!-- Second column -->

         <!-- Second column -->
        <div class="col-md-3 mb-5 mt-3">
          <h6 class="spacing font-weight-bold">
            <strong> Pengunjung</strong>
          </h6>
          <?php $visitor = $this->model_home->visitor();?>
          <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p class="mb-0"><span><i style="color:#d6a900;" class="fa fa-bullseye"></i> Total Hit</span><span style="float:right; " class="label label-warning"> <?php echo $visitor['hit'];?></span></p>
          <p class="mb-0"> <span><i style="color:#d6a900;" class="fa fa-user"></i> Online</span> <span style="float:right;" class="label label-success"> <?php echo $visitor['online']; ?></span></p>
          <p class="mb-0"> <span><i style="color:#d6a900;" class="fa fa-clock"></i> Hari ini</span> <span style="float:right;" class="label label-warning"> <?php echo $visitor['today']; ?></span></p>
          <p class="mb-0"> <span><i style="color:#d6a900;" class="fa fa-chevron-circle-left"></i> Kemarin</span><span style="float:right;" class="label label-warning"> <?php echo $visitor['yesterday']; ?></span></p>
          <p class="mb-0"> <span><i style="color:#d6a900;" class="fa fa-calendar"></i> Bulan ini</span><span style="float:right;" class="label label-warning"> <?php echo $visitor['thismonth']; ?></span></p>
          <p class="mb-0"> <span><i style="color:#d6a900;" class="fa fa-list-ul"></i> Tahun ini</span><span style="float:right;" class="label label-warning"> <?php echo $visitor['thisyear']; ?></span></p>
        
        </div>
        <!-- Second column -->

       

      </div>

      <!-- Grid row -->
        <div class="row py-2 align-items-center">

       
         <!-- Grid column -->
          <div class="col-md-2 text-center text-md-left mb-md-0">
            <h6 class="mb-4 mb-md-0 white-text">Social Media</h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-6 col-lg-7 text-center text-md-left">
            <!-- Facebook -->
            <a class="p-2 m-2 fa-lg fb-ic ml-0" target="_blank" href="<?php echo $this->master->getData('facebook','tb_contact','id','1');?>">
              <i class="fab fa-facebook-f white-text mr-lg-4"> </i>
            </a>
            <!-- Twitter -->
            <a class="p-2 m-2 fa-lg tw-ic" target="_blank" href="<?php echo $this->master->getData('twitter','tb_contact','id','1');?>">
              <i class="fab fa-twitter white-text mr-lg-4"> </i>
            </a>
            <!-- Google + -->
            <a class="p-2 m-2 fa-lg gplus-ic" target="_blank" href="<?php echo $this->master->getData('twitter','tb_contact','id','1');?>">
              <i class="fab fa-google-plus-g white-text mr-lg-4"> </i>
            </a>

            <!-- Google + -->
            <a class="p-2 m-2 fa-lg gplus-ic" target="_blank" href="https://www.instagram.com/dprd.sumbar">
              <i class="fab fa-instagram white-text mr-lg-4"> </i>
            </a>

            <!-- Google + -->
            <a class="p-2 m-2 fa-lg gplus-ic" target="_blank" href="https://www.youtube.com/channel/UCVAxXQ_3jaRiYkKhzJnoZjg">
              <i class="fab fa-youtube white-text mr-lg-4"> </i>
            </a>
            
          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->
    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
      <div class="container-fluid">        
        <div class="row">
          <div class="col-6">
            <p>
              <a href="#">Dinas Komunikasi dan Informatika Sumatera Barat</a>
            </p>
          </div>
          <div class="col-6">            
              &copy; <?php echo date('Y');?> | <a target="_blank"  href="http://egov.sumbarprov.go.id/egov  ">Team e-Government Provinsi Sumatera Barat</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->
  <a id="back-to-top" href="#" class="btn btn-warning btn-sm back-to-top" role="button" style="padding:5px;"><i class="fas fa-arrow-up fa-3x text-white"></i></a>


  <!--  SCRIPTS  -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?php echo base_url('assets/public/theme2/js/jquery.min.js');?>"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo base_url('assets/public/theme2/js/popper.min.js');?>"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url('assets/public/theme2/js/bootstrap.min.js');?>"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo base_url('assets/public/theme2/js/mdb.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/public/theme2/js/modules/wow.js');?>"></script>

  <!-- Owl Carousel -->
  <script src="<?php echo base_url('assets/public/theme2/owlcarousel/dist/owl.carousel.min.js');?>"></script>
 <script>
  new WOW().init();
  </script>
  <script type="text/javascript">
     $(document).ready(function(){
        $(window).scroll(function () {
          if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
          } else {
            $('#back-to-top').fadeOut();
          }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
          $('body,html').animate({
            scrollTop: 0
          }, 400);
          return false;
        });

        $('.owl-home').owlCarousel({
            items:1,
            lazyLoad:true,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true
        });

        $('.owl-one').owlCarousel({
            items:2,
            lazyLoad:true,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2200,
            autoplayHoverPause:true
        });

         $('.owl-two').owlCarousel({
            items:1,
            lazyLoad:true,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2100,
            autoplayHoverPause:true,
            dots: false,
        });

         $('.owl-link').owlCarousel({
            items:4,
            lazyLoad:true,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:2100,
            autoplayHoverPause:true,
            dots: false,
        });
    });
  </script>
  
  </body>
</html>