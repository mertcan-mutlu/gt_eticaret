<?php include("hf-element/header.php") ?>
<?php
if (isset($_SESSION['uye_id'])) {
} else {
    echo "<script>window.location.href='giris-yap.php'</script>";
}
?>
<div class="container">
    <div class="container">
        <div class="row">
            <?php include("side-hesap.php");?>
            <!-- Profile Settings-->
            <div class="col-lg-8 pb-5">
                <form class="row" action="hf-element/islem.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-fn">Adınız :</label>
                            <input class="form-control" type="text" id="account-fn" value="<?php echo  $uye_verisi['uye_ad']; ?>" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-ln">Soyadınız :</label>
                            <input class="form-control" type="text" id="account-ln" value="<?php echo  $uye_verisi['uye_soyad']; ?>" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-email">E-mail Adresiniz :</label>
                            <input class="form-control" type="text" id="account-ln" value="<?php echo  $uye_verisi['uye_mail']; ?>" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-phone">Telefon Numaranız :</label>
                            <input class="form-control" type="text" id="account-phone" maxlength="10" value="<?php echo  $uye_verisi['uye_tel']; ?>"
                                required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-pass">Yeni Şİfre :</label>
                            <input class="form-control" type="password" id="account-pass">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-confirm-pass">Yeni Şifrenizi Tekrar Girin :</label>
                            <input class="form-control" type="password" id="account-confirm-pass">
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="custom-control custom-checkbox d-block">
                                <input class="custom-control-input" type="checkbox" id="subscribe_me" checked="">
                            </div>
                            <button class="btn btn-style-1 btn-success" type="button">Profili Güncelle</button>
                            <button type="submit" class="btn btn-info" name="cikis_yap"> Hesaptan Çıkış Yap</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php include("hf-element/footer.php") ?>