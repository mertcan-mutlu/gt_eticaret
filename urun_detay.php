<?php include("hf-element/header.php") ?>

<?php 

    if (isset($_GET['id'])) {
        $urun_id = $_GET['id'];

        $stmt = $db->prepare("SELECT urun_adi, urun_stok, urun_fiyat, urun_aciklama, urun_resim FROM urunler WHERE urun_id = :urun_id");
        $stmt->bindParam(':urun_id', $urun_id);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if (count($result) > 0) {
            foreach ($result as $row) {
                $urun_adi = $row['urun_adi'];
                $urun_fiyat = $row['urun_fiyat'];
                $urun_resim = $row['urun_resim'];
                $urun_aciklama = $row['urun_aciklama'];
                $urun_stok = $row['urun_stok'];
            }
        } else {
            echo "Ürün bulunamadı.";
        }
    } else {
        echo "Ürün ID bulunamadı.";
    }
 ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Ürün Detayları</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="<?php echo $urun_resim ;?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php echo $urun_adi; ?></h3>
                    
                    
                    <div class="product__details__quantity">
                        <div class="quantity">
                        <div class="product__details__price"><?php echo $urun_fiyat; ?>₺</div>
                            
                        <?php

if ($urun_stok > 0) {
    echo '<form method="post" action="hf-element/islem.php">
            <input type="hidden" name="urun_id" value="'.$urun_id.'">
            <div class="pro-qty"><input type="text" name="miktar" value="1"></div>
            <button type="submit" name="urun_ekle" class="btn btn-success rounded-0">Sepete Ekle</button>
        </form>';
} else {
    echo '<span class="btn btn-danger" style="color: white;">Stokta yok</span>';
}
?>
                        </div>
                    </div>
                    
                    <ul>
                        <li><b>Stok Durumu</b> <span><?php if ($urun_stok > 0) {
        echo "<span style='color: green;'>Stokta var</span>";
    } else {
        echo "<span style='color: red;'>Stokta yok</span>";
    } ?></span></li>
                        <li><b>Ürün Hakkında</b> <span><p><?php echo $urun_aciklama; ?></p></span></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Product Details Section End -->


<?php include("hf-element/footer.php") ?>