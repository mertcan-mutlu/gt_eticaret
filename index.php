<?php 
include("hf-element/header.php");

    $stmt = $db->query("
        SELECT u.*, k.kategori_adi 
        FROM urunler u 
        JOIN kategoriler k ON u.kategori_id = k.kategori_id
    ");


    $urunler = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $urun = array(
            'resim' => $row['urun_resim'],
            'baslik' => $row['urun_adi'],
            'fiyat' => $row['urun_fiyat'],
            'kategori' => $row['kategori_adi']
        );
        $urunler[] = $urun;
    }
?>

<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <?php for ($i = 0; $i < $aktif_slider_sayisi; $i++) : ?>
                        <li data-target="#demo" data-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?>></li>
                        <?php endfor; ?>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
    <?php foreach ($slider as $anahtar => $resim) : ?>
        <div class="carousel-item <?= $anahtar === 0 ? 'active' : '' ?>">
            <div class="d-flex justify-content-center align-items-center" style="height: 431px; width: 1140px;">
                <img src="<?= $resim['slider_resim'] ?>" class="img-fluid" style="max-height: 100%;" />
            </div>
        </div>
    <?php endforeach; ?>
</div>
                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
        <div class="categories__slider owl-carousel">
    <?php
foreach ($kategori_veri as $kategori):
    if ($kategori['kategori_durum'] == 1):
?>
    <div class="col-lg-3">
        <div class="categories__item set-bg" data-setbg="<?php echo $kategori['kategori_resim']; ?>">
            <h5><a href="#"><?php echo $kategori['kategori_adi']; ?></a></h5>
        </div>
    </div>
<?php
    endif;
endforeach;
?>
</div>

        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Ürünler</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Tümü</li>
                            <?php foreach ($kategori_veri as $kat): ?>
                            <?php if ($kat['kategori_durum'] == 1): ?>
                        <li data-filter=".<?php echo $kat['kategori_adi']; ?>"><?php echo $kat['kategori_adi']; ?></li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
        <?php foreach ($urunler as $urun): ?>
    <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $urun['kategori']; ?>">
        <div class="featured__item">
            <div class="featured__item__pic set-bg" data-setbg="<?php echo $urun['resim']; ?>">
            </div>
        </div>
    </div>
<?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->


<br />

<?php include("hf-element/footer.php") ?>