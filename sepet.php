<?php include 'hf-element/header.php'; ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sepetim</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">

                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Ürün</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $toplamFiyatSepet = 0; 

                            if (!empty($_SESSION['sepet'])) {
                                foreach ($_SESSION['sepet'] as $sepet_urun) {
                                    $urun_id = $sepet_urun['urun_id'];
                            
                                    $sql = "SELECT urun_adi, urun_fiyat, urun_resim FROM urunler WHERE urun_id = :urun_id";
                                    $stmt = $db->prepare($sql);
                                    $stmt->bindParam(':urun_id', $urun_id);
                                    $stmt->execute();
                            
                                    $urun_bilgileri = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                                    ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img width="75px" src="<?php echo $urun_bilgileri['urun_resim']; ?>" alt="">
                                            <h5><?php echo $urun_bilgileri['urun_adi']; ?></h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <?php echo number_format($urun_bilgileri['urun_fiyat'], 2); ?>₺
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="">
                                                    <span><?php echo $sepet_urun['miktar']; ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            <?php
                                            $urunToplamFiyat = $urun_bilgileri['urun_fiyat'] * $sepet_urun['miktar'];
                                            $toplamFiyatSepet += $urunToplamFiyat;
                                            echo number_format($urunToplamFiyat, 2, ',', '.'); ?>₺
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <form method="post" action="hf-element/islem.php">
                                                <input type="hidden" name="urun_id" value="<?php echo $sepet_urun['urun_id']; ?>" /> 
                                                <button type="submit" class="btn btn-default" name="urun_kaldır">Sepetten Kaldır</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="5">Sepetiniz boş.</td></tr>';
                            }
?>
</tbody>
</table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
            <div class="shoping__checkout">
    <?php if (!empty($_SESSION['sepet'])) : ?>
        <h5>Sepet Toplamı</h5>
        <ul>
            <li>Toplam <span><?php echo number_format($toplamFiyatSepet, 2, ',', '.'); ?>₺</span></li>
        </ul>
        <div class="row justify-content-end">
            <a href="#" class="btn btn-success rounded-0 btn-lg">Ödeme sayfasına git</a>
        </div>
    <?php endif; ?>
</div>

            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<?php include 'hf-element/footer.php'; ?>
