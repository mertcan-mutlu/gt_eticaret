<?php include("hf-element/header.php") ?>
<?php
$stmt = $db->query("SELECT * FROM urunler");
$urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->query("SELECT * FROM kategoriler");

$kategori_verileri = $stmt->fetchAll(PDO::FETCH_ASSOC);
$secilen_kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : null;

if ($secilen_kategori_id) {
    $stmt = $db->prepare("SELECT * FROM urunler WHERE kategori_id = :kategori_id");
    $stmt->bindParam(':kategori_id', $secilen_kategori_id);
    $stmt->execute();
    $urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $db->query("SELECT * FROM urunler");
    $urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Ürünler</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Filtrele</h4>
                        <ul>
                            <ul>
                                <?php foreach ($kategori_verileri as $kategori) : ?>
                                    <li><a href="?kategori_id=<?php echo $kategori['kategori_id']; ?>"><?php echo $kategori['kategori_adi']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <!--<div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Çok Satanlar</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <div class="col-lg-4 col-md-6 col-sm-6 ">
                                <div class="product__item border border-success">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Crab Pool Security</a></h6>
                                        <h6><a href="#">150TL</a></h6>

                                        <button class="col-12 btn btn-success rounded-0">Sepete ekle</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 ">
                                <div class="product__item border border-success">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Crab Pool Security</a></h6>
                                        <h6><a href="#">150TL</a></h6>

                                        <button class="col-12 btn btn-success rounded-0">Sepete ekle</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 ">
                                <div class="product__item border border-success">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Crab Pool Security</a></h6>
                                        <h6><a href="#">150TL</a></h6>

                                        <button class="col-12 btn btn-success rounded-0">Sepete ekle</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 ">
                                <div class="product__item border border-success">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Crab Pool Security</a></h6>
                                        <h6><a href="#">150TL</a></h6>

                                        <button class="col-12 btn btn-success rounded-0">Sepete ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>-->
                <div class="section-title product__discount__title">
                    <h2>Tüm Ürünler</h2>
                </div>
                <div class="row">
                    <?php foreach ($urunler as $urun) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item border border-success">
                                <div class="product__item__pic set-bg" data-setbg="<?php echo $urun['urun_resim']; ?>">
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="urun_detay.php?id=<?php echo $urun['urun_id']; ?>"><b><?php echo $urun['urun_adi']; ?></b></a>
                                    </h6>
                                    <h6><a href="urun_detay.php?id=<?php echo $urun['urun_id']; ?>"><b><?php echo $urun['urun_fiyat']; ?></b>₺</a></h6>
                                    <a href="urun_detay.php?id=<?php echo $urun['urun_id']; ?>" class="col-12 btn btn-success rounded-0">Ürünü İncele</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="d-flex align-items-center justify-content-center">
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Product Section End -->
<?php include("hf-element/footer.php") ?>