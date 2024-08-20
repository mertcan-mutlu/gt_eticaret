<?php include("hf-element/header.php") ?>
<div class="container">
    <style>
    .bs-example {
        margin: 20px;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0px 0px 8px #28a745;
    }
    </style>
    <div class="row">
        <div class="col-md-8 mx-auto">
        <?php
if (!isset($_GET["step"]) || $_GET["step"] == "1") {
    echo '<div class="card card-body bs-example">
        <form id="submitForm" action="hf-element/islem.php" method="post">';
        if (isset($_GET["kayit"]) && $_GET["kayit"] == "var") {
            echo '<div class="alert alert-danger">Bu mail adresine veya telefon numarasına kayıtlı hesap bulunmaktadır!</div>';
        }
            echo '<input type="hidden">
            <div class="form-row">
                <div class="col form-group">
                    <label>Adınız : </label>
                    <input type="text" name="uye_ad" class="form-control" placeholder="Lütfen adınızı giriniz.">
                </div>
                <!-- form-group end.// -->
                <div class="col form-group">
                    <label>Soyadınız :</label>
                    <input type="text" name="uye_soyad" class="form-control" placeholder="Lütfen Soyadınızı giriniz">
                </div>
                <!-- form-group end.// -->
            </div>
            <!-- form-row end.// -->
            <div class="form-group">
                <label>E-posta Adresiniz</label>
                <input type="email" name="uye_mail" class="form-control" placeholder="Lütfen e-posta adresinizi giriniz.">
            </div>
            <div class="form-group">
                <label>Telefon numaranız</label>
                <input type="tel" name="uye_tel" maxlength="10" class="form-control" placeholder="Lütfen telefon numaranızı başında sıfır olamadan giriniz.">
            </div>
            <!-- form-group end.// -->

            <div class="form-group required">
                <label class="d-flex flex-row align-items-center" for="password">Şifre:</label>
                <input type="password" name="pas_sif" class="form-control" required="" placeholder="Lütfen şifrenizi giriniz" id="password" value=""><br>
            </div>
            <div class="form-group pt-1">
                <button class="btn btn-success col-12" name="uye_kaydet" type="submit"> Kayıt Ol</button>
            </div>

        </form>
        <p class="small-xl pt-3 text-center">
            <span class="text-dark"> Hesabınız var mı? </span>
            <a href="giris-yap.php" class="text-success"> Giriş Yap </a> <br>
        </p>
    </div>';
} elseif ($_GET["step"] == "2") {
    echo '<div class="card card-body bs-example">
            <form id="submitForm" action="#" method="post">';

    if (isset($_GET["onay"]) && $_GET["onay"] == "yanlis") {
        echo '<div class="alert alert-danger">Onay kodu hatalı!</div>';
    }

    echo '<div class="form-group required">
            <label for="username"><b>Onay kodunuz:</b></label>
            <input type="text" class="form-control text-lowercase" id="username" maxlength="6" required="" name="gelen_onay_kodu" placeholder="Lütfen onay kodunuzu giriniz.">
        </div>

        <div class="form-group pt-1">
            <button class="btn btn-success col-12" name="onay_kodu" type="submit"> Onayla </button>
        </div>
    </form>
    <p class="small-xl pt-3 text-center">
        <span class="text-dark"> Onay kodunuz telefon numaranıza en geç bir dakikada içinde gelecektir </span>
    </p>
</div>';
}
elseif ($_GET["step"] == "3"){
    echo '<div class="card card-body bs-example">
    <form id="submitForm" action="#" method="post"> <?php  ?>
        <p class="pt-3 text-center" style="font-size: 20px;">
        <span class="text-dark"> Doğrulama başarılı! Hesabınıza giriş yapabilirsiniz. </span>
    </p>
        <div class="form-group pt-1">
            <a class="btn btn-success col-12 name="onay_kodu" href="giris-yap.php"> Giriş Yap </a>
        </div>
    </form>
</div>';

}
?>


        </div>
    </div>
    <br>
</div>
<?php include("hf-element/footer.php") ?>


