
    <!-- Footer Section Begin -->
    <footer class="footer spad bg-success">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer__about">
              <div class="footer__about__logo">
                <a href="./index.html"><img src="img/logo-wh.png" alt="" /></a>
              </div>
              <ul>
                <li class="text-light">Address: <?php echo $ayarcek['ayar_adres']?></li>
                <li class="text-light">Phone: <?php echo $ayarcek['ayar_telefon']?></li>
                <li class="text-light">Email: <?php echo $ayarcek['ayar_mail']?></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
            <div class="footer__widget">
              <h6 class="text-light">Kullanılabilir Linkler</h6>
              <ul>
                <li><a href="hakkimizda.php" class="text-light">Hakkımda</a></li>
                <li><a href="iletisim.php" class="text-light">İletişim</a></li>
                <li><a href="hesap.php" class="text-light">Hesabım</a></li>
                <li><a href="kayit-ol.php" class="text-light">Hesap Oluştur</a></li>
                <li><a href="sepet.php" class="text-light">Sepete Git</a></li>

            </div>
          </div>
          <div class="col-lg-4 col-md-12">
            <div class="footer__widget">
              <h6 class="text-white">Sosyal Medya Hesaplarımız</h6>
             <!--  <p class="text-white">
                Get E-mail updates about our latest shop and special offers.
              </p>
              <form action="#">
                <input type="text" placeholder="Enter your mail" />
                <button type="submit" class="site-btn">Subscribe</button>
              </form> -->
              <div class="footer__widget__social">
                <a href="<?php echo $ayarcek['ayar_facebook_link']?>"><i class="fa fa-facebook"></i></a>
                <a href="<?php echo $ayarcek['ayar_instagram_link']?>"><i class="fa fa-instagram"></i></a>
                <a href="<?php echo $ayarcek['ayar_youtube_link']?>"><i class="fa fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="footer__copyright">
              <div class="footer__copyright__text text-white">
                <p>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  Bu web sitesi <b>Mertcan MUTLU</b> tarafından oluşturulmuştur.
                  &copy;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>

                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
              </div>
              <div class="footer__copyright__payment">
                <img src="img/payment-item.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script src="assets/js/fileinput.js"></script>

  </body>
</html>