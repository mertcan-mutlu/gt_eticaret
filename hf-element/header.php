<?php 
include 'hf-element/islem.php'; 

$bakim_modu = $ayarcek['ayar_bakim'];

if ($bakim_modu == 1) {
  header('Location: bakim.php'); // Bakım sayfasına yönlendir
  exit();
}

?>

<!DOCTYPE html>
<html lang="tr">


<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Ogani Template" />
  <meta name="keywords" content="Ogani, unica, creative, html" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Gelecek Toprakta</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

<!-- Inputmask -->

  <!-- Css Styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="stylesheet" href="assets/js/dropzone/dropzone.css">
</head>

<body>
  <!-- Page Preloder
  <div id="preloder">
      <div class="loader"></div>
    </div> -->


  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
      <a href="#"><img src="img/logo.png" alt="" /></a>
    </div>
    <div class="humberger__menu__cart">
      <ul>
        <li>
          <a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a>
        </li>
      </ul>
      <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
      <div class="header__top__right__language">
        <img src="img/language.png" alt="" />
        <div>English</div>
        <span class="arrow_carrot-down"></span>
        <ul>
          <li><a href="#">Spanis</a></li>
          <li><a href="#">English</a></li>
        </ul>
      </div>
      <div class="header__top__right__auth">
        <a href="#"><i class="fa fa-user"></i> Login</a>
      </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
      <ul>
        <li class="active"><a href="./index.php">Home</a></li>
        <li><a href="./shop-grid.php">Shop</a></li>
        <li>
          <a href="#">Pages</a>
          <ul class="header__menu__dropdown">
            <li><a href="./shop-details.php">Shop Details</a></li>
            <li><a href="./shoping-cart.php">Shoping Cart</a></li>
            <li><a href="./checkout.php">Check Out</a></li>
          </ul>
        </li>
        <li><a href="./contact.php">Contact</a></li>
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
      <ul>
        <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
        <li>Free Shipping for all Order of $99</li>
      </ul>
    </div>
  </div>
  <!-- Humberger End -->

  <!-- Header Section Begin -->
  <header class="header bg-white shadow-sm mb-2">
    <div class="header__top bg-success">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="header__top__left">
              <ul class="text-center">
                <li>
                  <b class="text-light"><?php echo $ayarcek['ayar_sitemesaj']?></b>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="header__logo">
            <a href="./index.php"><img src="img/logo.png" alt="" /></a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="header__menu">
            <ul>
              <li class="active"><a href="./index.php">ANASAYFA</a></li>
              <li>
                <a href="urunler.php">ÜRÜNLER</a>
              </li>
              <li><a href="hakkimizda.php">Hakkımızda</a></li>
              <li><a href="iletisim.php">İLETİŞİM</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3">
          <div class="header__cart">
            <ul>
              <li>
                <a href="sepet.php" class="text-dark"><b>Sepetim&nbsp;</b><i class="fa fa-shopping-bag"></i></a>
              </li>
            </ul>
            
            <?php

if (isset($_SESSION['uye_id'])) {
  echo '<div class="header__cart__price"><b><a href="hesap.php"><button class="btn btn-success rounded-0">Hesabım</button></a></b></div>';
  
} else {
    // Eğer oturum değişkeni set edilmemişse hata mesajı göster
    echo '<div class="header__cart__price"><b><a href="giris-yap.php"><button class="btn btn-success rounded-0">Giriş Yap</button></a></b></div>';
}
?>
        </div>
        <div class="humberger__open">
          <i class="fa fa-bars"></i>
        </div>
      </div>
  </header>
<!--   <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="hero__search">
          <div class="col-md-12">
            <div class="search">
              <i class="fa fa-search"></i>
              <input type="text" id="search" class="form-control" placeholder="Ürün ara" />
              <button class="btn btn-success">Ara</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
-->

<?php if (isset($_COOKIE['bilgi'])) {

} else {

    echo '
    <div id="myModal" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Site Hakkında</h5>
            </div>
            <div class="modal-body ">
                <p>Bu proje <b>Mertcan Mutlu</b> tarafından <b>Sistem Analizi ve Tasarımı Dersi</b> için hazırlanmıştır.</p>
                    <div class="text-center">
                    <button type="button" class="btn btn-success " data-dismiss="modal">Tamamdır 😊</button>
                    </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $("#myModal").modal("show"); // Modalı göster

            // Tamam butonuna tıklama durumu
            $(".btn-success").click(function() {
                document.cookie = "bilgi=gosterildi; expires=Sat, 31 Dec 2030 12:00:00 UTC; path=/";
            });
        });
    </script>';
}
?>


                
              <!--Header Section End-->